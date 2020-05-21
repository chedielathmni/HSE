<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Form\EntryType;
use App\Repository\EntryRepository;
use App\Repository\ProductRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class EntryController extends EasyAdminController
{



    public function __construct(EntityManagerInterface $em, EntryRepository $repository, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->repository = $repository;
        $this->requestStack = $requestStack;
    }


    /** Le role de cette fonction est de changer un produit en dechet, ou de supprimer des dechet de la base
     * @Route("/admin/entry/use", name = "use_entry")
     */
    public function use(Request $request, EntryRepository $repository) :Response
    {

        $id = $request->query->get("id");
        $entry = $repository->find($id);

        $form = $this->createForm(EntryType::class, $entry);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            
            $data = $form->getData();
            if ($entry->getType() == 'Produit chimique') {
                $entry->setQuantity($entry->getQuantity() - $form->get('quantityUsed')->getData());
                $waste = new Entry;

                $waste = $repository->findOneBy(
                    [
                        "product" => $entry->getProduct(),
                        "type" => "dechet"
                    ]
                );
                if (!$waste) {
                $waste = clone $entry;
                $waste->setQuantity($form->get('wasteQuantity')->getData());
                $waste->setEntryDate(new DateTime());
                $waste->setType("dechet");
                #$waste->setZone( $form->get("zone")->getData());
                $this->em->persist($waste);
                }
                else {
                    #$waste->setZone( $form->get("zone")->getData());
                    $waste->setQuantity($waste->getQuantity() + $form->get('wasteQuantity')->getData() );
                }
                $this->em->flush();
            }
            else {
                if ($entry->getQuantity() == $form->get('wasteQuantity')->getData())
                {
                    $this->em->remove($entry);
                }
                else
                {
                    $entry->setQuantity($entry->getQuantity() - $form->get('wasteQuantity')->getData());
                }
                $this->em->flush();
            }
            return $this->redirectToRoute('easyadmin', [
                'action' => 'list',
                'entity' => 'Entry'
            ]);
        }

        return $this->render('admin/entries/use.html.twig', [
            "entry" => $entry,
            "form" => $form->createView()
        ]);
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
                "quantity" => $entry->getQuantity(),
                "type" => $entry->getType()
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
