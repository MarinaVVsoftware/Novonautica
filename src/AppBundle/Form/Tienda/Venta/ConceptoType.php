<?php

namespace AppBundle\Form\Tienda\Venta;

use AppBundle\Form\EventListener\ProductoFieldListener;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConceptoType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $moneySetting = [
            'currency' => 'MXN',
            'divisor' => 100,
            'grouping' => true,
            'data' => 0,
            'attr' => ['class' => 'money-input']
        ];

        $builder->addEventSubscriber(new ProductoFieldListener($this->entityManager));

        $builder->add(
            'cantidad',
            IntegerType::class,
            [
                'data' => 0,
                'attr' => ['min' => 0],
            ]
        );

        $builder->add(
            'precioUnitario',
            MoneyType::class,
            $moneySetting
        );


        $builder->add(
            'descuento',
            PercentType::class,
            [
                'data' => 0,
                'type' => 'integer',
                'attr' => ['class' => 'discount-input']
            ]
        );

        $builder->add(
            'iva',
            MoneyType::class,
            $moneySetting
        );

        $builder->add(
            'subtotal',
            MoneyType::class,
            $moneySetting
        );

        $builder->add(
            'total',
            MoneyType::class,
            $moneySetting
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tienda\Venta\Concepto',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tienda_venta_concepto';
    }


}