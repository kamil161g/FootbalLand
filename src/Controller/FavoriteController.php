<?php


namespace App\Controller;


use App\Service\ArticleService;
use App\Service\FavoriteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class FavoriteController
 * @package App\Controller
 */
class FavoriteController extends AbstractController
{
    /**
     * @param $article
     * @param FavoriteService $favoriteService
     * @param ArticleService $articleService
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addFavoriteArticleForUser($article, FavoriteService $favoriteService, ArticleService $articleService, Request $request)
    {

            $articleObject = $articleService->getById($article);

                    $checkYouStatusHeart = $favoriteService->checkYouStatusHeart($article);

                        if($checkYouStatusHeart === null){
                            $favoriteService->setFavorite($articleObject);
                        } else{
                            $favoriteService->removeFavorite($checkYouStatusHeart);
                        }

        return $this->redirectToRoute('show_article',[
                    'article' => $article

        ]);


    }
}