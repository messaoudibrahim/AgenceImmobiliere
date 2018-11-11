<?php
/**
 * Created by PhpStorm.
 * User: Brahim
 * Date: 07/11/2018
 * Time: 21:54
 */

namespace App\Controller;


use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/", name="homePage")
     */
    public function index(): Response{
        $laProperties= $this->getDoctrine()->getRepository(Property::class)->findLatest();

        return $this->render('pages/home.html.twig',
        [
            'properties' => $laProperties
        ]);
    }

}