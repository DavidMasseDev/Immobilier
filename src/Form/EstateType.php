<?php

namespace App\Form;

use App\Entity\Estate;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('area', NumberType::class,[
                'scale' => 2
            ])
            ->add('room',NumberType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    "Flat" => "Flat",
                    "House" => "House",
                    "Yurt"  => "Yurt"
                ],
                "expanded" => false,
                "multiple" => false
            ])
            ->add('adress', TextType::class)
            ->add('city', TextType::class)
            ->add('pool', ChoiceType::class,[
                'choices' => [
                    "Yes" => true,
                    "No" => false
                ]
            ])
            ->add('outdoor', ChoiceType::class,[
                'choices' => [
                    "Yes" => true,
                    "No" => false
                ]
            ])
            ->add('outdoor_area',NumberType::class,[
                'scale' => 2,
                'required' => false
            ])
            ->add('garage',ChoiceType::class,[
                'choices' => [
                    "Yes" => true,
                    "No" => false
                ]
            ])
            ->add('transaction', ChoiceType::class, [
                'choices' => [
                    "Rent" => "Rent",
                    "Sell" => "Sell",
                ],
                "expanded" => false,
                "multiple" => false
            ])
            ->add('price',NumberType::class,[
                'scale' => 2
            ])
//            ->add('picture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Estate::class,
        ]);
    }
}
