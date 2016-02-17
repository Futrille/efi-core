<?php

namespace Efi\GanadosBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PersonaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('metodoGanar', 'entity',
                array(
                    'class' => 'EfiGanadosBundle:MetodoGanar',
                    'label' => '¿C&oacute;mo fue ganado? ',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('fechaNacimiento', DateType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'placeholder' => array(
                    'day' => '--', 'month' => '--', 'year' => '----'
                ),
                'years' => range((\Date('Y') - 6), 1920),
                'label' => 'Fecha de Nacimiento: ',
            ))
            ->add('nacionalidad', ChoiceType::class, array(
                'choices'  => array(
                    'Venezolano(a) ' => 'V',
                    'Extranjero(a) ' => 'E',
                ),
                'expanded' => true,
                'multiple' => false,
                // *this line is important*
                'choices_as_values' => true,
                'label' => 'Nacionalidad: ',
            ))
            ->add('cedula', IntegerType::class, array(
                'label' => 'Cedula de Identidad: ',
                'attr' => array(
                    'class' => 'form-control'
                ),
            ))
            ->add('nombres')/*, TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                ),
            ))*/
            ->add('apellidos')
            ->add('sexo', ChoiceType::class, array(
                'choices'  => array(
                    'Masculino ' => 'M',
                    'Femenino ' => 'F',
                ),
                'expanded' => true,
                'multiple' => false,
                // *this line is important*
                'choices_as_values' => true,
                'label' => 'Sexo: ',
            ))
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
