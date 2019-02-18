<?php


namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CreateNewArticleController extends AbstractController
{

    private $articleService;
    private $article;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
        $this->article = new Article();
    }

    public function createNewArticleAction(Request $request)
    {
            $form = $this->createForm(ArticleType::class, $this->article);

                $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid()){

                        if($this->articleService->insertArticle($this->article)){
                            $this->addFlash("success", "Dodałeś artykuł.");
                        }else{
                            $this->addFlash("error", "Ups! Coś poszło nie tak.");
                        }
                    }

        return $this->render("Article/createArticle.html.twig",[
            'form' => $form->createView(),
        ]);
    }

}