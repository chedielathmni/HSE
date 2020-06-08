<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class appTest extends TestCase {

    public function testsAreWorking() {
        $user = new User();
        $user->setUsername('testUserName')
            ->setFirstName('firstName')
            ->setLastName('lastName')
            ->setPassword('password')
            ->setGrade('trash')
            ->setCripted(false)
            ->setRoles(array('ROLE_USER'));

        $this->assertEquals($user->getPassword(), 'password');

    }
}