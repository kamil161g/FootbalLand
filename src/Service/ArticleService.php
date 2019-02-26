<?php


namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

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
     * ArticleService constructor.
     * @param EntityManagerInterface $repository
     */
    public function __construct(EntityManagerInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param $article
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setArticle($article)
    {
        if($this->repository->getRepository(Article::class)->insertArticle($article)){
            return false;
        }else{
            return true;
        }

    }

    /**
     * @param $id
     * @return Article|object|null
     */
    public function getById($id)
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
}