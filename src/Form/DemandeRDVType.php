<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\RDV;
use App\Repository\MedecinRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeRDVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class)
            ->add('heure', TimeType::class)
            ->add('duree',)
            ->add('medecin', EntityType::class, array(
                'class' => Medecin::class,
                'placeholder' => "Veuillez choisir un médecin",
                'query_builder' => function(MedecinRepository $medecinRepo, ManagerRegistry $doctrine) {
                    $repository=$doctrine->getRepository(Medecin::class);
                    $lesMedecin=$repository->findAll();

                    return $medecinRepo->createQueryBuilder('m');   
                }
            )

            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RDV::class,
        ]);
    }
}
