<?php
/**
 * Created by PhpStorm.
 * User: lonestar
 * Date: 29/03/2019
 * Time: 17:01
 */

namespace App\Form;

use App\Entity\Departement;
use App\Entity\ContactForm;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Firstname', TextType::class)
            ->add('Lastname', TextType::class)
            ->add('Email', EmailType::class)
            ->add('Message', TextareaType::class)
            ->add('Departement', EntityType::class, [
                'class' => Departement::class,
                'choice_label' => 'nom'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class
        ]);
    }

}