<?php
/**
 * Created by PhpStorm.
 * User: lonestar
 * Date: 29/03/2019
 * Time: 16:21
 */

namespace App\Controller;

use App\Form\ContactFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ContactFormController extends AbstractController
{
    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact")
     */

    
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactForm = $form->getData();

//            $message = (new \Swift_Message('Fiche de contact'))
//                ->setFrom('symfony4ever@gmail.com')
//                ->setTo('bonjourjetest@yopmail.com')
//                ->setBody("Hehe");
//            $this->get('mailer')->send($message);

            $em->persist($contactForm);
            $em->flush();

            $this->addFlash('success', 'Article créé avec succes !');

            return $this->redirectToRoute('/contact');
        }
        
        return $this->render('contactForm/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}