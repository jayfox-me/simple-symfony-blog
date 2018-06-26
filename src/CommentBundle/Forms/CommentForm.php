<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 25.06.2018
 * Time: 21:41
 */

namespace CommentBundle\Forms;


use CommentBundle\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email');
        $builder->add('body');
        $builder->add('button', SubmitType::class, [
            'label' => 'Add comment'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class
        ]);
    }
}