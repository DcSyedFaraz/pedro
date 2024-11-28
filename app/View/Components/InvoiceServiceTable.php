<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InvoiceServiceTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $route;
    public $rows;

    /**
     * Create a new component instance.
     *
     * @param string $route
     * @param array|null $rows
     * @return void
     */
    public function __construct($route, $rows = null)
    {
        $this->route = $route;
        $this->rows = $rows && count($rows) > 0 ? $rows : [
            [
                'description' => '',
                'qty_hrs' => '',
                'rate' => '',
                'margin_tax' => '',
                'total' => '',
                'cost' => '',
            ],
        ];
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // dd($this->rows);
        return view('components.invoice-service-table');
    }
}
