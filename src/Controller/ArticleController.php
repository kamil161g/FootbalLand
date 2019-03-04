<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Service\ArticleService;
use App\Service\CommentService;
use App\Service\FavoriteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends AbstractController
{
    /**
     * @var ArticleService
     */
    private $articleService;

    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * @var FavoriteService
     */
    private $favoriteService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     * @param CommentService $commentService
     * @param FavoriteService $favoriteService
     */
    public function __construct(ArticleService $articleService, CommentService $commentService, FavoriteService $favoriteService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
        $this->favoriteService = $favoriteService;

    }

    /**
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showArticleAndAddAndShowComment(Request $request, Article $article)
    {
        $comment = new Comment();

            $article = $this->articleService->getById($article);

                $form = $this->createForm(CommentType::class, $comment);

                    $form->handleRequest($request);

                        if($form->isSubmitted() && $form->isValid()){

                            if($this->commentService->setComment($comment, $article)){
                                $this->addFlash("success", "Dodałeś komentarz.");
                                    return $this->redirectToRoute('show_article', ['article' => $article->getId()]);
                            }else{
                                $this->addFlash("error", "Ups! Coś poszło nie tak.");
                            }

                        }

            $comments = $this->commentService->getById($article);

                $countFavorite = count($this->favoriteService->getByIdArticle($article));

                    $checkHaveYouLiked = $this->favoriteService->checkYouStatusHeart($article);

                        $showRandomArticle = $this->articleService->getThreeLatestArticle();


        return $this->render("Article/article.html.twig",[
            'article' => $article,
            'form' => $form->createView(),
            'comments' => $comments,
            'countFavorite' => $countFavorite,
            'checkHaveYouLiked' => $checkHaveYouLiked,
            'random' => $showRandomArticle
        ]);
    }
}