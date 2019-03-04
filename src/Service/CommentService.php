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
     * @param $article
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setComment($comment, $article)
    {
        if($this->repository->getRepository(Comment::class)->insertComment($comment, $this->user, $article)){
            return false;
        }else{
            return true;
        }

    }

    /**
     * @param $comment
     * @return bool
     */
    public function editComment($comment)
    {
        if($this->repository->getRepository(Comment::class)->editComment($comment)){
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