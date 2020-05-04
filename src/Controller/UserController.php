<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class UserController extends EasyAdminController
{
    protected function  persistUserEntity($user)
    {  

        /*  if (!$user->getDepartment()) {
            $user->setRoles(['ROLE_USER']);
            parent::persistEntity($user);
        } */


        if (!$user->getCripted()){
        $encodedPassword = $this->encodePassword($user, $user->getPassword());
        $user->setPassword($encodedPassword);
        $user->setCripted(true);

        parent::persistEntity($user);
        }

    }



    protected function updateUserEntity($user)
    
    
    {
        if ($user->getDepartment()) {
            $user->setRoles($user->getDepartment()->getRoles());
        }
        else
        {
            $user->setRoles(['ROLE_USER']);
        }

        parent::updateEntity($user);
    }

    

    private function encodePassword($user, $password)
    {
        $passwordEncoderFactory = new EncoderFactory([
            User::class => new MessageDigestPasswordEncoder('sha512', true, 5000)
        ]);

        $encoder = $passwordEncoderFactory->getEncoder($user);

        return $encoder->encodePassword($password, $user->getSalt());
    }
}