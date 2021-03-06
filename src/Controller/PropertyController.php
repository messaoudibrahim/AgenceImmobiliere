<?php
/**
 * Created by PhpStorm.
 * User: Brahim
 * Date: 10/11/2018
 * Time: 00:18
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\SearchFormType;
use App\Notification\ContactNotification;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     * @Template()
     * @Route(path="/biens",name="property.index")
     */
    public function index(Request $request, PaginatorInterface $paginator) :Response{

        $loSearch = new PropertySearch();
        $loForm = $this->createForm(SearchFormType::class, $loSearch);
        $loForm->handleRequest($request);

        $laPropertiesQuery = $this->getDoctrine()->getRepository(Property::class)->getbienVisible($loSearch);
        $pagination = $paginator->paginate(
            $laPropertiesQuery, /* query NOT result */
            $request->query->getInt('page', 1), 9
        );
        return $this->render('property/index.html.twig', [
            'menu_current' => 'properties',
            'properties'   => $pagination,
            'form'         => $loForm->createView()
        ]);
    }

    /**
     * @Route(path="/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @param string $slug
     * @param Request $request
     * @param ContactNotification $notification
     * @return Response
     */
    public function show(Property $property, string $slug, Request $request,ContactNotification  $notification):Response{
        // if the slug was changed in the url
        if ($property->getSlug() != $slug){
            $this->redirectToRoute('property.show',
            [
               'id' => $property->getId(),
               'slug'=> $property->getSlug()
            ], 301);
        }
        $loContact = new Contact();
        $loContact->setProperty($property);
        $loForm = $this->createForm(ContactType::class, $loContact);
        $loForm->handleRequest($request);
        if ($loForm->isSubmitted() && $loForm->isValid()){
            //TODO
            $notification->notify($loContact);
            /**
            $this->redirectToRoute('property.show',
                [
                    'id' => $property->getId(),
                    'slug'=> $property->getSlug()
                ]
            );*/
        }//

        return $this->render('property/show.html.twig',
            [
                'menu_current' => 'properties',
                'property'     => $property,
                'form'         => $loForm->createView()
            ]);
    }
}