<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Service\ArticleService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EditArticleController
 * @package App\Controller
 */
class EditArticleController extends AbstractController
{
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
     * @param Article $article
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editArticle(Article $article, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);

            $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){

                    if($this->articleService->editArticle($article)){
                        $this->addFlash("success", "Zedytowałeś artykuł.");
                            return $this->redirectToRoute("show_article", ['article' => $article->getId()]);
                    }else{
                        $this->addFlash("error", "Ups! Coś poszło nie tak.");
                    }
                }
        return $this->render("Article/createArticle.html.twig",[
            'form' => $form->createView()
        ]);
    }
}