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
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * @var object|string
     */
    private $user;


    /**
     * ArticleService constructor.
     * @param EntityManagerInterface $repository
     * @param TokenStorageInterface $tokenStorage
     * @param FileUploader $fileUploader
     */
    public function __construct(EntityManagerInterface $repository, TokenStorageInterface $tokenStorage, FileUploader $fileUploader)
    {
        $this->repository = $repository;
        $this->user = $tokenStorage->getToken()->getUser();
        $this->fileUploader = $fileUploader;
    }

    /**
     * @param $article
     * @param $file
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setArticle($article, $file)
    {
        $fileName = $this->fileUploader->upload($file);
        return $this->repository->getRepository(Article::class)->insertArticle($article, $this->user, $fileName);
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