<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
 * @Route("/", name="main")
 */
    public function index(Request $request, ObjectManager $manager)
    {


        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);

        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $file =$contact->getDocument();
            $fileName='/bluedev/public/documents/'.md5(uniqid()).'.'.$file->guessExtension();
            $file = $formContact->get('document')->getData();
            $file->move($this->getParameter('document_directory'), $fileName);
            $contact->setDocument($fileName);
            $manager->persist($contact);
            $manager->flush();
            $this->addFlash('notice', 'Post Submitted Successfully!!!');
//            return $this->redirectToRoute('main');
        }

        return $this->render('index/index.html.twig', [
            'controller_name' => 'MainController',
            "formContact" => $formContact->createView(),


        ]);
    }

}
