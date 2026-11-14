<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SalesExport implements Export, WithMultipleSheets
{
    protected $start;
    protected $end;
    protected $cashier;

    public function __construct($start, $end, $cashier = null)
    {
        $this->start = $start;
        $this->end = $end;
        $this->cashier = $cashier;
    }

    public function sheets(): array
    {
        return [
            new SalesDataSheet($this->start, $this->end, $this->cashier),
            new ProductSalesSheet($this->start, $this->end, $this->cashier),
        ];
    }
}
