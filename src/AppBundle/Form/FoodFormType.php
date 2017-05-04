<?php
//To create form
//First, right click on AppBundle folder, select New -> Select Form. Type FoodFormType for example. -> It will create this file.
//FormType is basically a form recipe.


namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FoodFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //add form fields here.
        $builder
            ->add('name')
            ->add('category')
            ->add('popularityCount')
            ->add('description')
            ->add('isPublished')
            ->add('type')
            ->add('publishedOn');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([                          //Make sure to add the entity here.
           'data_class' => 'AppBundle\Entity\Food'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_food_form_type';
    }
}
