<?php


namespace App\Form;
use App\Entity\Papier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PapierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa', TextType::class)
            ->add('gramatura',TextType::class)
            ->add('producent',TextType::class)
            ->add('Zapisz', SubmitType::class)
            ->add('id_post', HiddenType::class, ['mapped' => false])

        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Papier::class
        ]);
    }
}