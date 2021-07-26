<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \App\Models\Apps;

class AppController extends Controller
{

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'bundle_id' => 'required',
            ]);

            $param = $request->all();

            $app = new Apps();
            $app->name = strtoupper($param['name']);
            $app->bundle_id = $param['bundle_id'];
            $app->save();

            return response()->json($app->toArray());
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("Erro ao criar aplicativo", 500);
        }
    }

    public function all()
    {
        return Apps::all();
    }

    public function update(int $id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'bundle_id' => 'required'
            ]);

            $param = $request->all();

            $app = Apps::find($id);
            $app->name = strtoupper($param['name']);
            $app->bundle_id = $param['bundle_id'];
            $app->save();

            return response()->json($app->toArray());
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getMessage());
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("Erro ao alterar aplicativo", 500);
        }
    }

    public function delete(int $id)
    {
        try {
            $app = Apps::find($id);
            $app->delete();
            return response()->json("Aplicativo excluido com sucesso");
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("Erro ao excluir aplicativo", 500);
        }
    }

    public function find(int $id)
    {
        try {
            $app = Apps::find($id);
            if (!$app) {
                throw new \DomainException("Esse aplicativo nao existe", 400);
            }
            return response()->json($app);
        } catch (\DomainException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("Erro ao recuperar aplicativo", 500);
        }
    }

}
