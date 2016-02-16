<?php

namespace Efi\GanadosBundle\Form;

use Doctrine\Common\Cache\ArrayCache;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class PersonaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $years = Array();
//        $now = new \DateTime('now');
//        for ($i = 2016; $i < 5; $i++ ){
//            $year[] = $i;
//        }
//        echo $years;
        $builder
            ->add('metodoGanar', 'entity',
                array(
                    'class' => 'EfiGanadosBundle:MetodoGanar',
                    'label' => 'Metodo'
                ))
            ->add('fechaNacimiento', DateType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'placeholder' => array(
                    'day' => '--', 'month' => '--', 'year' => '----'
                ),
                'years' => range(1920,2010),
            ))
            ->add('cedula')
            ->add('nacionalidad')
            ->add('nombres')
            ->add('apellidos')
            ->add('sexo')
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
