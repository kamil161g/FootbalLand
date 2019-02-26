<?php


namespace App\Controller;


use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{
    /**
     * @param ArticleService $articleService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ArticleService $articleService)
    {
        $threeArticles = $articleService->getThreeLatestArticle();

        return $this->render("index.html.twig",[
            'article' => $threeArticles
        ]);
    }
}