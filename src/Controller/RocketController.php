<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RocketController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        // Example static data for launches
        $launches = [
            ['date' => '2022-12-15', 'mission' => 'Artemis I', 'rocket' => 'SLS', 'status' => 'Success'],
            ['date' => '2023-03-01', 'mission' => 'Starship Test', 'rocket' => 'Starship', 'status' => 'Failure'],
            ['date' => '2024-07-12', 'mission' => 'Crew-7', 'rocket' => 'Falcon 9', 'status' => 'Success'],
            ['date' => '2024-10-25', 'mission' => 'Lunar Gateway Supply', 'rocket' => 'Falcon Heavy', 'status' => 'Success'],
        ];

        return $this->render('pages/homepage.html.twig', [
            'launches' => $launches,
        ]);
    }
}
