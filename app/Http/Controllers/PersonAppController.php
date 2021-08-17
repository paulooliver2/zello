<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \App\Models\PersonApps;

class PersonAppController extends Controller
{

    public function create($personId, Request $request)
    {
        try {
            $request->validate([
                'person_id' => 'required|integer',
                'apps_id' => 'required|integer',
            ]);

            $param = $request->all();

            $personApps = new PersonApps();
            $personApps->person_id = $param['person_id'];
            $personApps->apps_id = $param['apps_id'];
            $personApps->save();

            return response()->json($personApps->toArray());
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("erro ao vincular pessoa ao aplicativo", 500);
        }
    }

    public function all($personId)
    {
        $result = \DB::select('select pa.*, p.name as person_name, a.name as apps_name 
        from person_apps as pa
        inner join person p on p.id = pa.person_id
        inner join apps as a on a.id = pa.apps_id 
        where pa.person_id = ?', [$personId]);
        return response()->json($result);
    }

    public function delete($personId, int $id)
    {
        try {
            $personApps = PersonApps::find($id);
            $personApps->delete();
            return response()->json("vinculo excluida com sucesso");
        } catch (\Throwable $e) {
            Log::channel('stderr')->error($e->getTraceAsString());
            return response()->json("erro ao excluir vinculo", 500);
        }
    }

}
