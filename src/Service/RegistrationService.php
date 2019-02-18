<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationService
{
    private $repository;
    private $passwordEncoder;


    public function __construct(EntityManagerInterface $repository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function insertUser($user, $plainPassword)
    {
          $password = $this->passwordEncoder->encodePassword($user, $plainPassword);
        if($this->repository->getRepository(User::class)->insertUser($user, $password)){
            return false;
        }else{
            return true;
        }

    }

}