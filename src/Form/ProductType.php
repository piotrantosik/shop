<?php

namespace App\Form;

use App\Domain\Command\Shop\Product\CreateNewProduct;
use App\Form\Type\SimpleMoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.product.name.label',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'form.product.description.label',
            ])
            ->add('price', SimpleMoneyType::class, [
                'label' => 'form.product.price.label',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateNewProduct::class,
            'empty_data' => function (FormInterface $form) {
                return new CreateNewProduct(
                    $form->get('name')->getData(),
                    $form->get('description')->getData(),
                    $form->get('price')->getData()
                );
            }
        ]);
    }
}
