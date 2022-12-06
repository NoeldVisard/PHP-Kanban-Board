<?php

namespace App\Service;

use App\Entity\Task;
use Cassandra\Date;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\VarDumper\VarDumper;

class TaskServices extends AbstractService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function createTask(
        int $userId,
        string $taskName,
        string $taskDescription,
        string $taskUrgency,
        string $taskDeadline
    ): Task {
        $dateDeadline = new DateTime($taskDeadline);
        $newTask = new Task($userId, $taskName, $taskDescription, $taskUrgency, $dateDeadline);
        return $newTask;
    }

    public function saveTask(Task $task): void
    {
        $this->entityManager->getRepository(Task::class)->save($task, true);
    }

    public function getTasksByUserId(int $userId): array
    {
        $allTasks = $this->entityManager->getRepository(Task::class)->getAllTasksByUserId($userId);
        foreach ($allTasks as $task) {
            $tasks[$task["conditionId"]][] = $task;
        }
        return $tasks;
    }
}