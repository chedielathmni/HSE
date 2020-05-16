<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends EasyAdminController {



    protected function persistProductEntity($entity) {

        if ($entity->getFournisseur() == null) 
        {
            $entity->setFournisseur($entity->getNewFournisseur());
        }
        parent::persistEntity($entity);
    }


    /**
     * @Route(path = "/admin/product/print", name = "product_print")
     */
    public function printAction(Request $request, ProductRepository $repository) {

        $id = $request->query->get('id');
        $product = $repository->find($id);

        return $this->render('admin/fiche/print.html.twig', [
            'product' => $product
        ]);

    }
}