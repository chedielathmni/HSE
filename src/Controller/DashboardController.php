<?php

namespace App\Controller;

use App\Repository\WorkingZoneRepository;
use App\Repository\ZoneRepository;
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
     * @Route("/dashboard/calendar", name="calendar")
     */
    public function calendar() {


        return $this->render('dashboard/calendar.html.twig', [
            'controller_name' => 'DashboardController',

        ]);
    }

        /**
     * @Route("/dashboard/zones", name="zones")
     */
    public function zones(WorkingZoneRepository $repository) {

        $zones = $repository->findAll();

        return $this->render('dashboard/zones.html.twig', [
            'controller_name' => 'DashboardController',
            'zones' => $zones
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
