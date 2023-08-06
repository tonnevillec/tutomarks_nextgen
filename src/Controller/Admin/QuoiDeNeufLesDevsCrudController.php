<?php

namespace App\Controller\Admin;

use App\Entity\QuoiDeNeufLesDevs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class QuoiDeNeufLesDevsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuoiDeNeufLesDevs::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('title');
        yield UrlField::new('url');
        yield BooleanField::new('published');
        yield ImageField::new('image')
            ->setUploadDir('public/uploads/images/')
            ->setBasePath('/uploads/images/');

    }
}
