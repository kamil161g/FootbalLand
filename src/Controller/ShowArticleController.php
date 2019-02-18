<?php


namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Service\ArticleService;
use App\Service\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ShowArticleController extends AbstractController
{
    private $articleService;
    private $commentService;
    private $comment;

    public function __construct(ArticleService $articleService, CommentService $commentService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
        $this->comment = new Comment();

    }

    public function selectArticleAction($id, Request $request)
    {
        $article = $this->articleService->selectArticle($id);

            $form = $this->createForm(CommentType::class, $this->comment);

                $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid()){

                        if($this->commentService->insertComment($this->comment)){
                            $this->addFlash("success", "Dodałeś komentarz.");
                        }else{
                            $this->addFlash("error", "Ups! Coś poszło nie tak.");
                        }

                    }

        return $this->render("Article/article.html.twig",[
            'article' => $article,
            'form' => $form->createView()
        ]);
    }
}