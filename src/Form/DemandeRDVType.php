<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\RDV;
use App\Entity\Statut;
use App\Entity\User;
use App\Repository\MedecinRepository;
use App\Repository\StatutRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeRDVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add(
                'medecin',
                EntityType::class,
                array(
                    'class' => User::class,
                    'placeholder' => "Veuillez choisir un médecin",
                    'query_builder' => function (UserRepository $userRepo) {
                        return $userRepo->createQueryBuilder('u')
                            ->where('u.roles LIKE :roles')
                            ->setParameter('roles', '%"ROLE_MEDECIN"%');
                    }
                )
            )
            ->add('date', DateType::class)
            ->add('heure', TimeType::class)
            ->add('duree', TimeType::class, array(
                'empty_data' => "00:00:00",
            ))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RDV::class,
        ]);
    }
}
