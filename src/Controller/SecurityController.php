<?php
/**
 * Created by PhpStorm.
 * User: Brahim
 * Date: 11/11/2018
 * Time: 20:41
 */
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route(path="/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils){
        $lsError = $authenticationUtils->getLastAuthenticationError();
        $lsLastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lsLastUsername,
            'error'    => $lsError
        ]);
    }
}