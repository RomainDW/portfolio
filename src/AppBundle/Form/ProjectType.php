<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du projet',
                'constraints' => [new NotBlank(['message' => 'Vous devez renseigner tous les champs'])]
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie(s)',
                'class' => 'AppBundle\Entity\Category',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true
            ])
            ->add('createdDate', DateType::class, [
                'label' => 'Date de création',
                'format' => 'dd-MM-yyyy',
                'constraints' => [new NotBlank(['message' => 'Vous devez renseigner tous les champs'])]
            ])
            ->add('file', FileType::class, [
                'label' => 'Image',
                'required' => false
            ])
            ->add('resume', TextareaType::class, [
                'label' => 'Description',
                'constraints' => [new NotBlank(['message' => 'Vous devez renseigner tous les champs'])],
                'attr' => ['rows' => '5', 'class' => 'tinymce'],
            ])
            ->add('link', TextType::class, [
                'label' => 'Lien du site',
                'constraints' => [new NotBlank(['message' => 'Vous devez renseigner tous les champs'])]
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn-xl btn-success']
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_project';
    }


}
