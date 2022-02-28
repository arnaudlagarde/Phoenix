<?php

namespace App\Controller\Admin;

use App\Entity\Risk;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RiskCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Risk::class;
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
