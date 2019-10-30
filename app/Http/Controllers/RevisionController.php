<?php

namespace App\Http\Controllers;

use App\Inspection;
use App\Revision;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function store(Request $request){
        $total = $request->bad_pieces + $request->good_pieces;

        $validate = $this->validate($request, [
            'box_number'    => 'required',
            'good_pieces'   => 'required',
            'bad_pieces'    => 'required',
        ]);

        if($validate) {
            $data = [
                'code'      => 422,
                'status'    => 'error',
                'message'   => 'Error de validación',
                'errors'    => $validate
            ];
        }

        $revision = Revision::create([
            'inspection_id' => $request->inspection_id,
            'box_number'    => $request->box_number,
            'good_pieces'   => $request->good_pieces,
            'bad_pieces'    => $request->bad_pieces,
            'total'         => $total
        ]);

        $data = [
            'code'      => 200,
            'status'    => 'success',
            'inspection'    => $revision
        ];

        return response()->json($data, $data['code']);
    }

    public function show($id){

        $revisions = Revision::where('inspection_id', $id)->get();

        return response()->json($revisions);
    }

    public function getPieces($id){
        $revisions = Revision::where('inspection_id', $id)->get();

        $piezas_buenas = 0;
        $piezas_malas = 0;

        foreach ($revisions as $revision) {
            $piezas_buenas += $revision->good_pieces;
            $piezas_malas += $revision->bad_pieces;
        }

        $total = $piezas_buenas + $piezas_malas;

        // Porcentaje de buenas
        $porcentaje_buenas = $piezas_buenas * 100 / $total;

        // Porcentaje de malas
        $porcentaje_malas = $piezas_malas * 100 / $total;

        $data = [
            'piezas_malas' => $piezas_malas,
            'piezas_buenas' => $piezas_buenas,
            'porcentaje_buenas' => $porcentaje_buenas,
            'porcentaje_malas'  => $porcentaje_malas
        ];

        return response()->json($data, 200);
    }

}
