<?php

namespace App\Provider\DataTable;

use App\Entity\Combo;
use Doctrine\ORM\QueryBuilder;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Component\HttpFoundation\Request;

class ComboTableProvider extends AbstractDataTable
{

    public function __construct(
        protected DataTableFactory $dataTableFactory,
    ) {
    }


    public function getTable(Request $request): DataTable
    {
        return $this->dataTableFactory->create()
            ->add('firstIngredient', TextColumn::class, [
                'label' => 'First Ingredient',
                'field' => 'ef.name',
                'searchable' => true,
            ])
            ->add('secondIngredient', TextColumn::class, [
                'label' => 'Second Ingredient',
                'field' => 'es.name',
                'searchable' => true,
            ])
            ->add('result', TextColumn::class, [
                'label' => 'Result',
                'field' => 'r.name',
                'searchable' => true,
            ])
            ->add('crylo', TextColumn::class, [
                'label' => 'Crylo',
                'field' => 'c.crylo',
                'searchable' => false,
            ])
            ->add('deto', TextColumn::class, [
                'label' => 'Deto',
                'field' => 'c.deto',
                'searchable' => false,
            ])
            ->add('mozo', TextColumn::class, [
                'label' => 'Mozo',
                'field' => 'c.mozo',
                'searchable' => false,
            ])
            ->add('ruto', TextColumn::class, [
                'label' => 'Ruto',
                'field' => 'c.ruto',
                'searchable' => false,
            ])
            ->add('effect', TextColumn::class, [
                'label' => 'Effect',
                'field' => 'c.effect',
                'render' => fn($line, Combo $combo) => "<textarea name='effect' id='effect_{$combo->getId()}'>{$combo->getEffect()}</textarea>",
            ])
            ->add('cooldown', TextColumn::class, [
                'label' => 'Cooldown',
                'field' => 'c.cooldown',
                'render' => fn($line, Combo $combo) => "<input type='text' name='cooldown' id='cooldown_{$combo->getId()}' value='{$combo->getCooldown()}'>",
            ])
            ->add('isCapped', TextColumn::class, [
                'label' => 'Is Capped',
                'field' => 'c.isCapped',
            ])
            ->add('action', TextColumn::class, [
                'label' => 'Action',
                'render' => fn ($value, Combo $combo) => "<button class='btn btn-primary js-save-combo' data-target='{$combo->getId()}'> Save </button>",
                'searchable' => false,
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Combo::class,
                'query' => function (QueryBuilder $qb) {
                    $qb
                        ->select('c')
                        ->addSelect('ef')
                        ->addSelect('es')
                        ->addSelect('r')
                        ->from(Combo::class, 'c')
                        ->leftJoin('c.firstIngredient', 'ef')
                        ->leftJoin('c.secondIngredient', 'es')
                        ->leftJoin('c.result', 'r');
                },
            ])
            ->handleRequest($request);
    }
}
