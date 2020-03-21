<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CasaDePaz;
use App\Cdp_miembro;
use App\Congregante;
use App\InfCdp;
use App\DetInfCdp;
use App\Red;
use Illuminate\Support\Facades\DB;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;

class InformeController extends Controller
{
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
 
            $informe = new InfCdp();
            $informe->CodCasPaz = $request->CodCasPaz;
            $informe->FecInf = $request->FecInf;
            $informe->NumSem = date("W", strtotime($request->FecInf));
            $informe->ReuSiNo = $request->ReuSiNo;
            $informe->EntSiNo = 'SI';
            $informe->TotAsiReu = $request->TotAsiReu;
            $informe->TotAusReu = $request->TotAusReu;
            $informe->OfreReu = $request->OfreReu;
            $informe->TemaSem = $request->TemaSem;
            $informe->ApeReunion = $request->ApeReunion;
            $informe->save();            

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos
 
            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetInfCdp();
                $detalle->NumInf = $informe->NumInf;
                $detalle->CodCon = $det['CodCon'];
                $detalle->NomCon = $det['NomCon'];
                $detalle->ApeCon = $det['ApeCon'];
                $detalle->TipCon = $det['TipCon'];
                $detalle->AsiReu = $det['FecNacCon'];         
                $detalle->save();
            }
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        } 
    }

    public function listarCdp(Request $request)
    {
        if (!$request->ajax()) return redirect('/');        
        $listaCdp = CasaDePaz::where('CodLid', Auth()->user()->CodCon)->paginate(5);

        return ['lista' => $listaCdp];
    }

    public function listarMiembros(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $listaMiembros = Cdp_miembro::join('TabCon','TabMimCasPaz.CodCon','=','TabCon.CodCon')   
            ->select(DB::raw("TabCon.CodCon, TabCon.NomCon, TabCon.ApeCon, TabCon.TipCon, TabCon.NumCel, TabCon.FecNacCon, Date_Format(TabCon.FecReg, '%d-%m-%Y') as FecReg, Date_Format(TabCon.FecBau, '%d-%m-%Y') as FecBau, TabCon.TipCon"))
            ->where('TabMimCasPaz.CodCasPaz', '=', $request->idcdp)
            ->orderBy('TabCon.ApeCon', 'ASC')->paginate(100);
        
        return ['listaMiembros' => $listaMiembros];
    }

    public function listarMiembrosInforme(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $listaMiembros = Cdp_miembro::join('TabCon','TabMimCasPaz.CodCon','=','TabCon.CodCon')   
            ->select(DB::raw("TabCon.CodCon, TabCon.NomCon, TabCon.ApeCon, TabCon.TipCon"))
            ->where('TabMimCasPaz.CodCasPaz', '=', $request->idcdp)
            ->where('TabCon.ParticipaCasaPaz', '=', 1)
            ->orderBy('TabCon.ApeCon', 'ASC')->paginate(100);     
        
        return ['listaMiembros' => $listaMiembros];
    }

    public function listarLideresInforme(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $mentor = Congregante::join('TabRedes','TabCon.CodCon','=','TabRedes.LID_RED')            
            ->select('TabCon.CodCon', 'TabCon.NomCon','TabCon.ApeCon')
            ->where('TabRedes.ID_RED', '=', Auth::User()->TabCon->ID_Red)->paginate();

        $lider = DB::table('TabCon')->select('ApeCon', 'NomCon')->where('CodCon', Auth::user()->CodCon)->paginate();

        
        return ['mentor' => $mentor, 'lider' => $lider];
    }

    public function listarDetalleMiembros(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $detalleMiembro = Congregante::where('CodCon', $request->codcon)->paginate();

        return ['detalleMiembro' => $detalleMiembro];
    }
    /*public function RegistrarInforme()
    {
        $numeroSemana = date("W");
        return ['NumSem' => $numeroSemana];
    }*/
    public function listarInformes(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        if($request->date)
        {
        $informes = InfCdp::join('TabCasasDePaz as cdp','TabInfCasPaz.CodCasPaz','=','cdp.CodCasPaz')            
            ->select(DB::raw("TabInfCasPaz.NumInf,  TabInfCasPaz.NumSem, TabInfCasPaz.CodCasPaz, Date_Format(TabInfCasPaz.FecInf, '%d-%m-%Y') as FecInf, TabInfCasPaz.TotAsiReu, TabInfCasPaz.TotAusReu, TabInfCasPaz.OfreReu, TabInfCasPaz.TemaSem"))
            ->where('cdp.CodLid', '=', Auth()->user()->CodCon)
            ->where("TabInfCasPaz.FecInf", '=', $request->date)
            ->orderBy('TabInfCasPaz.NumInf', 'desc')
            ->paginate();    
        }else{
        $informes = InfCdp::join('TabCasasDePaz as cdp','TabInfCasPaz.CodCasPaz','=','cdp.CodCasPaz')            
            ->select(DB::raw("TabInfCasPaz.NumInf,  TabInfCasPaz.NumSem, TabInfCasPaz.CodCasPaz, Date_Format(TabInfCasPaz.FecInf, '%d-%m-%Y') as FecInf, TabInfCasPaz.TotAsiReu, TabInfCasPaz.TotAusReu, TabInfCasPaz.OfreReu, TabInfCasPaz.TemaSem"))
            ->where('cdp.CodLid', '=', Auth()->user()->CodCon)
            ->orderBy('TabInfCasPaz.NumInf', 'desc')
            ->paginate($request->num);
        }
        return ['informe' => $informes];
    }

    public function informe_reporte(Request $request)
    {                
        date_default_timezone_set("America/Lima");        
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $informes = InfCdp::join('TabCasasDePaz as cdp','TabInfCasPaz.CodCasPaz','=','cdp.CodCasPaz')            
            ->select('TabInfCasPaz.NumInf', 'TabInfCasPaz.CodCasPaz', 'TabInfCasPaz.FecInf', 'TabInfCasPaz.TotAsiReu', 'TabInfCasPaz.TotAusReu', 'TabInfCasPaz.OfreReu', 'TabInfCasPaz.TemaSem')
            ->where('cdp.CodLid', '=', $request->CodCon)
            ->where('TabInfCasPaz.NumInf', '=', $request->NumInf)
            ->first();

        $asistencia = DetInfCdp::join('TabInfCasPaz', 'TabDetInfCas.NumInf', '=', 'TabInfCasPaz.NumInf')
            ->select('TabDetInfCas.CodCon', 'TabDetInfCas.NomCon', 'TabDetInfCas.ApeCon', 'TabDetInfCas.TipCon', 'TabDetInfCas.AsiReu')
            ->where('TabDetInfCas.NumInf', '=', $request->NumInf)
            ->orderby('TabDetInfCas.ApeCon', 'asc')
            ->paginate(100);
        
        $mentor = Congregante::join('TabRedes','TabCon.CodCon','=','TabRedes.LID_RED')            
        ->select('TabCon.NomCon','TabCon.ApeCon')
        ->where('TabRedes.ID_RED', '=', Auth::User()->TabCon->ID_Red)->first();

        $lider = DB::table('TabCon')->select('ApeCon', 'NomCon')->where('CodCon', $request->CodCon)->first();
        
        $fecha = strftime("%A, %d de %B de %Y %H:%M");
        $pdf = PDF::loadView('reportes.informe_pdf', compact('informes','asistencia', 'mentor', 'lider', 'fecha'));
        return $pdf->stream();
    }

    public function informe_reporte_lider($id)
    {        
        date_default_timezone_set("America/Lima");        
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $informes = InfCdp::join('TabCasasDePaz as cdp','TabInfCasPaz.CodCasPaz','=','cdp.CodCasPaz')            
            ->select('TabInfCasPaz.NumInf', 'TabInfCasPaz.CodCasPaz', 'TabInfCasPaz.FecInf', 'TabInfCasPaz.TotAsiReu', 'TabInfCasPaz.TotAusReu', 'TabInfCasPaz.OfreReu', 'TabInfCasPaz.TemaSem')
            ->where('cdp.CodLid', '=', Auth()->user()->CodCon)
            ->where('TabInfCasPaz.NumInf', '=', $id)
            ->first();

        $asistencia = DetInfCdp::join('TabInfCasPaz', 'TabDetInfCas.NumInf', '=', 'TabInfCasPaz.NumInf')
            ->select('TabDetInfCas.CodCon', 'TabDetInfCas.NomCon', 'TabDetInfCas.ApeCon', 'TabDetInfCas.TipCon', 'TabDetInfCas.AsiReu')
            ->where('TabDetInfCas.NumInf', '=', $id)
            ->get();
        
        $mentor = Congregante::join('TabRedes','TabCon.CodCon','=','TabRedes.LID_RED')            
        ->select('TabCon.NomCon','TabCon.ApeCon')
        ->where('TabRedes.ID_RED', '=', Auth::User()->TabCon->ID_Red)->first();

        $lider = DB::table('TabCon')->select('ApeCon', 'NomCon')->where('CodCon', Auth::user()->CodCon)->first();

        $fecha = strftime("%A, %d de %B de %Y %H:%M");
        $pdf = PDF::loadView('reportes.informe_pdf', compact('informes','asistencia', 'mentor', 'lider', 'fecha'));
        return $pdf->stream();
    }

    public function editarCdp(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $cdp = CasaDePaz::where('CodCasPaz', '=', $request->idcdp)->paginate();
        
        
        return ['cdp' => $cdp];
    }

    public function updateCdp(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $cdp = CasaDePaz::findOrFail($request->CodCasPaz);
        $cdp->DirCasPaz = $request->DirCasPaz;
        $cdp->DiaReuCasPaz = $request->DiaReuCasPaz;
        $cdp->save();
    }

    public function listarInformesRed(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $idred = Red::where('LID_RED', '=', Auth::User()->CodCon)->first();        

        if($request->date)
        {
        $informes = InfCdp::join('TabCasasDePaz as cdp','TabInfCasPaz.CodCasPaz','=','cdp.CodCasPaz')            
            ->select(DB::raw("TabInfCasPaz.NumInf,  TabInfCasPaz.NumSem, TabInfCasPaz.CodCasPaz, Date_Format(TabInfCasPaz.FecInf, '%d-%m-%Y') as FecInf, TabInfCasPaz.TotAsiReu, TabInfCasPaz.TotAusReu, TabInfCasPaz.OfreReu, TabInfCasPaz.TemaSem, cdp.CodLid"))
            ->where('cdp.ID_Red', '=', $idred->ID_RED)
            ->where("TabInfCasPaz.FecInf", '=', $request->date)
            ->orderBy('cdp.CodCasPaz', 'asc')
            ->paginate();    
        }
        return ['informe' => $informes];
    }

    public function delete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        if($request->NumInf)
        {
            // Conseguimos el objeto
            $detinf = DetInfCdp::where('NumInf', '=', $request->NumInf);
            $inf = InfCdp::where('NumInf', '=', $request->NumInf)->first();
 
            $detinf->delete();            
            $inf->delete();         
        }
    }

    public function informe_oracion(Request $request)
    {        
        date_default_timezone_set("America/Lima");        
        setlocale(LC_TIME, 'es_ES.UTF-8');

        $diaInicio="Monday";
        $fecha = date('Y-m-d');
        $strFecha = strtotime($fecha);
        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        
        date($fechaInicio);

        $cdp = DB::table('TabDetAsi as da')
               ->join('TabAsi as a', 'da.CodAsi', '=', 'a.CodAsi')
               ->join('TabMimCasPaz as mim', 'da.CodCon', '=', 'mim.CodCon')
               ->select(DB::raw('da.NomApeCon, da.Asistio, a.FecAsi, mim.CodCasPaz'))
               ->where('mim.CodCasPaz', '=', $request->codcdp)
               ->where('a.CodAct', '=', '002')
               ->whereBetween('a.FecAsi', [$fechaInicio, date('Y-m-d')])
               ->orderBy('da.NomApeCon')
               ->orderBy('a.FecAsi')
               ->get();       
        $codcdp = $request->codcdp; 
        $nombres = $request->nomlid;
        $fecha = strftime("%A, %d de %B de %Y %H:%M");
        $pdf = PDF::loadView('reportes.informe_oracionCDP', compact('cdp', 'codcdp', 'nombres'));
        return $pdf->stream();
    }
}

