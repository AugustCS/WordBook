<?php

namespace App\Http\Controllers;

use App\setword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\DB;

class SetwordController extends Controller
{
    public function index()
    {
        $setword = setword::all();
        return response()->json($setword);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'iuserid' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $ifNameExist = setword::where('vname',$request->vname)->andWhere('iuserid',$request->iuserid)->get();

        $error = config('constantes.msg_error');

        if($ifNameExist->count() > 0){
            return response()->json(['error' => $error],400);
        }

        $setword = setword::create([
            'vname' => strtoupper($request->get('vname')),
            'iuserid' => $request->get('iuserid')
        ]);

        $msg = config('constantes.msg_ok');

        return response()->json(compact('msg'),201);
    }

    public function show(setword $setword)
    {
        //
    }

    public function edit(setword $setword)
    {
        //
    }

    public function update(Request $request, setword $setword)
    {
        //
    }

    public function destroy(setword $setword)
    {
        //
    }
}
