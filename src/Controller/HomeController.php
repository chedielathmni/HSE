<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\WebLink\Link;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->redirectToRoute('easyadmin');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/alert", name="alert", methods={"GET", "POST"})
     */
    public function alert(PublisherInterface $publisher, Request $request, ?User $user){
        


        $user = $this->getUser();
        $workingZone = $user->getWorkingZone();
        $products = [];
        $workers = [];

        foreach ( $workingZone->getProducts() as $product) {
            array_push($products, [$product->getId(), $product->getProductName()]);
        }

        foreach ($workingZone->getWorkers() as $worker) {
            array_push($workers, [$worker->getId(), $worker->getFirstName() . ' ' . $worker->getLastName()]);
        }

        $update = new Update(
            '/alert',
            json_encode([
                'sender' => $user->getUsername(),
                'wokringZone' => $workingZone->getName(),
                'products' => $products,
                'workers' => $workers,
                ])
        );

        $publisher($update);

        //return $this->json('Done');
        return $this->redirectToRoute('easyadmin');
    }




    /**
     * @Route("/discover", name="discover")
     */
    public function discover(Request $request) {

        $hubUrl = $this->getParameter('mercure.default_hub');
        $this->addLink($request, new Link('mercure', $hubUrl));

        return $this->json('Done!');
    }

}
