<?php

namespace Efi\GanadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
                    'label' => 'Como fue ganado: ',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('fechaNacimiento', 'Symfony\Component\Form\Extension\Core\Type\DateType', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Fecha de Nacimiento: ',
                'attr' => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('nacionalidad', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'Venezolano(a) ' => 'V',
                    'Extranjero(a) ' => 'E',
                ),
                'expanded' => false,
                'multiple' => false,
                // *this line is important*
                'choices_as_values' => true,
                'label' => 'Nacionalidad: ',
                'attr' => array(
                    'class' => 'form-control'
                ),
            ))
            ->add('cedula', 'Symfony\Component\Form\Extension\Core\Type\IntegerType', array(
                'label' => 'Cedula de Identidad: ',
                'attr' => array(
                    'class' => 'form-control',
                    'min' => 3000000,
                    'max' => 100000000,
                    'maxlength' => 20,
                    'autofocus' => 'autofocus',
                ),
            ))
            ->add('nombres', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
                'label' => 'Nombres: ',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 100,
                ),
                'trim' => true,
            ))
            ->add('apellidos', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
                'label' => 'Apellidos: ',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 100,
                ),
                'trim' => true,
            ))
            ->add('sexo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'Masculino ' => 'M',
                    'Femenino ' => 'F',
                ),
                'expanded' => false,
                'multiple' => false,
                // *this line is important*
                'choices_as_values' => true,
                'label' => 'Sexo: ',
                'attr' => array(
                    'class' => 'form-control'
                ),
            ))
            ->add('direccion', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
                'label' => 'Direccion de Referencia: ',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 200,
                ),
                'trim' => true,
            ))
            ->add('telefono', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
                'label' => 'Telefono de Contacto: ',
                'required' => false,
                'attr' => array(
                    'required' => false,
                    'class' => 'form-control',
                    'maxlength' => 50,
                ),
                'trim' => true,
            ))
            ->add('correo', 'Symfony\Component\Form\Extension\Core\Type\EmailType', array(
                'label' => 'Correo Electronico: ',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 50,
                ),
                'trim' => true,
            ))
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
