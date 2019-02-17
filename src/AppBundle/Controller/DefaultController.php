<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use AppBundle\Entity\User;

class DefaultController extends Controller
{
    const RESULT_SUCCESS = 'success';
    const RESULT_FAIL = 'fail';

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if($this->getUser()){
            return $this->redirectToRoute('rss');
        }

        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @Route("/validate", name="validate")
     */
    public function validateAction(Request $request, ValidatorInterface $validator, UserRepository $userRepository)
    {
        $response = ['result' => self::RESULT_SUCCESS, 'message' => ''];
        $email = $request->get('email');

        $errors = $validator->validatePropertyValue(User::class, 'email', $email, 'registration');

        if (count($errors) > 0) {
            $error = current($errors)[0];
            $response = ['result' => self::RESULT_FAIL, 'message' => $error->getMessage()];
        }

        if($userRepository->findOneBy(['email' => $email])){
            $response = ['result' => self::RESULT_FAIL, 'message' => 'This email already exists'];
        }

        return new JsonResponse($response);
    }
}

