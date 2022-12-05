<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class BoardController extends AbstractController
{
    #[Route('/board', name: 'app_board')]
    public function index(): Response
    {
//        VarDumper::dump($this->getUser());
        return $this->render('board/index.html.twig', [
            'controller_name' => 'CoursesController',
        ]);
    }
}
