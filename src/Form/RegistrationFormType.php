<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Электронная почта',
                'attr' => ['placeholder' => 'Укажите эл.почту'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Пожалуйста, введите адрес электронной почты',
                    ]),
                ],
            ])
            ->add('login', null, [
                'label' => 'Логин',
                'attr' => ['placeholder' => 'Укажите логин'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Пожалуйста, введите логин',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Пароль',
                    'attr' => ['placeholder' => 'Придумайте пароль'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Пожалуйста, введите пароль',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Ваш пароль должен содержать не менее {{ limit }} символов',
                            'max' => 4096,
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Повтор пароля',
                    'attr' => ['placeholder' => 'Повторите пароль'],
                ],
                'invalid_message' => 'Пароли должны совпадать',
                'mapped' => false,
            ])
            ->add('userpicFile', FileType::class, [
                'label' => 'Фотография профиля',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Пожалуйста, загрузите изображение в формате JPEG или PNG',
                    ]),
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
