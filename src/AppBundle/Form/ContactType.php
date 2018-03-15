<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom',
                'label_attr' => ['class' => 'text-white'],
                'attr' => ['placeholder' => 'Entrez votre Nom'],
                'constraints' => [new NotBlank(['message' => 'Vous devez renseigner un Nom'])]
            ])

            ->add('from', EmailType::class, [
                'label' => 'Email',
                'label_attr' => ['class' => 'text-white'],
                'attr' => ['placeholder' => 'Entrez votre adresse email'],
                'constraints' => [new Email(['message' => "L'adresse Email n'est pas valide."])]
            ])

            ->add('message', TextareaType::class, [
                'label_attr' => ['class' => 'text-white'],
                'attr' => ['placeholder' => 'Entrez votre message', 'rows' => '5'],
                'constraints' => [new Length(['min' => 20, 'minMessage' => 'Le message doit faire 20 caractères ou plus.'])]
            ])

            ->add('send', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn-xl btn-light sr-button']]);
        ;
    }
}