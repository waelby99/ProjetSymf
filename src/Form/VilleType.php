<?php

namespace App\Form;

use App\Entity\Destination;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code_ville')
            ->add('des_ville')
            ->add('image')
            ->add('code_des',EntityType::class,
                 ['class'=>Destination::class,
                'choice_label'=>'des_dest',
                'label'=>'Destination'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}
