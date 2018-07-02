<?php
/**
 * Created by PhpStorm.
 * User: ааы
 * Date: 30.06.2018
 * Time: 13:03
 */

namespace App\Form;


use App\Entity\MessagesFromUsers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::Class)
            ->add('email', EmailType::Class)
            ->add('message', TextareaType::Class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MessagesFromUsers::class
        ));
    }
}