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

    public function SendMail($departement, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Test email'))
            ->setFrom('symfony4ever@gmail.com')
            ->setTo('Departement1@gmail.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'contactform/mail_contact_html.twig',
                    ['departement' => $departement]
                ),
                'text/html'
            )
        ;

        $mailer->send($message);
    }

}