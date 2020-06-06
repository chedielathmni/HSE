<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class TransporterController extends EasyAdminController {


    protected $requestStack;

    public function __construct(RequestStack $requestStack, MailerInterface $mailer)
    {
        $this->requestStack = $requestStack;
        $this->mailer = $mailer;
    }

    public function updateTransporterEntity($entity) {
        

        $request = $this->requestStack->getCurrentRequest();

        $property = $request->query->get('property');
        $value = $request->query->get('newValue');

        

        if ($property == 'valid' and $value == 'true') {
            $email = (new Email())
            ->from('chedielathmni@gmail.com')
            ->to('deidara.liverpool@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');


        $this->mailer->send($email);
        }
        parent::updateEntity($entity);
    }
}