<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Wallet;
use Illuminate\Http\Request;

class WallerController extends Controller
{
    public function index(Request $request)
    {

        $waller= Wallet::select('id','dinner', 'id_cliente','docuement','name')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json(['dinner' => $waller]);

    }

    public function getClientes(Request $request)
    {

        $waller= Clients::select('id','docuement', 'name')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json(['waller' => $waller]);

    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validator = \Validator::make($request->all(), [
            'dinner'=>'required',
            'docuement'=>'required',
            'name'=>'required',
        ]);
        if ($validator->fails()) {
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=>'Faltan datos'
            ];
        }else{
            $waller = Wallet::create($request->all());
            $data=[
                'code'=>200,
                'status'=>'success',
                'waller'=>$waller
            ];
        }

        return response()->json($data, $data['code']);

    }

    public function update(Request $request, $id)
    {
        $waller= Wallet::findOrFail($id);
        $validator = \Validator::make($request->all(), [
            'dinner'=>'required',
        ]);
        if ($validator->fails()) {
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=>'Faltan datos'
            ];
        }else{
            $waller->dinner=$request->dinner+ $waller->dinner;
            $waller->save();
            $data=[
                'code'=>200,
                'status'=>'success',
                'waller'=>$waller
            ];
        }

        return response()->json($data, $data['code']);

    }

    public function destroy(Request $request, $id)
    {
        $user = Wallet::findOrFail($id);
        $user->delete();

        if($request->ajax())
        {
            return response()->json($user);
        }

    }
}
