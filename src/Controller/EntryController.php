<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Repository\EntryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntryController extends EasyAdminController
{



    public function __construct(EntityManagerInterface $em, EntryRepository $repository, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->repository = $repository;
        $this->requestStack = $requestStack;
    }



    /**
     * @Route("/admin/destock", name="destock")
     */
    public function destock()
    {
    
        $entries = $this->repository->findAll();
        $data = [];
        $this->config = $this->get('easyadmin.config.manager')->getBackendConfig();
        $this->entity = $this->get('easyadmin.config.manager')->getEntityConfig('Entry');

        foreach($entries as $entry) {
            array_push($data, [
                "productName" => $entry->getProduct()->getProductName(),
                "quantity" => $entry->getQuantity()
            ]);
        }


        return $this->render('admin/entries/destock.html.twig', [
            'entries' => $entries,
            'data' => $data,
            'size' => count($data),
            'entity' => $this->entity,
            'config' => $this->config
        ]);
    }

    /**
     * @Route("/admin/destock/save", name="destock_save")
     */
    public function save(Array $data, ProductRepository $productRepo) : Response 
    {


        $request = $this->requestStack->getCurrentRequest();
        $data = $request->query->get('newData');



        return $this->render('test/index.html.twig', [
            'data' => $data
        ]);

        /* $user = $this->user;
        if(!$user) return $this->json([
            'code' => 403,
            'message' => 'Unauthorized'
        ],403);

        foreach($data as $product) {
            $prod = $productRepo->findOneBy([
                'productName' => $product[0]
            ]);
            
            if ($product[1] == 0) $this->em->remove($prod);
            else $prod->setQuantity = $product[1];
            $this->em->flush();


            return $this->json([
                'code' => 200,
                'message' => 'it works'
            ],200);
        }

 */
        
    }
}
