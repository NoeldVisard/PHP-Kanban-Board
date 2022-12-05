<?php

namespace App\Service;

use App\Entity\Board;
use Doctrine\ORM\EntityManagerInterface;

class BoardServices extends AbstractService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function getAllBoards()
    {
        return $this->entityManager->getRepository(Board::class)->findAll();
    }
    
}