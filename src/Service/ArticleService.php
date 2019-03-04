<?php


namespace App\Service;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ArticleService
 * @package App\Service
 */
class ArticleService
{
    /**
     * @var EntityManagerInterface
     */
    private $repository;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;


    /**
     * ArticleService constructor.
     * @param EntityManagerInterface $repository
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManagerInterface $repository, TokenStorageInterface $tokenStorage)
    {
        $this->repository = $repository;
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @param $article
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setArticle($article)
    {
        if($this->repository->getRepository(Article::class)->insertArticle($article, $this->user)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param $article
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editArticle($article)
    {
        if($this->repository->getRepository(Article::class)->editArticle($article, $this->user)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param Article $id
     * @return Article|object|null
     */
    public function getById(Article $id)
    {
        return $this->repository->getRepository(Article::class)->findOneBy(['id' => $id]);
    }

    /**
     * @return Article[]|object[]
     */
    public function getThreeLatestArticle()
    {
        return $this->repository->getRepository(Article::class)->findBy([], ['id' => 'ASC'], 3);
    }

    public function selectArticleByUserId(User $user)
    {
        return $this->repository->getRepository(Article::class)->findBy(['author' => $user]);
    }
}