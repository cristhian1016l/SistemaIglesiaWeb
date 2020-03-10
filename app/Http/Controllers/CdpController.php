<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CasaDePaz;
use App\Red;
use App\Cdp_miembro;
use App\Congregante;
use Illuminate\Support\Facades\DB;
use Auth;

class CdpController extends Controller
{
    public function listarCdp(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $idred = Red::where('LID_RED', '=', Auth::User()->CodCon)->first();        
        
        /*$cdpss = DB::raw("SELECT c.CodCasPaz, CONCAT(m.ApeCon,' ', m.NomCon) as Nombres, c.DirCasPaz, 
                      c.FecIniCasPaz, DiaReuCasPaz, TipCasPaz, TotMimCasPaz  FROM TabCasasDePaz c
                      INNER JOIN TabCon m ON c.CodLid = m.CodCon
                      WHERE c.ID_Red = $idred->ID_RED");*/

        $cdp = CasaDePaz::join('TabCon as m','TabCasasDePaz.CodLid','=','m.CodCon')   
            ->select(DB::raw("TabCasasDePaz.CodCasPaz, CONCAT(m.ApeCon,' ', m.NomCon) as Nombres, TabCasasDePaz.DirCasPaz, 
            Date_Format(TabCasasDePaz.FecIniCasPaz, '%d-%m-%Y') as FecIniCasPaz, TabCasasDePaz.DiaReuCasPaz, TabCasasDePaz.TipCasPaz, TabCasasDePaz.TotMimCasPaz"))
            ->where('TabCasasDePaz.ID_Red', '=', $idred->ID_RED)->paginate();
        
        return ['cdps' => $cdp];
    }

    public function listarMiembros(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $listaMiembros = Cdp_miembro::join('TabCon','TabMimCasPaz.CodCon','=','TabCon.CodCon')   
            ->select(DB::raw("TabCon.CodCon, TabCon.NomCon, TabCon.ApeCon, TabCon.TipCon, TabCon.NumCel, TabCon.FecNacCon, Date_Format(TabCon.FecReg, '%d-%m-%Y') as FecReg, Date_Format(TabCon.FecBau, '%d-%m-%Y') as FecBau, TabCon.TipCon"))
            ->where('TabMimCasPaz.CodCasPaz', '=', $request->idcdp)
            ->orderBy('TabCon.ApeCon', 'ASC')->paginate();
        
        
        return ['listaMiembros' => $listaMiembros];
    }

    public function listarDetalleMiembros(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $detalleMiembro = Congregante::where('CodCon', $request->codcon)->paginate();

        return ['detalleMiembro' => $detalleMiembro];
    }
}
