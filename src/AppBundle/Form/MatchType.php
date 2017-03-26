<?php

namespace AppBundle\Form;

use AppBundle\Entity\Match;
use AppBundle\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class MatchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startTime', DateTimeType::class, array(
                'widget' => 'single_text', 'format' => 'dd.MM.yyyy hh:mm',
                ))
            ->add('finishTime', DateTimeType::class, array(
                'widget' => 'single_text', 'format' => 'dd.MM.yyyy hh:mm',
                ))
            ->add('players', CollectionType::class, array(
                'allow_add' => true,
                'entry_type' => EntityType::class,
                'entry_options' => array(
                    'class' => Player::class
                ),
                'constraints' => new Count(2)
            ))
            ->add('matchLog')
            ->add('winner');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Match::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'match';
    }


}
