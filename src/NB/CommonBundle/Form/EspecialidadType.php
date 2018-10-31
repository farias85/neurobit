<?php

namespace NB\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EspecialidadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', null, array('attr' => array('class' => "form-control", 'style' => "width: 400px")))
            ->add('descripcion', null, array('label' => "Descripción", 'attr' => array('class' => "form-control", 'style' => "width: 400px")));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NB\CommonBundle\Entity\Especialidad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nb_commonbundle_especialidad';
    }


}
