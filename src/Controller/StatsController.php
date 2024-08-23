<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    /**
     * @Route("/admin/stats", name="app_stats")
     */
    public function index(): Response
    {
        return $this->render('stats/index.html.twig');
    }

    /**
     * @Route("/admin/diagrammes-en-baton", name="dia_bat")
     */
    public function dia_bat(): Response
    {
        return $this->render('stats/bat.html.twig');
    }

    /**
     * @Route("/admin/camembert", name="camembert")
     */
    public function dia_cam(): Response
    {
        return $this->render('stats/cam.html.twig');
    }
}
