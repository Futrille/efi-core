<?php

namespace Efi\GanadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('estatus')
//            ->add('esCompleto')
            ->add('fechaNacimiento')
            ->add('cedula')
            ->add('nacionalidad')
            ->add('nombres')
            ->add('apellidos')
            ->add('sexo')
            ->add('iglesia', 'entity',
                array(
                    'class' => 'EfiGeneralBundle:Iglesia',
                    'label' => 'Iglesia'
                ))
            ->add('metodoGanar', 'entity',
                array(
                    'class' => 'EfiGanadosBundle:MetodoGanar',
                    'label' => 'Metodo'
                ))
            ->add('pais', 'entity',
                array(
                    'class' => 'EfiGeneralBundle:Pais',
                    'label' => 'Pais'
                ))
//            ->add('idEstatus', 'entity',
//                array(
//                    'class' => 'EfiGeneralBundle:ValorVariable',
//                    'label' => 'Estatus'
//                ))
//            ->add('idEsCompleto')
//            ->add('direcciones')
//            ->add('telefonos')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Efi\GanadosBundle\Entity\Persona'
        ));
    }
}
