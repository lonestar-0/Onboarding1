<?php
/**
 * Created by PhpStorm.
 * User: lonestar
 * Date: 30/03/2019
 * Time: 12:50
 */

namespace App\Mailer;


class Mailer
{

    public function SendMail(\Swift_Mailer $mailer, $form, $departement)
    {
        $message = (new \Swift_Message('Test email'))
            ->setFrom('symfony4ever@gmail.com')
            ->setTo($departement[0]["email"])
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'contactform/mail_contact.html.twig', [
                        'form' => $form,
                        'departement' => $departement
                    ]
                ),
                'text/html'
            );

        $mailer->send($message);
    }

}