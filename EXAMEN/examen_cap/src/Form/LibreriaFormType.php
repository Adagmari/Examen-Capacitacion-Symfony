<?php

namespace App\Form;

use App\Entity\Libro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class LibreriaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder ->add('titulo', TextType::class, ['attr' =>['class'=>'form-control']]);
        $builder ->add('descripcion', TextType::class, ['attr' =>['class'=>'form-control']]);
        $builder ->add('anio', NumberType::class, ['attr' =>['class'=>'form-control']]);
        $builder ->add('autor', TextType::class, ['attr' =>['class'=>'form-control']]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
        ]);
    }
}
