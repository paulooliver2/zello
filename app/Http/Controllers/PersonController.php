<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \App\Models\Person;

class PersonController extends Controller
{
    public function create(Request $request)
    {
        $param = $request->all();

        $person = new Person();
        $person->name = $param['name'];
        $person->birthdate = $param['birthdate'];
        $person->cpf = $param['cpf'];
        $person->rg = $param['rg'];
        $person->profile = $param['profile'];
        $person->save();

        return response()->json($person->toArray());
    }
}