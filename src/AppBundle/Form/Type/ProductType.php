<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label'=>'form.name'))
            ->add('code', TextType::class, array('label'=> 'form.code'))
            ->add('brand', TextType::class, array('label'=> 'form.brand'))
            ->add('description', TextareaType::class, array('label'=> 'form.description'))
            ->add('price', NumberType::class, array('label'=> 'form.price'))
            ->add('categoryId', EntityType::class, array(
                'label'=>'form.category',
                'class'=>'AppBundle\Entity\Category',
                'choice_label'=>'name',
                'placeholder'=>'form.select'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_category';
    }


}
