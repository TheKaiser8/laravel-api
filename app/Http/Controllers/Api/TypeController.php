<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    // metodo pubblico che legge, tramite il model, tutte le tipologie (types)
    public function index()
    {
        $types = Type::all();

        return $types;
    }
}
