<?php


namespace App\Controller;


use App\Entity\User;
use App\Service\ArticleService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ProfileController
 * @package App\Controller
 */
class ProfileController extends AbstractController
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * ProfileController constructor.
     * @param UserService $userService
     * @param ArticleService $articleService
     */
    public function __construct(UserService $userService, ArticleService $articleService)
    {
        $this->userService = $userService;
        $this->articleService = $articleService;
    }


    /**
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewProfile(User $user)
    {
        return $this->render("Profile/viewProfile.html.twig",[
            'user' => $this->userService->getById($user)
        ]);
    }

    /**
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function selectArticle(User $user)
    {
        return $this->render("Profile/viewArticleById.html.twig",[
            'article' => $this->articleService->selectArticleByUserId($user)
        ]);
    }
}