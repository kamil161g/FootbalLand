<?php


namespace App\Form;


use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ArticleType
 * @package App\Form
 */
class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('title', TextType::class,[
                    'constraints' => [
                    new NotBlank([
                        'message' => 'Pole nie może być puste'
                    ]),
                    new Length([
                        'min' => 8,
                        'max' => 32,
                        'minMessage' => 'Tytuł nie może być krótszy niż 8 znaków.',
                        'maxMessage' => 'Tytuł nie może być dłuższy niż 32 znaki.'
                    ]),
                ]])
                ->add('text', TextareaType::class,[
                    'constraints' => [
                    new Length([
                        'min' => 32,
                        'minMessage' => 'Artykuł nie może być krótszy niż 32 znaki.',
                    ]),
                    new NotBlank([
                        'message' => 'Pole nie może być puste'
                    ]),
                ]])
                ->add('file', FileType::class, ['label' => 'Dodaj zdjęcia'])
                ->add('submit', SubmitType::class, ['label' => 'Wyślij']);
        }

    /**
     * @param OptionsResolver $resolver
     */
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver
                ->setDefaults([
                    'data_class' => Article::class
                ]);
        }
}