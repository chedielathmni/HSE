<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }


    /**
     * @Route("/dashboard/calender", name="calender")
     */
    public function calender() {
        return $this->render('dashboard/calender.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

        /**
     * @Route("/dashboard/zones", name="zones")
     */
    public function zones() {
        return $this->render('dashboard/zones.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }


        /**
     * @Route("/dashboard/reports", name="reports")
     */
    public function reports() {
        return $this->render('dashboard/reports.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
