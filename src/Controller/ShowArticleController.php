<?php


namespace App\Controller;

use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowArticleController extends AbstractController
{
    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function selectArticleAction($id)
    {
           $article = $this->articleService->selectArticle($id);

        return $this->render("Article/article.html.twig",[
            'article' => $article,
        ]);
    }
}