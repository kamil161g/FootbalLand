<?php


namespace App\Form;


use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Napisz komentarz, aby skomentować.'
                                 ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Komentarz musi składać się z minimun 10 znaków.'
                                ]),
                ]])
            ->add('submit', SubmitType::class, ['label' => 'Skomentuj']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Comment::class
            ]);
    }
}