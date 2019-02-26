<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationController
 * @package App\Controller
 */
class RegistrationController extends AbstractController
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var RegistrationService
     */
    private $registrationService;

    /**
     * RegistrationController constructor.
     * @param RegistrationService $registrationService
     */
    public function __construct(RegistrationService $registrationService)
    {
        $this->user = new User();
        $this->registrationService = $registrationService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function registration(Request $request) : Response
    {
        $form = $this->createForm(RegistrationFormType::class, $this->user);

            $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){
                    $plainPassword = $form->get('password')->getData();
                    $this->registrationService->setUser($this->user, $plainPassword);
                }

        return $this->render("Registration/registration.html.twig",[
            'form' => $form->createView(),
        ]);
    }
}