<?php


namespace App\Service;


use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class CommentService
{
    /**
     * @var EntityManagerInterface
     */
    private $repository;

    /**
     * @var object|string
     */
    private $user;

    /**
     * CommentService constructor.
     * @param EntityManagerInterface $repository
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManagerInterface $repository, TokenStorageInterface $tokenStorage)
    {
        $this->repository = $repository;
        $this->user = $tokenStorage->getToken()->getUser();

    }

    /**
     * @param $comment
     * @return bool
     */
    public function setComment($comment)
    {
        if($this->repository->getRepository(Comment::class)->insertComment($comment, $this->user)){
            return false;
        }else{
            return true;
        }

    }

    /**
     * @param $article
     * @return Comment[]|object[]
     */
    public function getById($article)
    {
        return $this->repository->getRepository(Comment::class)->findBy(['article' => $article]);
    }


}