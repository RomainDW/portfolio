<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CvType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intro', null, [
                'attr' => ['class' => 'tinymce']
            ])
            ->add('mail')
            ->add('phone')
            ->add('website')
            ->add('websiteLink')
            ->add('linkedin')
            ->add('linkedinLink',null, [
                'label' => 'Lien Linkedin'
            ])
            ->add('github')
            ->add('githubLink', null, [
                'label' => 'Lien Github'
            ])
            ->add('twitter')
            ->add('twitterLink', null, [
                'label' => 'Lien twitter'
            ])
            ->add('name')
            ->add('job')
            ->add('file', FileType::class, [
                'required' => false,
                'label' => 'Photo de profile'
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn-xl btn-success sr-button']]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cv'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cv';
    }


}
