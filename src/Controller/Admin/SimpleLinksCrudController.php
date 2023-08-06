<?php

namespace App\Controller\Admin;

use App\Entity\SimpleLinks;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SimpleLinksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SimpleLinks::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
