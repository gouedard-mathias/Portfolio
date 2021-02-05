<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('subject', TextType::class, [
                'required'   => false,
                'label' => false,
                'attr' => [
                    'class' => 'form',
                    'placeholder' => 'sujet'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form',
                    'placeholder' => 'email'
                ]
            ])
            ->add('comment', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form',
                    'placeholder' => 'Commentaire'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
