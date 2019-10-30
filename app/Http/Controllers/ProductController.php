<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use Illuminate\Http\Request;
use \Validator;

class ProductController extends Controller
{

    public function create(){
        $companies = Company::all();
        return view('product.create', [
            'companies' => $companies
        ]);
    }

    public function index(){
        $products = Product::all();

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'description'   => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'company_id'    => 'required'
        ]);

        if($validator->fails()) {
            return $this->error_message(400, $validator->messages());
        }
        
        $nombre = '';
        $file = $request->file('image');

        if($file != null) {
            $nombre = time()."_".$file->getClientOriginalName();
            \Storage::disk('public')->put($nombre, \File::get($file)); 
        }

        

        $product = Product::create([
            'name'  => $request->name,
            'description'   => $request->description,
            'image' => $nombre ? $nombre : null,
            'company_id'    => $request->company_id
        ]);

        if($product) {
            return redirect()->to('product/index')->with([
                'message'   => 'Producto creado correctamente.'
            ]);
        }
    }
}
