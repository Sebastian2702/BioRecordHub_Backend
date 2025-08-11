<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OccurrencesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SingleOccurrenceExport;

class ExcelExportController extends Controller
{
    public function exportExcelOccurrences()
    {
        return Excel::download(new OccurrencesExport, 'occurrences.xlsx');
    }

    public function exportSingleExcel($id)
    {
        return Excel::download(new SingleOccurrenceExport($id), "occurrence_{$id}.xlsx");
    }
}
