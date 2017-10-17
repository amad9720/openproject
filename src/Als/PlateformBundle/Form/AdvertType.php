<?php

namespace Als\PlateformBundle\Form;

use Als\PlateformBundle\Repository\AdvertRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',      'date')
            ->add('title',     'text')
            ->add('content',   'textarea')
            ->add('author',    'text')
            ->add('categories', 'collection', array(
                'type' => new CategoryType(),
                'allow_add' => true,
                'allow_delete' => true
            ))
            ->add('categories', 'entity', array(
                'class'    => 'AlsPlateformBundle:Category',
                'property' => 'name',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('advert', 'entity', array(
                'class'    => 'AlsPlateformBundle:Advert',
                'property' => 'name',
                'query_builder' => function(AdvertRepository $repo) {
                    return $repo->getPublishedQueryBuilder();
                }
            ))
            ->add('published', 'checkbox', array('required' => false))
            ->add('image', new ImageType())
            ->add('save',      'submit')
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {

            }
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Als\PlateformBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'als_plateformbundle_advert';
    }


}
