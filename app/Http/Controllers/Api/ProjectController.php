<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // metodo pubblico che legge, tramite il model, tutti i dati dei progetti
    public function index()
    {
        $projects = Project::with('type', 'technologies')->get(); // utilizzo metodo EAGER LOADING with() per ricevere tutti dati dei progetti (model principale) relazionati con le altre entità (tabelle)

        return $projects;
    }
}
