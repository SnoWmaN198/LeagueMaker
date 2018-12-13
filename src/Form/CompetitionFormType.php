<?php

namespace App\Form;

use App\Entity\Competition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CompetitionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)            
            ->add('eventDate', DateType::class)
            ->add('image', TextType::class)
            ->add('numberOfPlayers', IntegerType::class)
            ->add('typeId', ChoiceType::class, array(
                'choices' => array('Knockout' => true, 'League' => true)
            ));
        
        if ($options['standalone']) {
            $builder->add('submit', SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
            'standalone' => false
        ]);
    }
}
