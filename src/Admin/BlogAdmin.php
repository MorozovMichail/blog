<?php

namespace App\Admin;

use App\Entity\Blog;
use App\Entity\Comment;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;




//title
//author
//blog
//image
//tags
//comments
//created
//updated
//slug
final class BlogAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class);
        $formMapper->add('author', TextType::class);
        $formMapper->add('blog', TextareaType::class);
        $formMapper->add('image');
        $formMapper->add('tags');
        $formMapper->add('created');
        $formMapper->add('updated');
        $formMapper->add('slug');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');

    }
}