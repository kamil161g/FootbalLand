<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 17.02.19
 * Time: 15:44
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {

        return $this->render("index.html.twig");
    }
}