<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array('label' => 'Nom', 'label_attr' => array('class' => 'text-white'), 'attr' => array('placeholder' => 'Entrez votre Nom')) )
            ->add('from', EmailType::class, array('label' => 'Email', 'label_attr' => array('class' => 'text-white') , 'attr' => array('placeholder' => 'Entrez votre adresse email')))
            ->add('message', TextareaType::class, array('label_attr' => array('class' => 'text-white'), 'attr' => array('placeholder' => 'Entrez votre message', 'rows' => '5')))
        ;
    }
}