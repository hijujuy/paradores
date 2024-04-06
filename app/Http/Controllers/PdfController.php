<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Shop;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function invoice(Sale $sale)
    {
        $shop = Shop::first();
        
        $pdf = Pdf::loadView('sales.invoice', compact('sale', 'shop'));
        $pdf->set_paper(array(0, 0, 200.44, 842.07), 'portrait');

        //$pdf = Pdf::loadView('sales.invoice', compact('sale', 'shop'));
        //return $pdf->download('invoice.pdf');
        return $pdf->stream('invoice.pdf');
    }
}
