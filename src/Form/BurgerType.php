<?php

namespace App\Form;

use App\Entity\Burger;
use App\Entity\Image;
use App\Entity\Oignon;
use App\Entity\Pain;
use App\Entity\Sauce;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BurgerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('price')
            ->add('pain', EntityType::class, [
                'class' => Pain::class,
                'choice_label' => 'nom',
            ])
            ->add('sauces', EntityType::class, [
                'class' => Sauce::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
            ->add('image', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'id',
            ])
            ->add('oignons', EntityType::class, [
                'class' => Oignon::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom du burger'
            ])
            ->add('save', SubmitType::class,[
                'attr' => ['class' => 'save']
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Burger::class,
        ]);
    }
}
