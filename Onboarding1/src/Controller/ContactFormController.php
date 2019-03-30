<?php
/**
 * Created by PhpStorm.
 * User: lonestar
 * Date: 29/03/2019
 * Time: 16:21
 */

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ContactFormController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact")
     */

    
    public function new(EntityManagerInterface $em, Request $request)
    {
        // creates a contactForm and gives it some dummy data for this example
        $contactForm = new ContactForm();
        $contactForm->setFirstname('firstname');
        $contactForm->setLastname('lastname');
        $contactForm->setEmail('example@email.com');
        $contactForm->setMessage('firstname');
        $contactForm->setDepartement('rh');

        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactForm = $form->getData();

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