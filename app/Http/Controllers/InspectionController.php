<?php

namespace App\Http\Controllers;

use App\Company;
use App\Inspection;
use App\Product;
use App\Revision;
use App\User;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index(){
        $inspections = Inspection::all();
        return view('inspections.index', [
            'inspections'   => $inspections
        ]);
    }

    public function detail($id){
        $inspection = Inspection::find($id);

        $revisions = Revision::where('inspection_id', $id)->get();

        $piezas_buenas = 0;
        $piezas_malas = 0;

        foreach ($revisions as $revision) {
            $piezas_buenas += $revision->good_pieces;
            $piezas_malas += $revision->bad_pieces;
        }

        $total = $piezas_buenas + $piezas_malas;

        $ppms = $piezas_malas / $total * 1000000;

        // Porcentaje de buenas
        if($total > 0) {
            $porcentaje_buenas = $piezas_buenas * 100 / $total;
        }else{
            $porcentaje_buenas = 0;
        }
        
        // Porcentaje de malas
        if($total > 0) {
            $porcentaje_malas = $piezas_malas * 100 / $total;
        }else{
            $porcentaje_malas = 0;
        }
        

        return view('inspections.detail', [
            'inspection'    => $inspection,
            'porcentaje_buenas' => $porcentaje_buenas,
            'porcentaje_malas' => $porcentaje_malas,
            'ppms'  => $ppms
        ]);
    }

    public function create(){
        $inspectors = User::all(); // MODIFICAR PARA QUE SOLO TRAEGA INSPECTORES
        $companies = Company::all();  
        $products = Product::all();

        return view('inspections.create', [
            'inspectors' => $inspectors,
            'companies' => $companies,
            'products'  => $products
        ]);
    }

    public function store(Request $request){
        
        $validate =$this->validate($request, [
            'area_trabajo'  => 'required',
            'inspector'     => 'required',
            'company'       => 'required',
            'product'       => 'required'
        ]);

        if($validate){
            $data = [
                'code'      => 422,
                'status'    => 'error',
                'message'   => 'Error de validación',
                'errors'    => $validate
            ];
        }

        $inspection = Inspection::create([
            'area_trabajo'  => $request->area_trabajo,
            'user_id'       => $request->inspector,
            'company_id'    => $request->company,
            'product_id'    => $request->product
        ]);

        $data = [
            'code'      => 200,
            'status'    => 'success',
            'inspection'    => $inspection
        ];
    

        return response()->json($data, $data['code']);
    }

    public function prueba(){
        $revisions = Revision::where('inspection_id', 43)->get();

        $malas = 0;
        $buenas = 0;

        foreach($revisions as $revision) {
            $malas += $revision->bad_pieces;
            $buenas += $revision->good_pieces;
        }

        $total = $buenas + $malas;

        // Porcentaje de buenas
        $porcentaje_buenas = $buenas * 100 / $total;

        // Porcentaje de malas
        $porcentaje_malas = $malas * 100 / $total;


        echo $porcentaje_malas;
        die();
    }

}
