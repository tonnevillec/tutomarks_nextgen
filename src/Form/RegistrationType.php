<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationType extends AbstractType
{
    protected TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre addresse mail',
                    'name' => 'email',
                    'class' => 'pl-2 outline-none border-none'
                ],
                'label_attr' => [
                    'class' => 'hidden',
                    'aria-hidden' => true
                ],
            ])
            ->add('username', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre nom d\'utilisateur',
                    'name' => 'username',
                    'class' => 'pl-2 outline-none border-none'
                ],
                'label_attr' => [
                    'class' => 'hidden',
                    'aria-hidden' => true
                ],
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre mot de passe',
                    'name' => 'password',
                    'class' => 'pl-2 outline-none border-none'
                ],
                'label_attr' => [
                    'class' => 'hidden',
                    'aria-hidden' => true
                ],
            ])
            ->add('password_repeat', PasswordType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Répéter votre mot de passe',
                    'name' => 'password_repeat',
                    'class' => 'pl-2 outline-none border-none'
                ],
                'label_attr' => [
                    'class' => 'hidden',
                    'aria-hidden' => true
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
            'translation_domain' => 'messages',
        ]);
    }
}
