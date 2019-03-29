<?php
/**
 * Created by PhpStorm.
 * User: lonestar
 * Date: 29/03/2019
 * Time: 16:21
 */

namespace App\Controller;

use App\Entity\contactForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactFormController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact")
     */
    public function new(Request $request)
    {
        // creates a contactForm and gives it some dummy data for this example
        $contactForm = new contactForm();
        $contactForm->setFirstname('firstname');
        $contactForm->setLastname('lastname');
        $contactForm->setEmail('example@email.com');
        $contactForm->setMessage('firstname');

        $form = $this->createFormBuilder($contactForm)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $contactForm = new contactForm();
            $contactForm->setFirstname($data['firstname']);
            $contactForm->setLastname($data['lastname']);
            $contactForm->setEmail($data['email']);
            $contactForm->setMessage($data['message']);

        }



        return $this->render('contactForm/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}