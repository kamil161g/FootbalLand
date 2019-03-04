<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @param $comment
     * @param $user
     * @param $article
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertComment($comment, $user, $article)
    {
        $em = $this->_em;
        $comment->setAuthor($user);
        $comment->setCreatedAt(new \DateTime('@'.strtotime('now +1 hours')));
        $comment->setArticle($article);
        $em->persist($comment);
        $em->flush();
    }

    public function editComment($comment)
    {
        $em = $this->_em;
        $comment->setUpdateAt(new \DateTime('@'.strtotime('now +1 hours')));
        $em->persist($comment);
        $em->flush();
    }
}
