<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use \Validator;
use Illuminate\Support\Carbon;

class CompanyController extends Controller
{
    public function create(){
        $users = User::all();
        return view('company.create', [
            'users' => $users
        ]);
    }

    public function index(){
        $companies = Company::all();
        Carbon::setLocale('es');

        return view('company.index', [
            'companies' => $companies
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'address'   => 'required',
            'user_id'   => 'required'
        ]);

        if($validator->fails()) {
            return $this->error_message(400, $validator->messages());
        }

        $company = Company::create([
            'name' => $request->name,
            'address'=> $request->address,
            'user_id'   => $request->user_id
        ]); 

        if($company) {
            return $this->good_message(200, 'La empresa '.$company->name.' fue creada correctamente.');
        }
    }
}
