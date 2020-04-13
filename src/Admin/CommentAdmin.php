<?php

namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Blog;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


//user
//comment
//approved
//blog
//created
//updated

final class CommentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('user', TextType::class)
            ->add('comment', TextareaType::class)
            ->add('blog', ModelType::class, [
                'class' => Blog::class,
                'property' => 'title',
            ])
            ->add('approved')
            ->add('created')
            ->add('updated')
        ;

    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('blog')
            ->add('user');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
       $listMapper
           ->addIdentifier('blog')
           ->addIdentifier('user')
                  ;


    }
}