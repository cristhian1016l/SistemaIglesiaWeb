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
        $fecha = '2020-03-19';
        $strFecha = strtotime($fecha);
        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        date($fechaInicio);
        
        $martes = date("Y-m-d",strtotime($fechaInicio."+ 1 days"));
        $miercoles = date("Y-m-d",strtotime($martes."+ 1 days"));
        $jueves = date("Y-m-d",strtotime($miercoles."+ 1 days"));
        $viernes = date("Y-m-d",strtotime($jueves."+ 1 days"));
        $sabado = date("Y-m-d",strtotime($viernes."+ 1 days"));
        $domingo = date("Y-m-d",strtotime($sabado."+ 1 days"));

        $cdp = DB::table('TabMimCasPaz as m')
               ->join('TabCasasDePaz as cdp', 'm.CodCasPaz', '=', 'cdp.CodCasPaz')
               ->select(DB::raw('cdp.CodCasPaz, m.CodCon'))
               ->where('cdp.ID_Red', '=', '4')
               ->orderBy('cdp.CodCasPaz', 'asc')
               ->get();       

        $array = Collect();
        $add = Collect();
        foreach($cdp as $c)
        {                        
            $cdp = $c->CodCasPaz;
            $lunes = DB::table('TabAsi as a')
                 ->join('TabDetAsi as da', 'a.CodAsi', '=', 'da.CodAsi')
                 ->select(DB::raw('da.NomApeCon, da.Asistio as a'))
                 ->where('da.CodCon', '=', $c->CodCon)
                 ->where("a.CodAct", '=', '002')
                 ->where('a.FecAsi', "=", $fechaInicio)
                 ->orderBy('a.FecAsi', 'ASC')
                 ->get();                
            
                if (isset($lunes->last()->NomApeCon) &&
                    isset($lunes->last()->a)) {
                        
                    $array[] = array("CDP" => $cdp, "Nombre" => $lunes->last()->NomApeCon, 
                                     "LU" => $lunes->last()->a,
                                     "MA" => "N",
                                     "MI" => "N",
                                     "JU" => "N",
                                     "VI" => "N",
                                     "SA" => "N",
                                     "DO" => "N");

                }                             

                $prayerMa = DB::table('TabAsi as a')
                    ->join('TabDetAsi as da', 'a.CodAsi', '=', 'da.CodAsi')
                    ->select('da.NomApeCon', 'a.FecAsi', 'da.Asistio')
                    ->where('da.CodCon', '=', $c->CodCon)
                    ->where("a.CodAct", '=', '002')
                    ->where('a.FecAsi', $martes)
                    ->orderBy('a.FecAsi', 'ASC')
                    ->get();  

                $prayerMi = DB::table('TabAsi as a')
                    ->join('TabDetAsi as da', 'a.CodAsi', '=', 'da.CodAsi')
                    ->select('da.NomApeCon', 'a.FecAsi', 'da.Asistio')
                    ->where('da.CodCon', '=', $c->CodCon)
                    ->where("a.CodAct", '=', '002')
                    ->where('a.FecAsi', $miercoles)
                    ->orderBy('a.FecAsi', 'ASC')
                    ->get();  

                $prayerJu = DB::table('TabAsi as a')
                    ->join('TabDetAsi as da', 'a.CodAsi', '=', 'da.CodAsi')
                    ->select('da.NomApeCon', 'a.FecAsi', 'da.Asistio')
                    ->where('da.CodCon', '=', $c->CodCon)
                    ->where("a.CodAct", '=', '002')
                    ->where('a.FecAsi', $jueves)
                    ->orderBy('a.FecAsi', 'ASC')
                    ->get();  

                $prayerVi = DB::table('TabAsi as a')
                    ->join('TabDetAsi as da', 'a.CodAsi', '=', 'da.CodAsi')
                    ->select('da.NomApeCon', 'a.FecAsi', 'da.Asistio')
                    ->where('da.CodCon', '=', $c->CodCon)
                    ->where("a.CodAct", '=', '002')
                    ->where('a.FecAsi', $viernes)
                    ->orderBy('a.FecAsi', 'ASC')
                    ->get();  
                
                $prayerSa = DB::table('TabAsi as a')
                    ->join('TabDetAsi as da', 'a.CodAsi', '=', 'da.CodAsi')
                    ->select('da.NomApeCon', 'a.FecAsi', 'da.Asistio')
                    ->where('da.CodCon', '=', $c->CodCon)
                    ->where("a.CodAct", '=', '002')
                    ->where('a.FecAsi', $sabado)
                    ->orderBy('a.FecAsi', 'ASC')
                    ->get();  
                    
                $prayerDo = DB::table('TabAsi as a')
                    ->join('TabDetAsi as da', 'a.CodAsi', '=', 'da.CodAsi')
                    ->select('da.NomApeCon', 'a.FecAsi', 'da.Asistio')
                    ->where('da.CodCon', '=', $c->CodCon)
                    ->where("a.CodAct", '=', '002')
                    ->where('a.FecAsi', $domingo)
                    ->orderBy('a.FecAsi', 'ASC')
                    ->get();  

                for ($i=0; $i < sizeof($array) ; $i++) { 
                    if ($prayerMa->isNotEmpty()) {
                        $prayerMar = $prayerMa->last()->Asistio;
                    }else{
                        $prayerMar = "N";
                    }
                    if ($prayerMi->isNotEmpty()) {
                        $prayerMie = $prayerMi->last()->Asistio;
                    }else{
                        $prayerMie = "N";
                    }
                    if ($prayerJu->isNotEmpty()) {
                        $prayerJue = $prayerJu->last()->Asistio;
                    }else{
                        $prayerJue = "N";
                    }
                    if ($prayerVi->isNotEmpty()) {
                        $prayerVie = $prayerVi->last()->Asistio;
                    }else{
                        $prayerVie = "N";
                    }
                    if ($prayerSa->isNotEmpty()) {
                        $prayerSab = $prayerSa->last()->Asistio;
                    }else{
                        $prayerSab = "N";
                    }
                    if ($prayerDo->isNotEmpty()) {
                        $prayerDom = $prayerDo->last()->Asistio;
                    }else{
                        $prayerDom = "N";
                    }
                    
                    for ($i=0; $i < sizeof($array); $i++) { 
                        $reem = array_replace($array[$i], 
                                         ["MA" => $prayerMar],
                                         ["MI" => $prayerMie],
                                         ["JU" => $prayerJue],
                                         ["VI" => $prayerVie],
                                         ["SA" => $prayerSab],
                                         ["DO" => $prayerDom]);
                    }

                    $add->push($reem);
                }                
                
        }         
        //dd($cdp);
        $lista = Collect($add);     
        //dd($lista->groupBy('CDP'));           
        $lista = $lista->groupBy('CDP');
        dd($lista);
        //dd($lista[0]['LU']);
        //["MA"]

        //$reem = array_replace($array[0], ["MA" => 0]);
        //dd($reem);
        $fecha = strftime("%A, %d de %B de %Y %H:%M");
        $pdf = PDF::loadView('reportes.informe_oracionCDP', compact('lista'));
        return $pdf->stream();
    }
}

