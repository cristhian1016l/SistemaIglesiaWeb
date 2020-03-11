<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Congregante;
use App\Role_user;
use Illuminate\Support\Facades\DB;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $users = User::join('TabCon','users.CodCon', '=', 'TabCon.CodCon')
            ->select('TabCon.CodCon', 'TabCon.NomCon', 'TabCon.ApeCon', 'users.email', 'TabCon.NumCel', 'users.usuario', 'users.password', 'users.condicion', 'users.id')
            ->where('TabCon.ID_Red', '=', Auth::User()->TabCon->ID_Red)
            ->orderBy('users.id', 'desc')->paginate(5);

        return [
            'pagination' => [
                'total'          => $users->total(),
                'current_page'   => $users->currentPage(),
                'per_page'       => $users->perPage(),
                'last_page'      => $users->lastPage(),
                'from'           => $users->firstItem(),
                'to'             => $users->lastItem(),
            ],
            'personas' => $users
        ];
    }

    public function store(Request $request)
    {        
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();
            $user = new User();
            $user->CodCon = $request->CodCon;
            $user->usuario = $request->usuario;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);   
            $user->condicion = 1;
            $user->save();

            $user->roles()->attach(1);
               
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();
            $user = User::findOrFail($request->id);
            $user->CodCon = $request->CodCon;
            $user->usuario = $request->usuario;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);   
            $user->save();
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /*public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }*/

    /*public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }*/

    public function selectLider(Request $request)
    {

        //if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $lideres = Congregante::join('TabCasasDePaz as cdp','TabCon.CodCon', '=', 'cdp.CodLid')
                   ->where('CodCon', 'like', '%'.$filtro.'%')
                   ->orWhere('ApeCon', 'like', '%'.$filtro.'%')
                   ->orWhere('NomCon', 'like', '%'.$filtro.'%')
                   ->select(DB::raw(" DISTINCT cdp.CodLid, CONCAT(TabCon.ApeCon,' ', TabCon.NomCon) as label"))
                   ->orderBy('TabCon.NomCon', 'asc')->get();

        return ['lideres' => $lideres];
    }
}
