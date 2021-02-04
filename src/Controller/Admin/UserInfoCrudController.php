<?php

namespace App\Controller\Admin;

use App\Entity\UserInfo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserInfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserInfo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateTimeFormat('y-M-d H:m:s')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            AssociationField::new('user'),
            ImageField::new('picture')
                ->setBasePath('/uploads/images')
                ->onlyOnIndex()
                ->setUploadDir('public/uploads/images'),
            TextField::new('pictureFile')->setFormType(VichImageType::class),
            IntegerField::new('age'),
            TextEditorField::new('description'),
            TextField::new('address'),
            UrlField::new('linkedin'),
            UrlField::new('github'),
            DateTimeField::new('createdAt')->onlyOnIndex(),
            DateTimeField::new('updatedAt')->onlyOnIndex(),
        ];
    }

}
