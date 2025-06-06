<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use Barryvdh\DomPDF\Facade\Pdf;

class FinanceController extends Controller
{
    public function generateFinancePDF()
    {
        $finances = Finance::all();
        $pdf = Pdf::loadView('pdfFinance', compact('finances'));
        return $pdf->download('finance_report.pdf');
    }
}
