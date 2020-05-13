<?php

namespace App\Controller;

use App\Repository\EntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Routing\Annotation\Route;

class EntryController extends EasyAdminController
{



    public function __construct(EntityManagerInterface $em, EntryRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
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
                "productName" => $entry->getProduct()->getProductName() . " " .$entry->getProduct()->getProductCode(),
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
}
