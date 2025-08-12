<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OccurrencesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SingleOccurrenceExport;
use App\Exports\NomenclatureExport;
use App\Exports\BibliographyExport;
use App\Exports\ProjectExport;
use Illuminate\Support\Facades\Log;



class ExcelExportController extends Controller
{
    public function exportExcelOccurrences(Request $request)
    {
        $ids = $request->input('ids', []);
        return Excel::download(new OccurrencesExport($ids), 'occurrences.xlsx');
    }

    public function exportExcelNomenclatures(Request $request)
    {
        $ids = $request->input('ids', []);
        return Excel::download(new NomenclatureExport($ids), 'nomenclatures.xlsx');
    }

    public function exportExcelBibliographies(Request $request)
    {
        $ids = $request->input('ids', []);

        return Excel::download(new BibliographyExport($ids), 'bibliographies.xlsx');
    }

    public function exportExcelProjects(Request $request)
    {
        $ids = $request->input('ids', []);
        return Excel::download(new ProjectExport($ids), 'projects.xlsx');
    }

    public function exportSingleExcel($id)
    {
        return Excel::download(new SingleOccurrenceExport($id), "occurrence_{$id}.xlsx");
    }
}
