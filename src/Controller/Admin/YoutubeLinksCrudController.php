<?php

namespace App\Controller\Admin;

use App\Entity\YoutubeLinks;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class YoutubeLinksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return YoutubeLinks::class;
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
