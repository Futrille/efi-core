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

use Efi\GeneralBundle\Entity\ValorVariable;
use Efi\GanadosBundle\Entity\MetodoGanar;

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
            ->add('idRolFamilia', 'entity',
                array(
                    'class' => ValorVariable::class,
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
                    'class' => MetodoGanar::class ,
                    'label' => 'Como fue ganado: ',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('fechaGanado', DateType::class, array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Fecha de Conversion: ',
                'attr' => array(
                    'class' => 'form-control',
                ),
            ))
            ->add('nombres', TextType::class, array(
                'label' => 'Nombres: ',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 100,
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
