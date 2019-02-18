<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 18.02.19
 * Time: 19:14
 */

namespace App\Service;


use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CommentService
{
    private $repository;
    private $user;

    public function __construct(EntityManagerInterface $repository, TokenStorageInterface $tokenStorage)
    {
        $this->repository = $repository;
        $this->user = $tokenStorage->getToken()->getUser();

    }


    public function insertComment($comment)
    {
        if($this->repository->getRepository(Comment::class)->insertComment($comment, $this->user)){
            return false;
        }else{
            return true;
        }

    }
}