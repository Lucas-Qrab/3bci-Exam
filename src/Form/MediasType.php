<?php

namespace App\Form;

use App\Entity\Medias;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MediasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du média',
                'attr' => [
                    'placeholder' => 'Nom du média',
                ],
            ])
            ->add('synopsis', TextType::class, [
                'label' => 'Synopsis',
                'attr' => [
                    'placeholder' => 'Synopsis',
                ],
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type de média',
                'choices' => [
                    'Film' => 'Film',
                    'Série' => 'Série',
                ],
            ])
            ->add('creationDate', DateType::class, [
                'label' => 'Date de création',
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de création',
                ],
            ])
            ->add('Author', TextType::class, [
                'label' => 'Auteur',
                'attr' => [
                    'placeholder' => 'Auteur',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medias::class,
        ]);
    }
}
