<?php

namespace Efi\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NivelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo')
            ->add('estatus')
            ->add('icono')
            ->add('nombre')
            ->add('color')
            ->add('iglesia')
            ->add('padre')
            ->add('idTipo')
            ->add('idEstatus')
            ->add('idIcono')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Efi\GeneralBundle\Entity\Nivel'
        ));
    }
}
