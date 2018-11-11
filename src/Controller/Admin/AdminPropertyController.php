<?php
    /**
     * Created by PhpStorm.
     * User: Brahim
     * Date: 11/11/2018
     * Time: 01:47
     */

namespace App\Controller\Admin;


use App\Entity\Property;
use App\Form\PropertyFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    /**
     * @Route(path="/admin/property/index" ,name="admin.property.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $laProperties = $this->getDoctrine()->getRepository(Property::class)->findAll();
        return $this->render("admin/index.html.twig", [
                'properties' => $laProperties
            ]
        );
    }

    /**
     * @Route(path="/admin/property/create" ,name="admin.property.create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {   $em = $this->getDoctrine()->getManager();
        $loProperty = new Property();
        $loForm = $this->createForm(PropertyFormType::class, $loProperty);
        $loForm->handleRequest($request);

        if ($loForm->isSubmitted() && $loForm->isValid() ){
            $em->persist($loProperty);
            $em->flush();
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render("admin/create.html.twig", [
                'form'     =>$loForm->createView()
            ]
        );
    }

    /**
     * @Route(path="/admin/property/edit/{id}" ,name="admin.property.edit")
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Property $property, Request $request)
    {
        $loForm = $this->createForm(PropertyFormType::class, $property);
        $loForm->handleRequest($request);
        if ($loForm->isSubmitted() && $loForm->isValid() ){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render("admin/edit.html.twig", [
                'property' => $property,
                'form'     =>$loForm->createView()
            ]
        );
    }
    /**
     * @Route(path="/admin/property/remove/{id}" ,name="admin.property.remove")
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Property $property, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($property);
        $em->flush();
        return $this->redirectToRoute("admin.property.index");
    }


}