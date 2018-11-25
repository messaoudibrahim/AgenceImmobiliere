<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('room')
            ->add('bedroom')
            ->add('floor')
            ->add('price')
            ->add('heat', ChoiceType::class, [
                'choices' => $this->getchoice()
            ])
            ->add('options', EntityType::class,[
                'class'         => Option::class,
                'required'      => false,
                'choice_label'  =>'name',
                'multiple'      => true
            ])
            ->add('imageFile', FileType::class,[
                'required' => false
            ])
            ->add('city')
            ->add('address')
            ->add('postal_code')
            ->add('sold')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }
    private function getchoice(){
        $laChoice = [];
        foreach (Property::HEAT as $key => $value) {
            $laChoice [$value] = $key;
        }
        return $laChoice;
    }
}
