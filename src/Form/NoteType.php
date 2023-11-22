<?php

namespace App\Form;

use App\Entity\Note;
use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('laNote', NumberType::class)
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => function ($matiere) {
                    return $matiere->getNom() . ' - Coeff. ' . $matiere->getCoeff();
                },
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter une note'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
