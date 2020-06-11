<?php

namespace App\Controller;

use App\Repository\EntryRepository;
use App\Repository\ReportRepository;
use App\Repository\WorkingZoneRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(EntryRepository $repository)
    {



        // * TODO add calendar chart for alerts and accidents * //
        // * TODO  Column chart for stock warehouses * //
        $stock = $repository->findAll();
        $pieChart = new PieChart();
        $data = $this->getData($stock);

        $pieChart->getData()->setArrayToDataTable($data);


        $pieChart->getOptions()->setTitle('Produits en Stock');
        $pieChart->getOptions()->setHeight(400);
        $pieChart->getOptions()->setWidth(800);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'stock' => $stock,
            'chart' => $pieChart,
        ]);
    }


    /**
     * @Route("/dashboard/calendar", name="calendar")
     */
    public function calendar()
    {


        return $this->render('dashboard/calendar.html.twig', [
            'controller_name' => 'DashboardController',

        ]);
    }

    /**
     * @Route("/dashboard/zones", name="zones")
     */
    public function zones(WorkingZoneRepository $repository)
    {

        $zones = $repository->findAll();

        return $this->render('dashboard/zones.html.twig', [
            'controller_name' => 'DashboardController',
            'zones' => $zones
        ]);
    }


    /**
     * @Route("/dashboard/reports", name="reports")
     */
    public function reports(ReportRepository $repository)
    {

        $reports = $repository->findAll();

        return $this->render('dashboard/reports.html.twig', [
            'controller_name' => 'DashboardController',
            'reports' => $reports,
        ]);
    }

    private function getData($stock) {

        $data = [['Produit', 'Quantity']];
        foreach($stock as $entry) array_push($data, array($entry->getProduct()->getProductName(), $entry->getQuantity() ));
        
        return $data;
    }


}
