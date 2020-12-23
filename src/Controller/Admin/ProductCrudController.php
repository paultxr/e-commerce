<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\PictureType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            AssociationField::new('artist'),
            TextEditorField::new('description'),
            IntegerField::new('year'),
            IntegerField::new('price'),
            AssociationField::new('type'),
            AssociationField::new('genre'),
            CollectionField::new('pictures')
            ->setEntryType(PictureType::class),
        ];
    }
}
