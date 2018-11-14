<?php

namespace NB\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('fecha', TextType::class, array('attr' => array('class' => 'form-control default-date-picker', 'style' => 'width: 200px')))
            ->add('horaInicio', null, array('label' => 'Hora de Inicio'))
            ->add('horaFin', null, array('label' => 'Hora de Fin'))
            ->add('asignacion', null, array('label' => 'Asignación','attr' => array('class' => 'form-control', 'style' => 'width: 200px')));
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
