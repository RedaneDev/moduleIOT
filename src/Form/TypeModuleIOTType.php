<?php

namespace App\Form;

use App\Entity\TypeModuleIOT;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeModuleIOTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,[
                'label' => 'Nom du type de module'
            ])
            ->add('dataName2',null, [
                'label' => 'nom de la 1ère propriété'
            ])
            ->add('dataName3',null, [
                'label' => 'nom de la 2ème propriété'
            ])
            ->add('dataName4',null, [
                'label' => 'nom de la 3ème propriété'
            ])
            ->add('dataName5',null, [
                'label' => 'nom de la 4ème propriété'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeModuleIOT::class,
            'type' => 'edit'
        ]);
    }
}
