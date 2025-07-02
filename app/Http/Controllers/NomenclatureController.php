<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nomenclature;

class NomenclatureController extends Controller
{
    public function index()
    {
        $nomenclatures = Nomenclature::with('bibliographies')->get();
        return response()->json($nomenclatures);
    }

}
