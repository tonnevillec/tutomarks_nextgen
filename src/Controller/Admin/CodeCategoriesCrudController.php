<?php

namespace App\Controller\Admin;

use App\Entity\CodeCategories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CodeCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CodeCategories::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title'),
            TextField::new('code'),
            BooleanField::new('actif'),
        ];
    }
}
