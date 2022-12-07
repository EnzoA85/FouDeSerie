<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Serie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('resume')
            ->add('duree')
            ->add('premiereDiffusion')
            ->add('image')
            ->add('genres',
            EntityType::class,
            array(
                'class'=>Genre::class,
                'expanded' => true,
                'multiple' => true,
                'choice_label'=>'libelle',//libelle est la propriété de l'entité Genre que l'on veut afficher
                'multiple'=>true//permetlasélectionmultiple
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
