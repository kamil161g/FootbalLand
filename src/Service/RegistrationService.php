<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegistrationService
 * @package App\Service
 */
class RegistrationService
{
    /**
     * @var EntityManagerInterface
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;


    /**
     * RegistrationService constructor.
     * @param EntityManagerInterface $repository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(EntityManagerInterface $repository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param $user
     * @param $plainPassword
     * @return bool
     */
    public function setUser($user, $plainPassword)
    {
          $password = $this->passwordEncoder->encodePassword($user, $plainPassword);
        if($this->repository->getRepository(User::class)->insertUser($user, $password)){
            return false;
        }else{
            return true;
        }

    }

}