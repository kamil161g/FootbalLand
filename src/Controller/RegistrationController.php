<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    private $user;
    private $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->user = new User();
        $this->registrationService = $registrationService;
    }

    public function registrationAction(Request $request) : Response
    {
        $form = $this->createForm(RegistrationFormType::class, $this->user);

            $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){
                    $this->registrationService->insertUser($this->user, $form->get('password')->getData());
                }

        return $this->render("Registration/registration.html.twig",[
            'form' => $form->createView(),
        ]);
    }
}