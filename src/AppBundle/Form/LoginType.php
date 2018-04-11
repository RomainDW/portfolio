<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', EmailType::class, [
                'label' => 'Adresse Email',
                'attr'  => ['placeholder' => 'Entrez votre adresse email']
            ])
            ->add('_password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr'  => ['placeholder' => 'Entrez votre mot de passe']
            ])
        ;
    }
}