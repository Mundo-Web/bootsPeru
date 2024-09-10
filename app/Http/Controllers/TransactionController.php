<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use Illuminate\Http\Request;

class TransactionController extends BasicController
{
    public $model = SaleDetail::class;
    public $reactView = 'Admin/Transactions';
    public $prefix4filter = 'sale_details';

    public function setPaginationInstance(string $model)
    {
        return $model::select([
            'sale_details.*'
        ])
        ->with(['sale', 'sale.status'])
        ->join('sales AS sale', 'sale.id', 'sale_details.sale_id')
        ->join('statuses AS status', 'status.id', 'sale.status_id');
    }
}
