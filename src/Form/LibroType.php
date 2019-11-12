<?php

namespace App\Form;

use App\Entity\Libros;
use App\Entity\Autores;
use App\Entity\Categorias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;




class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titulo');
            $builder->add('Autor', EntityType::class, [
                'class' => Autores::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('A')
                        ->orderBy('A.Autor', 'ASC');
                },
                'choice_label' => 'Autor',
            ]);
            $builder->add('Categoria', EntityType::class, [
                'class' => Categorias::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('C')
                        ->orderBy('C.Categoria', 'ASC');
                },
                'choice_label' => 'Categoria',
            ])
            ->add('Enviar', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Libros::class,
        ]);
    }
}
