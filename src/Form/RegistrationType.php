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
                    'placeholder' => 'Votre adresse mail',
                    'name' => 'email',
                    'class' => 'input-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                ],
                'label' => 'Votre adresse mail',
                'label_attr' => [
                    'class' => 'hidden block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300',
                    'aria-hidden' => true,
                ]
            ])
            ->add('username', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre nom d\'utilisateur',
                    'name' => 'username',
                    'class' => 'input-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                ],
                'label' => 'Votre nom d\'utilisateur',
                'label_attr' => [
                    'class' => 'hidden block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300',
                    'aria-hidden' => true,
                ]
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre mot de passe',
                    'name' => 'password',
                    'class' => 'input-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                ],
                'label' => 'Votre mot de passe',
                'label_attr' => [
                    'class' => 'hidden block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300',
                    'aria-hidden' => true,
                ]
            ])
            ->add('password_repeat', PasswordType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Répéter votre mot de passe',
                    'name' => 'password_repeat',
                    'class' => 'input-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                ],
                'label' => 'Répéter votre mot de passe',
                'label_attr' => [
                    'class' => 'hidden block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300',
                    'aria-hidden' => true,
                ]
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
