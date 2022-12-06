<?php

namespace App\Controller;

use App\Service\TaskServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_task')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }

    #[Route('/task/add', name: 'app_task')]
    public function addTask(
        Request $request,
        TaskServices $taskServices,
    ): Response
    {
        // Убеждаемся, что пользователь авторизован, а не просто перешёл по ссылке
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $parameters = json_decode($request->getContent(), true);
        $newTask = $taskServices->createTask(
            $this->getUser()->getId(),
            $parameters["taskName"],
            $parameters["taskDescription"],
            $parameters["taskUrgency"],
            $parameters["taskDeadline"]
        );
        $taskServices->saveTask($newTask);
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }


}
