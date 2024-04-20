<?php

namespace App\Form;

use App\Entity\ModuleIOT;
use App\Entity\TypeModuleIOT;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleIOTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,[
                'label' => 'Nom du module'
            ])
            ->add('type', EntityType::class,[
                'class' => 'App\Entity\TypeModuleIOT',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'data' => $options['typeModuleIOT']
            ])
            ->add('isActive',HiddenType::class,[
                'data' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ModuleIOT::class,
        ]);
        $resolver->setRequired([
            'typeModuleIOT'
        ]);
    }
}
