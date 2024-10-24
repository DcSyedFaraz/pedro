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
    public $invoice;
    public $deleteRoute;
    public $addRoute;

    public function __construct($invoice, $deleteRoute, $addRoute = null)
    {
        $this->invoice = $invoice;
        $this->deleteRoute = $deleteRoute;
        $this->addRoute = $addRoute;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.invoice-service-table');
    }
}
