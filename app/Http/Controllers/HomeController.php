<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inspection;
use App\Revision;

class HomeController extends Controller
{
    
    public function index(){
        $inspections = Inspection::all();
        $total_inspections = Inspection::all()->count();
        $total_revisions = Revision::all()->count();
        $revisions = Revision::all();
        $bad_pieces = 0;
        $total_pieces = 0;

        foreach($revisions as $revision) {
            $bad_pieces += $revision->bad_pieces;
            $total_pieces += $revision->total;
        }

        return view('home', [
            'inspections'   => $inspections,
            'total_inspections' => $total_inspections,
            'total_revisions'   => $total_revisions,
            'bad_pieces' => $bad_pieces,
            'total_pieces'  => $total_pieces
        ]);
    }

}
