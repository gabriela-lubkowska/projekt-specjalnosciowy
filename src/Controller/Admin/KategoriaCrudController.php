<?php

namespace App\Controller\Admin;

use App\Entity\Kategoria;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class KategoriaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Kategoria::class;
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
