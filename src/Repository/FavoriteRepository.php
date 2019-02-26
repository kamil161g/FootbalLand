<?php

namespace App\Repository;

use App\Entity\Favorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Favorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favorite[]    findAll()
 * @method Favorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteRepository extends ServiceEntityRepository
{

    /**
     * FavoriteRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Favorite::class);
    }

    /**
     * @param $article
     * @param $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertFavoriteArticle($user, $article)
    {
        $favorite = new Favorite();
        $em = $this->_em;
        $favorite->setArticle($article);
        $favorite->setUser($user);
        $em->persist($favorite);
        $em->flush();
    }

    /**
     * @param $favorite
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeFavorite($favorite)
    {
        $em = $this->_em;
        $em->remove($favorite);
        $em->flush();
    }
}
