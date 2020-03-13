<template>
    <div class="container">
    <div class="row" v-show="lista==0">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">SELECCIONE CASA DE PAZ</h3></div>
        </div>
    </div>    
    <div class="row" v-show="lista==0">
    <div class="container">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for="(cdp, index) in arrayCdp" :key="index">
        <div class="panel panel-default">
            <div class="panel-heading" v-text="cdp.CodCasPaz"></div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                        <a @click="listarMiembros(cdp.CodCasPaz)" class="btn btn-custom m-t-10 collapseble" >Seleccionar Casa de Paz </a>
                        <div class="m-t-15 collapseblebox dn">
                        <div class="well"> <code> &lt;div class="panel panel-default"&gt;<br/>
                        &nbsp; &nbsp;&lt;div class="panel-heading"&gt;Default Panel&lt;/div&gt; <br/>
                        <br/>
                        &lt;div class="panel-wrapper collapse in"&gt;<br/>
                        &nbsp;&nbsp; &lt;div class="panel-body"&gt;<br/>
                        ... ... ...<br/>
                        &nbsp;&nbsp; &lt;/div&gt;<br/>
                        &lt;/div&gt;<br/>
                        <br/>
                        &lt;div class="panel-footer"&gt; Panel Footer &lt;/div&gt;<br/>
                        &lt;/div&gt; </code> </div>
                        </div>
                </div>
                <div class="panel-footer"> Solo debe hacerlo una vez por semana  </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <div v-show="lista==1">                    
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">                    
                    <div class="row">                   
                        <h3 class="box-title" >CASA DE PAZ Y FECHA</h3>                           
                        <div class="col-md-3 col-xs-12">                        
                        <div class="form-group">
                            <label>CDP</label>
                            <div class="input-group"><span class="input-group-addon">CDP #</span>                                        
                                <input style="background-color:#2f323e; color:#7ba2b4;" type="text" class="form-control" v-model="cdp" :readonly="true">
                            </div> 
                        </div>                           
                        </div>
                        <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                            <label>FECHA</label>
                            <div class="input-group" > <span class="input-group-addon">F</span>                                        
                                <date-pick style="z-index:100;" v-model="date"  :format="'YYYY-MM-DD'" placeholder="Seleccione fecha"></date-pick>
                            </div> 
                        </div>                         
                        </div>
                        <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                            <label>FECHA</label>
                            <template>
                                <input style="background-color:#2f323e; color:#7ba2b4;" v-bind:value="date" type="text" placeholder="Fecha" class="form-control" :readonly="true"> 
                            </template>
                        </div>                         
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Se reunieron?</label>
                                <div class="radio-list">
                                    <label class="radio-inline p-0">
                                        <div class="radio radio-info">
                                            <input type="radio" name="radio1Reu" id="radio1Reu" v-model="reunieron" value="SI" checked="">
                                            <label for="radio1Reu">Si</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="radio2Reu" id="radio2Reu" v-model="reunieron" value="NO">
                                            <label for="radio2Reu">No </label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                    
                        <h3 class="box-title" >NOMBRES DEL LIDERAZGO</h3>    
                        <div class="col-sm-6 col-xs-12">                            
                            <div class="form-group">                                
                                <label>Mentor</label>
                                <div class="input-group" v-for="(datos, arrayInformeDatosMentor) in arrayInformeDatosMentor" v-bind:key="arrayInformeDatosMentor.CodCon"> <span class="input-group-addon">M</span>                                        
                                    <input style="background-color:#2f323e; color:#7ba2b4;" v-bind:value="datos.ApeCon+' '+datos.NomCon" type="text" placeholder="Mentor" class="form-control" :readonly="true"> 
                                </div>
                            </div>
                        </div>                        
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">                                
                                <label>Lider de Casa de Paz</label>
                                <div class="input-group" v-for="(datos, i) in arrayInformeDatosLider" :key="i"> <span class="input-group-addon">L</span>
                                    <input style="background-color:#2f323e; color:#7ba2b4;" v-bind:value="datos.ApeCon+' '+datos.NomCon" type="text" placeholder="Lider" class="form-control" :readonly="true"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h3 class="box-title" >TEMA Y OFRENDA</h3>
                        <div class="col-sm-6 col-xs-12">                            
                            <div class="form-group">
                                <label>Tema de Enseñanza</label>
                                <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" v-model="tema"> 
                            </div>                            
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label>Monto de Ofrenda</label>                                
                                <money class="form-control" v-model="ofrenda" v-bind="money"></money>
                            </div>                            
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Hubo compartir?</label>
                                <div class="radio-list">
                                    <label class="radio-inline p-0">
                                        <div class="radio radio-info">
                                            <input type="radio" name="radio" id="radio1" v-model="compartir" value="1" checked="">
                                            <label for="radio1">Si</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="radio" id="radio2" v-model="compartir" value="0">
                                            <label for="radio2">No </label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>         
                    <div class="row">
                        <h3 class="box-title" >ASISTENCIA</h3>
                        <div class="col-sm-6 col-xs-12">                            
                            <div class="form-group">
                                <label>ASISTIERON</label>
                                <input style="background-color:#2f323e; color:#7ba2b4;" type="number" class="form-control" v-model="Siasis" :readonly="true"> 
                            </div>                            
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>NO ASISTIERON</label>                                
                                <input style="background-color:#2f323e; color:#7ba2b4;" type="number" class="form-control" v-model="Noasis" :readonly="true">
                            </div>                            
                        </div>
                    </div>                                 
                </div>
            </div>
        </div> 
        <div class="col-md-12">
            <div v-show="errorInforme" class="form-group row div-error">
                <div class="text-center text-danger">
                    <div v-for="error in errorMostrarMsjInforme" :key="error" v-text="error">

                    </div>
                </div>
            </div>
        </div>       
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">ASISTENCIA DE MIEMBROS</div>
                    <div class="table-responsive">
                        <table class="table table-hover manage-u-table">
                            <thead>
                                <tr>
                                    <th width="20%" class="text-center">CODIGO</th>
                                    <th width="20%">APELLIDOS</th>
                                    <th width="20%">NOMBRES</th>
                                    <th width="20%">ASISTIÓ</th>
                                    <th width="20%">MIEMBROS O VISITANTES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(miembro,index) in arrayMiembros" :key="index">
                                    <!--<td class="text-center" v-text="miembro.CodCon"></td>-->
                                    <td>
                                        <input v-model="miembro.CodCon" style="background-color:#2f323e; color:#7ba2b4;" type="text" class="form-control"  :readonly="true"> 
                                    </td>
                                    <td>
                                        <!--<span class="text-muted">{{ miembro.NomCon}} {{ miembro.ApeCon }}</span>  v-bind:value="miembro.ApeCon"-->                                        
                                        <input v-model="miembro.ApeCon" style="background-color:#2f323e; color:#7ba2b4;" type="text" class="form-control" :readonly="true"> 
                                    </td>
                                    <td>
                                        <!--<span class="text-muted">{{ miembro.NomCon}} {{ miembro.ApeCon }}</span>-->                                        
                                        <input v-model="miembro.NomCon" style="background-color:#2f323e; color:#7ba2b4;" type="text" class="form-control" :readonly="true"> 
                                    </td>
                                    <td>
                                        <select v-model="miembro.FecNacCon" style="background-color:#ff7676; color:#fff" class="form-control" @change="asistencia()">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                            <option value="JU">JU</option>                                            
                                        </select>
                                    </td>
                                    <td>                                    
                                        <!--<span class="text-muted" v-text="miembro.TipCon"></span>-->
                                        <input style="background-color:#2f323e; color:#7ba2b4;" type="text" class="form-control" v-bind:value="miembro.TipCon" :readonly="true"> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button @click="registrarInforme()" type="button" class="btn waves-effect waves-light btn-info">Enviar Informe</button>        
    </div>    
    </div>    
</template>

<script>
    import {Money} from 'v-money';
    import DatePick from 'vue-date-pick';
    import 'vue-date-pick/dist/vueDatePick.css';

    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import 'sweetalert2/src/sweetalert2.scss';

    export default {
        components: {Money, DatePick},
        data(){
            return{
                arrayCdp: [],
                arrayMiembros: [],
                lista: 0,
                arrayInformeDatosMentor: [],
                arrayInformeDatosLider: [],      
                errorInforme: 0,     
                errorMostrarMsjInforme : [],       
                Siasis : 0,
                Noasis : 0,         
                totasis : 0,     
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: '$ ',                    
                    suffix: '',
                    precision: 2,
                    masked: false,
                },
                ofrenda: 0.00,
                cdp: '',
                date: null,
                tema: '',
                reunieron: 'SI',
                compartir: 1,
                arrayDetalle: [],
            }
        },
        methods : {
            listarCdp (){
                let me=this;
                var url= '/informe/listarCdp';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCdp= respuesta.lista.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarMiembros(idcdp){                
                let me = this;
                this.cdp = idcdp;
                this.lista=1;
                var url = '/informe/listarMiembros?idcdp='+idcdp;
                this.RellenarLideres();
                axios.get(url).then(function(response){
                    var respuesta= response.data;
                    me.arrayMiembros = respuesta.listaMiembros.data;
                    me.convertirNo();
                    me.asistencia();
                })
                .catch(function (error) {
                    console.log(error);
                });                
            },
            RellenarLideres(){
                let me = this;        
                var url = '/informe/listarLideres';
                axios.get(url).then(function(response){
                    var respuesta= response.data;
                    me.arrayInformeDatosMentor = respuesta.mentor.data;
                    me.arrayInformeDatosLider = respuesta.lider.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },              
            validarInforme(){
                let me=this;                
                me.errorInforme=0;
                me.errorMostrarMsjInforme =[];
                
                if (!me.tema) me.errorMostrarMsjInforme.push("Ingrese el tema de la casa de paz");
                if (!me.date) me.errorMostrarMsjInforme.push("Ingrese la fecha del informe");
                if (me.errorMostrarMsjInforme.length) me.errorInforme = 1;                

                return me.errorInforme;                             
            },
            convertirNo(){
                let me=this;
                var variable = "NO";
                me.arrayMiembros.map(function(x){                    
                    x.FecNacCon = variable;        
                });
            },
            registrarInforme(){                        
                if (this.validarInforme()) {
                    return;
                }

                let me = this;

                axios.post('/informe/registrar',{                    
                    'CodCasPaz': this.cdp,
                    'FecInf': this.date,
                    'ReuSiNo' : this.reunieron,
                    'EntSiNo' : '',
                    'OfreReu' : this.ofrenda,
                    'TemaSem' : this.tema,
                    'ApeReunion' : this.compartir,
                    'TotAsiReu' : this.Siasis,
                    'TotAusReu' : this.Noasis,
                    'data' : this.arrayMiembros
                }).then(function (response) {
                    console.log(response);
                    me.cdp='';
                    me.date= null;
                    me.reunieron='SI';
                    me.lista=0;                    
                    me.ofrenda= 0.00;
                    me.tema='';
                    me.compartir=true;
                    me.arrayMiembros=[];
                    Swal.fire(
                        'Registro enviado!',
                        'Has cumplido esta semana :)!',
                        'success'
                    )
                }).catch(function (error) {
                    console.log(error);
                    me.cdp='';
                    me.date= null;
                    me.reunieron='SI';
                    me.lista=0;                    
                    me.ofrenda= 0.00;
                    me.tema='';
                    me.compartir=true;
                    me.arrayMiembros=[];
                    Swal.fire({
                        icon: 'error',
                        title: 'No se envió el informe',
                        text: error
                    })
                });
            },
            asistencia(){
                var length = this.arrayMiembros.length;
                this.totasis = length;
                var Siasis = 0;
                var Noasis = 0;
                for (var i = 0; i < length; i++) {                  
                  if (this.arrayMiembros[i].FecNacCon == "NO") {
                      Noasis = Noasis+1;
                      this.Noasis = Noasis;
                  }else
                  if (this.arrayMiembros[i].FecNacCon == "SI") {
                      Siasis = Siasis+1;
                      this.Siasis = Siasis;
                  }else{
                  if (this.arrayMiembros[i].FecNacCon == "JU") {
                      Siasis = Siasis + 1;
                      this.Siasis = Siasis;
                  }
                  }
                }
            },
        }, 
        mounted() {
            this.listarCdp();            
            console.log('Component mounted.')
        }
    }        
</script>