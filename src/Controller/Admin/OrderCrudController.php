<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Commande')
            ->setEntityLabelInPlural('Commandes');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail');
        // ->remove(Crud::PAGE_INDEX, Action::NEW)
        // ->remove(Crud::PAGE_INDEX, Action::EDIT)
        // ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            // DateTimeField::new('createdAt','Passée le'),
            TextField::new('user.fullname', 'Utilisateur'),
            MoneyField::new('total')->setCurrency('XAF'),
            BooleanField::new('isPaid', 'Payée')

        ];
    }
}
