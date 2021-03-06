<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextareaType::class,array('attr'=>array('class'=>'form-control')))
            ->add('lastName',TextareaType::class,array('required'=>false, 'attr'=>array('class'=>'form-control')))
            ->add('email',TextareaType::class,array('required'=>false, 'attr'=>array('class'=>'form-control')))
            ->add('phoneNumber',TextareaType::class,array('required'=>false, 'attr'=>array('class'=>'form-control')))
            ->add('save',SubmitType::class,array('label'=>'Save','attr'=>array('class'=>'btn btn-primary m-3')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}