<?php


namespace App\Form;
use App\Entity\Tektura;
use Doctrine\DBAL\Types\BigIntType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TekturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwa', TextType::class)
            ->add('gramatura',TextType::class)
            ->add('Zapisz', SubmitType::class)
            ->add('id_post', HiddenType::class, ['mapped' => false])

        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Tektura::class
        ]);
    }
}