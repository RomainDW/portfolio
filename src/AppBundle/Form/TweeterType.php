<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TweeterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tweet',TextareaType::class, [
                'attr' => ['placeholder' => 'Quoi de neuf ?'],
                'label' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Le champ est vide']),
                    new Length([
                        'min' => 5,
                        'max' => 280,
                        'minMessage' => 'Le tweet doit faire 5 caractères ou plus.',
                        'maxMessage' => 'Le tweet ne doit pas dépasser 280 caractères'
                    ])
                ]
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Tweeter',
                'attr' => ['class' => 'btn btn-block btn-primary']]);
        ;
    }
}