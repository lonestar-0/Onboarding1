<?php
/**
 * Created by PhpStorm.
 * User: lonestar
 * Date: 30/03/2019
 * Time: 12:50
 */

namespace App\Mailer;


use App\Entity\ContactForm;

class Mailer
{
    private $mailer;
    private $contact;

    /**
     * Mailer constructor.
     * @param $mailer
     */
    public function __construct(\Swift_Mailer $mailer, ContactForm $contact)
    {
        $this->mailer = $mailer;
        $this->contact = $contact;
    }

    public function SendMail()
    {

        $message = (new \Swift_Message('Fiche de contact'))
            ->setFrom('symfony4ever@gmail.com')
            ->setTo('test23ab@yopmail.com')
            ->addPart('wow');

        return $this->mailer->send($message);
    }



}