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
            ->add('fechaNacimiento', DateType::class, array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Fecha de Nacimiento: ',
                'attr' => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('nacionalidad', ChoiceType::class, array(
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
            ->add('cedula', IntegerType::class, array(
                'label' => 'Cedula de Identidad: ',
                'attr' => array(
                    'class' => 'form-control',
                    'min' => 3000000,
                    'max' => 100000000,
                    'maxlength' => 20,
                    'autofocus' => 'autofocus',
                ),
            ))
            ->add('nombres', TextType::class, array(
                'label' => 'Nombres: ',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 100,
                ),
                'trim' => true,
            ))
            ->add('apellidos', TextType::class, array(
                'label' => 'Apellidos: ',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 100,
                ),
                'trim' => true,
            ))
            ->add('sexo', ChoiceType::class, array(
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
            ->add('direccion', TextType::class, array(
                'label' => 'Direccion de Referencia: ',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 200,
                ),
                'trim' => true,
            ))
            ->add('telefono', TextType::class, array(
                'label' => 'Telefono de Contacto: ',
                'required' => false,
                'attr' => array(
                    'required' => false,
                    'class' => 'form-control',
                    'maxlength' => 50,
                ),
                'trim' => true,
            ))
            ->add('correo', EmailType::class, array(
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
