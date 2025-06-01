<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Expense;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpenseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', options: [
                'attr' => [
                    'placeholder' => 'Enter expense name',
                ],
            ])
            ->add('price', options: [
                'attr' => [
                    'placeholder' => 'Enter a price',
                ],
            ])
            ->add('date', options: [
                'widget' => 'single_text',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'required' => false,
                'placeholder' => 'Select a category',
            ])
            ->add('newCategory', TextType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Add a new category',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
        ]);
    }
}
