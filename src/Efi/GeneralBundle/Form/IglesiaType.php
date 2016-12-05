<?php

namespace Efi\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Efi\GeneralBundle\Entity\ValorVariable;
use Efi\GeneralBundle\Entity\Pais;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class IglesiaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('idPadre')
//            ->add('estatus')
            ->add('nombre', TextType::class, array(
                'label' => 'Nombre: ',
                'required' => true,
                'attr' => array(
                    'required' => true,
                    'class' => 'form-control',
                    'maxlength' => 100,
                ),
                'trim' => true
            ))
            ->add('abreviacion', TextType::class, array(
                'label' => 'Abreviación: ',
                'required' => true,
                'attr' => array(
                    'required' => true,
                    'class' => 'form-control',
                    'maxlength' => 10,
                ),
                'trim' => true
            ))
            ->add('web', TextType::class, array(
                'label' => 'Página Web: ',
                'attr' => array(
                    'class' => 'form-control',
                    'maxlength' => 100,
                ),
                'trim' => true
            ))
            ->add('pais', 'entity',
                array(
                    'class' => Pais::class,
                    'label' => 'País: ',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
//                    'query_builder' => function (EntityRepository $er) {
//                        return $er->createQueryBuilder('VVA')
//                            ->orderBy('VVA.orden', 'ASC')
//                            ->where('VVA.codigo = :codigo')
//                            ->setParameter('codigo', 'igl_estatus');                    },
//                    'choice_label' => 'descripcion',
                ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Efi\GeneralBundle\Entity\Iglesia'
        ));
    }
}
