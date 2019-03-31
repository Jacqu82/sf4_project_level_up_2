<?php

namespace App\Form;

use App\Entity\Article;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $article = $options['data'] ?? null;
        $isEdit = $article && $article->getId();

        $builder
            ->add('title', TextType::class, [
                'help' => 'Choose something catchy!'
            ])
            ->add('content', null, [
                'rows' => 3
            ])
            ->add('author', UserSelectTextType::class, [
                'disabled' => $isEdit
            ])
            ->add('location', ChoiceType::class, [
                'placeholder' => 'Choose a location',
                'choices' => [
                    'The Solar System' => 'solar_system',
                    'Near a star' => 'star',
                    'Interstellar Space' => 'interstellar_space'
                ],
                'required' => false
            ])
            ->add('specificLocationName', ChoiceType::class, [
                'placeholder' => 'Where exactly?',
                'choices' => [
                    'TODO' => 'TODO'
                ],
                'required' => false
            ])
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

        if ($options['include_publish_at']) {
            $builder
                ->add('publishedAt', null, [
                    'widget' => 'single_text'
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'include_publish_at' => false
        ]);
    }
}
