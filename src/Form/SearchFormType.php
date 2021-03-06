<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\PropertySearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minSurface' ,IntegerType::class, [
                'required' => false,
                'label'    => false,
                'attr'     => [
                    'placeholder' => 'Surface minimale'
                ]
            ])
            ->add('maxPrice',IntegerType::class, [
                    'required' => false,
                    'label'    => false,
                    'attr'     => [
                        'placeholder' => 'Budget maximal'
                    ]
            ])
            ->add('options',EntityType::class, [
                'class'         => Option::class,
                'label'         => false,
                'required'      => false,
                'choice_label'  => 'name',
                'multiple'      => true,
                'attr'     => [
                    'placeholder' => 'Options'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'      => PropertySearch::class,
            'method'          => 'get',
            'csrf_protection' => false
        ]);
    }

    /**
     * @return null|string
     */
    public function getBlockPrefix()
    {
        return '';
    }

}
