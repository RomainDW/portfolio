<?php


namespace AppBundle\Service;


use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ContactMailer
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function process (Form $form, Request $request)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->sendContactMail($form);
            return true;
        }

        return false;
    }


    public function sendContactMail (Form $form)
    {
        $data = $form->getData();

        $message = \Swift_Message::newInstance()
            ->setSubject('Contact depuis le portfolio : ' . $data['name'])
            ->setFrom($data['from'])
            ->setTo('contact@romain-ollier.com')
            ->setBody(
                $form->getData()['message'],
                'text/plain'
            );

        $this->mailer->send($message);
    }
}