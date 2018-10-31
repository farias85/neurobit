<?php

namespace NB\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcedenciaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', null, array('attr' => array('class' => "form-control", 'style' => "width: 400px")))
            ->add('descripcion', null, array('label' => "Descripción", 'attr' => array('class' => "form-control", 'style' => "width: 400px")))
            ->add('fueraProvincia', null, array('label' => "¿Es de fuera de la Provincia?"));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\CommonBundle\Entity\Procedencia'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nb_commonbundle_procedencia';
    }


}
