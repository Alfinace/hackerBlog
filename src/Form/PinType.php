<?php
/*
 * @Author: your name
 * @Date: 2020-08-07 18:10:49
 * @LastEditTime: 2020-08-07 18:12:36
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Form/PinType.php
 */

namespace App\Form;

use App\Entity\Pin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title',TextType::class,[
                'attr'=>[
                    'required'=>true,
                    'class'=>'form-control form-control-sm',
                ],
                'label'=>'Title'
            ])
            ->add('description',TextareaType::class,[
                'attr'=>[
                    'required'=>true,
                    'class'=>'form-control form-control-sm'
                ],
                'label'=>'Description'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pin::class,
        ]);
    }
}
