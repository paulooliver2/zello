<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \App\Models\Person;
use Illuminate\Support\Facades\Log;

class PersonController extends Controller
{

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'birthdate' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'profile' => 'required',
            ]);

            $param = $request->all();

            $person = new Person();
            $person->name = strtoupper($param['name']);
            $person->birthdate = $param['birthdate'];
            $person->cpf = $param['cpf'];
            $person->rg = $param['rg'];
            $person->profile = $param['profile'];
            $person->save();

            return response()->json($person->toArray());
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("erro ao criar pessoa", 500);
        }
    }

    public function all()
    {
        return Person::all();
    }

    public function update(int $id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'birthdate' => 'required',
                'cpf' => 'required',
                'rg' => 'required',
                'profile' => 'required',
            ]);

            $param = $request->all();

            $person = Person::find($id);
            $person->name = strtoupper($param['name']);
            $person->birthdate = $param['birthdate'];
            $person->cpf = $param['cpf'];
            $person->rg = $param['rg'];
            $person->profile = $param['profile'];
            $person->save();

            return response()->json($person->toArray());
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getMessage());
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("erro ao alterar pessoa", 500);
        }
    }

    public function delete(int $id)
    {
        try {
            $person = Person::find($id);
            $person->delete();
            return response()->json("pessoa excluida com sucesso");
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("erro ao excluir pessoa", 500);
        }
    }

    public function find(int $id)
    {
        try {
            $person = Person::find($id);
            if (!$person) {
                throw new \DomainException("Essa pessoa nao existe", 400);
            }
            return response()->json($person);
        } catch (\DomainException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("erro ao recuperar pessoa", 500);
        }
    }

}
