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

use Doctrine\ORM\EntityRepository;

class PersonaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $vvaRolFamilia = 'per_rol';
        $builder
            ->add('rolFamilia', 'entity',
                array(
                    'class' => 'EfiGeneralBundle:ValorVariable',
                    'label' => 'Rol en Familia: ',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('VVA')
                            ->orderBy('VVA.orden', 'ASC')
                            ->where('VVA.codigo = :codigo')
                            ->setParameter('codigo', 'per_rol');                    },
                    'choice_label' => 'descripcion',
                ))
            ->add('metodoGanar', 'entity',
                array(
                    'class' => 'EfiGanadosBundle:MetodoGanar',
                    'label' => 'Como fue ganado: ',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('fechaGanado', 'Symfony\Component\Form\Extension\Core\Type\DateType', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Fecha de Conversion: ',
                'attr' => array(
                    'class' => 'form-control',
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
//            ->add('nombreFamilia', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
//                'label' => 'Identificación de la Familia: ',
//                'required' => true,
//                'attr' => array(
//                    'required' => true,
//                    'class' => 'form-control',
//                    'maxlength' => 50,
//                ),
//                'trim' => true,
//                'mapped' => false
//            ))
//            ->add('direccionFamilia', 'Symfony\Component\Form\Extension\Core\Type\TextType', array(
//                'label' => 'Dirección de Familia (Referencial): ',
//                'required' => false,
//                'attr' => array(
//                    'required' => false,
//                    'class' => 'form-control',
//                    'maxlength' => 500,
//                ),
//                'trim' => true,
//                'mapped' => false
//            ))
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
