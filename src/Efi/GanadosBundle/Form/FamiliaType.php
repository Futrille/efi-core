<?php

namespace Efi\GanadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class FamiliaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                'label' => 'Identificación de la Familia: ',
                'required' => true,
                'attr' => array(
                    'required' => true,
                    'class' => 'form-control',
                    'maxlength' => 50,
                ),
                'trim' => true
            ))
            ->add('direccion', TextType::class, array(
                'label' => 'Dirección de Familia (Referencial): ',
                'required' => false,
                'attr' => array(
                    'required' => false,
                    'class' => 'form-control',
                    'maxlength' => 500,
                ),
                'trim' => true
            ))
            //->add('estado')
            //->add('municipio')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Efi\GanadosBundle\Entity\Familia'
        ));
    }
}
