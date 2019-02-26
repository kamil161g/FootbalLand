<?php


namespace App\Service;


use App\Entity\Favorite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class FavoriteService
 * @package App\Service
 */
class FavoriteService
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
     * FavoriteService constructor.
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
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setFavorite($article)
    {
        $this->repository->getRepository(Favorite::class)->insertFavoriteArticle($this->user, $article);
    }

    /**
     * @param $favorite
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeFavorite($favorite)
    {
        $this->repository->getRepository(Favorite::class)->removeFavorite($favorite);
    }


    /**
     * @param $article
     * @return Favorite[]|object[]
     */
    public function getByIdArticle($article)
    {
      return $this->repository->getRepository(Favorite::class)->findBy(['article' => $article]);
    }

    /**
     * @param $article
     * @return Favorite|object|null
     */
    public function checkYouStatusHeart($article)
    {
        return $this->repository->getRepository(Favorite::class)->findOneBy([
            'article' => $article,
            'user' => $this->user
        ]);
    }
}