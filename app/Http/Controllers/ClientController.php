<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ClientController extends Controller
{
    public function index(Request $request)
    {

        $clients = Clients::select('id', 'docuement', 'name', 'email', 'phone')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json(['clients' => $clients]);

    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'docuement'=>'required',
            'name'=>'required',
            'email'=>'required',
        ]);
        if ($validator->fails()) {
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=>'Faltan datos'
            ];
        }else{
            $agente = Clients::create($request->all());
            $data=[
                'code'=>200,
                'status'=>'success',
                'agente'=>$agente
            ];
        }

        return response()->json($data, $data['code']);

    }

    public function update(Request $request, $id)
    {
        $client= Clients::findOrFail($id);

        $validator = \Validator::make($request->all(), [
            'docuement'=>'required',
            'name'=>'required',
            'email'=>'required',
        ]);
        if ($validator->fails()) {
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=>'Faltan datos'
            ];
        }else{
            $client->update($request->all());
            $data=[
                'code'=>200,
                'status'=>'success',
                'client'=>$client
            ];
        }

        return response()->json($data, $data['code']);

    }

    public function destroy(Request $request, $id)
    {
        $user = Clients::findOrFail($id);
        $user->delete();

        if($request->ajax())
        {
            return response()->json($user);
        }

    }
}
