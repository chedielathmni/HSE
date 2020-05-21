<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Entity\Product;
use App\Repository\EntryRepository;
use App\Repository\ProductRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
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
    public function printAction(Request $request, ProductRepository $prodRepository) {

        $id = $request->query->get('id');
        $product = $prodRepository->find($id);

        
        return $this->render('admin/product/print.html.twig', [
            'product' => $product
            ]);
            
        }
        
        /**
         * @Route(path= "/admin/product/stock", name = "add_stock")
         */
        public function stockAction(Request $request, ProductRepository $prodRepository, EntryRepository $entryRepositort, EntityManagerInterface $em) {
            
            $id = $request->query->get('id');
            $product = $prodRepository->find($id);
            
            $entry = $entryRepositort->findOneBy(array('product' => $product));



            
            if (!$entry) {
            $entry = new Entry;
            $entry->setProduct($product);
            $entry->setQuantity(0);
            $entry->setEntryDate(new DateTime());

            $em->persist($entry);
            $em->flush();
            }

            if ($entry) return $this->redirectToRoute('easyadmin', [
                'action' => 'edit',
                'id' => $entry->getId(),
                'entity' => 'Entry'
            ]);

    }
}