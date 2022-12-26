<?php

namespace App\Controller;

use App\Service\BoardServices;
use App\Service\TaskServices;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    #[Route('/board', name: 'app_board')]
    public function index(BoardServices $boardServices, TaskServices $taskServices): Response
    {
        $boardTypes = $boardServices->getAllBoards();
        $tasks = $taskServices->getTasksByUserId($this->getUser()->getId());
        return $this->render('board/index.html.twig', [
            'boards' => $boardTypes,
            'tasks' => $tasks,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/board/edit')]
    public function addCondition(BoardServices $boardServices)
    {
        $boardTypes = $boardServices->getAllBoards();
        return $this->render('board/edit.html.twig', [
            'boards' => $boardTypes,
        ]);
    }
}
