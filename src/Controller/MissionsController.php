<?php

namespace App\Controller;

use App\Repository\MissionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    private $missionsRepository;

    public function __construct(MissionsRepository $missionsRepository)
    {
        $this->missionsRepository = $missionsRepository;
    }

    /**
     * @Route("/missions", name="missions_list")
     */
    public function list(): Response
    {
        // Retrieve all missions
        $missions = $this->missionsRepository->findAll();

        return $this->render('missions/list.html.twig', [
            'missions' => $missions,
        ]);
    }
}
