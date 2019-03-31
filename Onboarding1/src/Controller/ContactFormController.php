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
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ContactFormController extends AbstractController
{

    public function SendMail(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Test email'))
            ->setFrom('symfony4ever@gmail.com')
            ->setTo('Departement1@gmail.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'contactform/mail_contact_html.twig'
                ),
                'text/html'
            )
        ;

        $mailer->send($message);
    }


    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact")
     */

    
    public function new(EntityManagerInterface $em, Request $request)
    {

        $transport = (new Swift_SmtpTransport('smtp-exploded.alwaysdata.net', 25))
            ->setUsername('exploded@alwaysdata.net')
            ->setPassword('123Passwd456_')
        ;

        $mailer = new \Swift_Mailer($transport);

        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactForm = $form->getData();

            $em->persist($contactForm);
            $em->flush();
            $this->SendMail($mailer);

            $this->addFlash('success', 'Article créé avec succes !');


            return $this->redirectToRoute('app_contactform_new');
        }
        
        return $this->render('contactform/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}