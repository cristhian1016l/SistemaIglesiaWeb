<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title">Informes Enviados</h3>
                    <p class="text-success">Buscar por: <code>Fecha</code></p>
                    <div class="row">
                        <div class="col-md-3 col-xs-12">
                            <div class="form-group">
                                <div class="input-group" > <span class="input-group-addon">F</span>                                        
                                    <date-pick v-model="date"  :format="'YYYY-MM-DD'" placeholder="Seleccione fecha"></date-pick>
                                </div>                                     
                                                                        
                            </div>                         
                        </div>
                        <!--/span-->
                        <div class="col-md-3">
                            <button @click="listarInformes(date)" type="button" class="fcbtn btn btn-info btn-outline btn-1b">Buscar Informe {{ date }}</button>
                        </div>
                        <!--/span-->
                    </div>
                    <hr>
                    <p class="text-info">Buscar <code>los últimos informes enviados</code></p>
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="button-box">                        
                            <input v-model="informesNumber" type="number" class="form-control" placeholder="Ingrese en numero de registros a buscar"> 
                            <button v-if="informesNumber" @click="listarInformesU(informesNumber)" type="button" class="fcbtn btn btn-success btn-outline btn-1b">Mostrar los últimos {{informesNumber}} registros</button>
                            <button v-else @click="listarInformesU(1)" type="button" class="fcbtn btn btn-success btn-outline btn-1b">Mostrar el último registro enviado</button>
                        </div>
                    </div>
                    </div>
                    <div class="scrollable">
                        <p v-show="msj==1" class="text-warning"> Mostrando informes enviados en: <code>{{ date }} </code></p>
                        <p v-show="msj==2" class="text-warning"> Mostrando los últimos <code>{{ informesNumber }}</code>informes enviados</p>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>CDP</th>
                                        <th>FECHA</th>
                                        <th>ASISTENTES</th>
                                        <th>AUSENTES</th>
                                        <th>OFRENDA</th>
                                        <th>TEMA</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="informe in arrayInforme" :key="informe.NumInf">
                                        <td v-text="informe.NumSem">13</td>
                                        <td><span class="label label-info" v-text="informe.CodCasPaz"></span></td>
                                        <td v-text="informe.FecInf"></td>
                                        <td v-text="informe.TotAsiReu"></td>
                                        <td v-text="informe.TotAusReu">8</td>
                                        <td v-text="informe.OfreReu"></td>
                                        <td v-text="informe.TemaSem"></td>
                                        <td>                                            
                                            <a href="#" @click="reportePdf(informe.NumInf)" target="_blank" ><div class="col-sm-6 col-md-4 col-lg-3"><i class="fa fa-file-pdf-o"></i></div></a>
                                            <a href="#" @click="deleteInforme(informe.NumInf)" ><div class="col-sm-6 col-md-4 col-lg-3"><i class="fa fa-times"></i></div></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</template>

<script>    

    import DatePick from 'vue-date-pick';
    import 'vue-date-pick/dist/vueDatePick.css';

    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import 'sweetalert2/src/sweetalert2.scss';

    export default {
        components: {DatePick},
        data(){
            return{
                arrayInforme : [],
                date: null,
                msj: 0,
                informesNumber: null,
            }
        },
        methods : {
            listarInformes (fecha){
                let me=this;
                me.date = fecha;
                me.msj=1;
                var url= '/informe/listarInformes?date='+fecha+" 00:00:00";
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayInforme= respuesta.informe.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarInformesU(informes){
                let me=this;
                var url= '/informe/listarInformes?num='+informes;
                me.msj=2;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayInforme= respuesta.informe.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            reportePdf($NumInf){
                window.open('/informe/ReportesPdf/'+$NumInf, '_blank');
            },
            deleteInforme(NumInf){
                let me = this;
                Swal.fire({
                title: 'Estás seguro de eliminar este reporte?',
                text: "No podrás revertir esta acción",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, lo quiero eliminar!'
                }).then((result) => {
                if (result.value) {    
                    axios.post('/informe/eliminar',{                    
                    'NumInf': NumInf,                    
                    }).then(function (response) {
                        console.log(response);         
                        me.arrayInforme = [];
                        Swal.fire(
                            'Eliminado!',
                            'El reporte ha sido eliminado.',
                            'success'
                        )
                    }).catch(function (error) {
                        console.log(error);                    
                        Swal.fire({
                            icon: 'error',
                            title: 'No se eliminó el reporte',
                            text: error
                        })
                    });                        
                    }
                })
            }            
        }, 
        mounted() {        
            console.log('Component mounted.')
        }
    }        
</script>