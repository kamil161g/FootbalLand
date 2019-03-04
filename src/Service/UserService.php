<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    /**
     * @var EntityManagerInterface
     */
    private $repository;

    /**
     * UserService constructor.
     * @param EntityManagerInterface $repository
     */
    public function __construct(EntityManagerInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param User $user
     * @return User|object|null
     */
    public function getById(User $user)
    {
        return $this->repository->getRepository(User::class)->findOneBy(['id' => $user]);
    }
}