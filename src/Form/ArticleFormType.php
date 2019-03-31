<?php

namespace App\Form;

use App\Entity\Article;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ArticleFormType extends AbstractType
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'help' => 'Choose something catchy!'
            ])
            ->add('content')
            ->add('publishedAt', null, [
                'widget' => 'single_text'
            ])
            ->add('author', UserSelectTextType::class)
//            ->add('author', EntityType::class, [
//                'class' => User::class,
//                'choice_label' => function (User $user) {
//                    return sprintf('(%d) %s', $user->getId(), $user->getFirstName());
//                },
//                'placeholder' => 'Choose an author',
//                'invalid_message' => 'Symfony is too smart for your hacking!',
//                'choices' => $this->userRepository->findAllFirstNameAlphabetical(),
////                'query_builder' => function (UserRepository $repo) {
////                    return $repo->findOrderedByName();
////                }
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }
}
