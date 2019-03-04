<?php


namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class CreateNewArticleController
 * @package App\Controller
 */
class CreateNewArticleController extends AbstractController
{

    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * @var Article
     */
    private $article;

    /**
     * CreateNewArticleController constructor.
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
        $this->article = new Article();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createNewArticle(Request $request)
    {
            $form = $this->createForm(ArticleType::class, $this->article);

                $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid()){

                        if($this->articleService->setArticle($this->article)){
                            $this->addFlash("success", "Dodałeś artykuł.");
                                return $this->redirectToRoute("show_article", ['article' => $this->article->getId()]);
                        }else{
                            $this->addFlash("error", "Ups! Coś poszło nie tak.");
                        }
                    }

        return $this->render("Article/createArticle.html.twig",[
            'form' => $form->createView(),
        ]);
    }

}