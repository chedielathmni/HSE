<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class ProductController extends EasyAdminController {



    protected function persistProductEntity($entity) {

        if ($entity->getFournisseur() == null) 
        {
            $entity->setFournisseur($entity->getNewFournisseur());
        }
        parent::persistEntity($entity);
    }

}