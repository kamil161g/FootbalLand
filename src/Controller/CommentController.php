<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Service\ArticleService;
use App\Service\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends AbstractController
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
     * ArticleController constructor.
     * @param ArticleService $articleService
     * @param CommentService $commentService
     */
    public function __construct(ArticleService $articleService, CommentService $commentService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;

    }

    /**
     * @param Comment $comment
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editComment(Comment $comment, Request $request, Article $article)
    {
        $article = $this->articleService->getById($article);

            $form = $this->createForm(CommentType::class, $comment);

                $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid()){

                        if($this->commentService->editComment($comment)){
                            $this->addFlash("success", "Dodałeś komentarz.");
                            return $this->redirectToRoute('show_article', ['article' => $article->getId()]);
                        }else{
                            $this->addFlash("error", "Ups! Coś poszło nie tak.");
                        }

                    }
        return $this->render("Comment/editComment.html.twig",[
            "form" => $form->createView()
        ]);
    }
}