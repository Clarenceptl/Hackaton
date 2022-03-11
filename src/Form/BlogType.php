<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
// use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BlogType extends AbstractType
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('contenue')
            ->add('langue', ChoiceType::class, [
                'choices' => [
                    'mapped' => false,
                    'AN'=>'AN',
                    'FR'=>'FR',
                    'AL'=>'AL', 
                ],
            ])
            ->add('categories' , EntityType::class,[
                'class'=> Category::class,
                'choice_label'=> 'nom',
                'required' => false,
                // 'multiple' => false,
                // 'expanded' => false,
                //     'label_attr' => array(
                //         'class' => 'radio-inline'
                //     )
            ])
            // ->add('envoyé', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}