<?php
/**
 * Created by PhpStorm.
 * User: Brahim
 * Date: 10/11/2018
 * Time: 00:18
 */

namespace App\Controller;


use App\Entity\Property;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @return Response
     * @Template()
     * @Route(path="/biens",name="property.index")
     */
    public function index() :Response{
        $laProperties = $this->getDoctrine()->getRepository(Property::class)->findBy(['sold'=>false]);
        return $this->render('property/index.html.twig', [
            'menu_current' => 'properties',
            'properties' => $laProperties
        ]);
    }

    /**
     * @Route(path="/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @param string $slug
     * @return Response
     */
    public function show(Property $property, string $slug):Response{

        // if the slug was changed in the url
        if ($property->getSlug() != $slug){
            $this->redirectToRoute('property.show',
            [
               'id' => $property->getId(),
               'slug'=> $property->getSlug()
            ], 301);
        }

        return $this->render('property/show.html.twig',
            [
                'menu_current' => 'properties',
                'property'     => $property
            ]);
    }
}