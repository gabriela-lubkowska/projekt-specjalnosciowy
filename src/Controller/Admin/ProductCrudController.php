<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produkt kategorii')
            ->setEntityLabelInPlural('Produkty kategorii')
            ->setSearchFields(['nazwa', 'cena'])
            ->setDefaultSort(['cena' => 'DESC']);

    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('kategoria'));
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('kategoria');
        yield TextField::new('nazwa');
        yield TextField::new('cena');
        yield BooleanField::new('czyDostepne');
        yield ImageField::new('photoFilename')->setBasePath('uploads/')->setUploadDir('public/uploads/');

    }
}
