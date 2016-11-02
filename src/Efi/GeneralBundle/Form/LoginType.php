<?php

namespace Efi\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cedula', IntegerType::class, array(
                'label' => 'Cedula de Identidad: ',
                'required' => true,
                'attr' => array(
                    'min' => 3000000,
                    'max' => 100000000,
                    'maxlength' => 20,
                    'autofocus' => 'autofocus',
                ),
            ))
            ->add('contrasena', PasswordType::class, array(
                'label' => 'Contrasena: ',
                'attr' => array(
                    'required' => false,
                    'maxlength' => 50,
                ),
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Efi\GeneralBundle\Entity\Login'
        ));
    }
}
