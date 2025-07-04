<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BibliographyImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreExcelImportRequest;
use Symfony\Component\ErrorHandler\Debug;

class ExcelImportController extends Controller
{
    public function importBibliography(StoreExcelImportRequest $request)
    {
        $request->validated();

        $import = new BibliographyImport();
        Excel::import($import, $request->file('excel_file'));

        return response()->json([
            'message' => 'File parsed successfully',
            'bibliographies' => $import->getMappedData()->all(),
        ]);
    }
}
