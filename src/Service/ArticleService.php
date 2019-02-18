<?php


namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleService
{
    private $repository;


    public function __construct(EntityManagerInterface $repository)
    {
        $this->repository = $repository;
    }


    public function insertArticle($article)
    {
        if($this->repository->getRepository(Article::class)->addArticle($article)){
            return false;
        }else{
            return true;
        }

    }

    public function selectArticle($id)
    {
        return $this->repository->getRepository(Article::class)->findOneBy(['id' => $id]);
    }
}