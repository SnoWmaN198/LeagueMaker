<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class)
            ->add('email', EmailType::class)                // check if this works
            ->add('password',
                RepeatedType::class,
                array(
                    'type' => PasswordType::class,
                    'invalid_message'   => 'The password fields don\'t match',
                    'first_options'     => array('label' => 'Password'),
                    'second_options'    => array('label' => 'Repeat password'))
                );
        
            if ($options['standalone']) {
                $builder->add('submit', SubmitType::class);
            }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'standalone' => false
        ]);
    }
}
