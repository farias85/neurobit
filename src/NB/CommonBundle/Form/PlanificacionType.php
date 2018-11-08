<?php

namespace NB\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanificacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
            ->add('horaInicio', null, array('label' => 'Hora de Inicio'))
            ->add('horaFin', null, array('label' => 'Hora de Fin'))
            ->add('asignacion', null, array('label' => 'Asignación'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\CommonBundle\Entity\Planificacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nb_commonbundle_planificacion';
    }


}
