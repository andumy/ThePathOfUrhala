<?php

namespace App\Provider\DataTable;

use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractDataTable
{
    public function __construct(
        protected DataTableFactory $dataTableFactory
    ) {
    }

    abstract public function getTable(Request $request): DataTable;
}
