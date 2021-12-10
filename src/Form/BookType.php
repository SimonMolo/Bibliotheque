<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Author;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('nbPages')
            ->add('Date')
            //je relie mon mon fichié a l'entité auteur.
            ->add('Author', EntityType::class, [

                'class'=>Author::class,
                // grace au choice label, j'insere dans le menu déroulant que je viens de générer
                // ce que je veut placer dedans.
                'choice_label'=>function($author){
                // grace a la Conquetenation, je demande a symfony de m'inserer le FirstName ainsi que le LastName.²
                return $author->getFirstName() .' '. $author->getLastName();
                }
            ])
            ->add('valider', submitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
