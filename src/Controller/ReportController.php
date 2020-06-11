<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class ReportController extends EasyAdminController {


    protected function persistEntity($entity)
    {
        if ( !$entity->getAuthor())
        {
            $entity->setAuthor($this->getUser());
            parent::persistEntity($entity);
        }
    }

}