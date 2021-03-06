<?php

namespace AppBundle\Form\Astillero;


use AppBundle\Form\Astillero\Proveedor\BancoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class ProveedorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('password', TextType::class)
            ->add('razonsocial',TextType::class,[
                'label' => 'Razón Social',
                'required' => false
            ])
            ->add('correo')
            ->add('telefono',TextType::class,[
                'label' => 'Teléfono',
                'required' => false,
            ])
            ->add('porcentaje',TextType::class,[
                'attr' => ['class'=>'esdecimal']
            ])
            ->add('tipo',ChoiceType::class,[
                'choices'=>[ 'Externo'=>'0','Interno'=>'1' ],
                'label'=>'Tipo'
            ])
            ->add('bancos',CollectionType::class,[
                'entry_type' => BancoType::class,
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false
            ])
            ->add('trabajos',EntityType::class,[
                'class' => 'AppBundle\Entity\Astillero\Proveedor\Trabajo',
                'label' => false,
                'expanded' => true,
                'multiple' => true
            ])
            ->add('rfc',TextType::class,[
                'label' => 'RFC',
                'required' => false
            ])
            ->add('direccionfiscal',TextType::class,[
                'label' => 'Dirección fiscal',
                'required' => false
            ])
            ->add('proveedorcontratista',ChoiceType::class,[
                'choices'=>[ 'Proveedor'=>'0','Contratista'=>'1' ],
                'label'=>'Tipo Trabajador'
            ])
            ->add('empresa',EntityType::class,[
                'class' => 'AppBundle\Entity\Contabilidad\Facturacion\Emisor',
                'placeholder' => 'Seleccionar...',
                'constraints' => [new NotNull(['message' => 'Por favor selecciona una empresa'])]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Astillero\Proveedor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_astillero_proveedor';
    }
}
