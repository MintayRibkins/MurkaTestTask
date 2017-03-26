<?php

namespace AppBundle\Form;

use AppBundle\Entity\Match;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
