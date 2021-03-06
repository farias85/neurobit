<?php

namespace NB\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsignacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tiempo', null, array('label' => "Tiempo (min)", 'attr' => array('class' => "form-control", 'style' => "width: 200px")))
            ->add('disponible')
            ->add('equipo',null, array( 'attr' => array('class' => "form-control", 'style' => "width: 200px")))
            ->add('prueba',null, array( 'attr' => array('class' => "form-control", 'style' => "width: 200px")));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\CommonBundle\Entity\Asignacion',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nb_commonbundle_asignacion';
    }


}
