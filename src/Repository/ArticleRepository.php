<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{

    /**
     * ArticleRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);

    }

    /**
     * @param $article
     * @param $user
     * @param $fileName
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertArticle($article, $user, $fileName)
    {
        $em = $this->_em;
        $article->setAuthor($user);
        $article->setCreateAt(new \DateTime('@'.strtotime('now +1 hours')));
        $article->setFile($fileName);
        $em->persist($article);
        $em->flush();
    }

    /**
     * @param $article
     * @param $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editArticle($article, $user)
    {
        $em = $this->_em;
        $article->setAuthor($user);
        $article->setUpdateAt(new \DateTime('@'.strtotime('now +1 hours')));
        $em->persist($article);
        $em->flush();
    }
}
