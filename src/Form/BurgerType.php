<?php
namespace App\Form;

use App\Entity\Burger;
use App\Entity\Image;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BurgerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom du burger'
        ])
        ->add('price', NumberType::class, [
            'label' => 'Prix'
        ])
        ->add('pain', EntityType::class, [
            'label' => 'Pain',
            'class' => Pain::class,
            'choice_label' => 'nom',
            'multiple' => false,
            'expanded' => false,
            'required' => true,
        ])
        ->add('oignons', EntityType::class, [
            'label' => 'Oignon',
            'class' => Oignon::class,
            'choice_label' => 'nom',
            'multiple' => false,
            'expanded' => false,
            'required' => true,
            'by_reference' => false
        ])
        ->add('sauces', EntityType::class, [
            'label' => 'Sauce',
            'class' => Sauce::class,
            'choice_label' => 'nom',
            'multiple' => true,
            'expanded' => true,
            'required' => true,
            'by_reference' => false // si ManyToMany : by_reference => false
        ])
        ->add('image', EntityType::class, [
            'class' => Image::class,
            'choice_label' => 'alt_text', 
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
