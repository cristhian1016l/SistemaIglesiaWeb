<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title">Informes Enviados</h3>
                    <p class="text-success">Buscar por: <code>Fecha</code></p>
                    <date-pick v-model="date"  :format="'YYYY-MM-DD'" :inputAttributes="{readonly: true}"></date-pick>
                    <div class="row">
                        <!--/span-->
                        <div class="col-md-3">
                            <button @click="listarInformes(date)" type="button" class="fcbtn btn btn-info btn-outline btn-1b">Buscar Informe {{ date }}</button>
                        </div>
                        <!--/span-->
                    </div>
                    <hr>
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
                                            <a href="#" @click="reportePdf(informe.NumInf, informe.CodLid)" target="_blank" ><div class="col-sm-6 col-md-4 col-lg-3"><i class="fa fa-file-pdf-o"></i></div></a>
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

    export default {
        components: {DatePick},
        data(){
            return{
                arrayInforme : [],
                date: " ",
                msj: 0,
                informesNumber: null,
            }
        },
        methods : {
            listarInformes(fecha){
                let me=this;
                me.date = fecha;
                me.msj=1;
                var url= '/informe/listarInformesRed?date='+fecha+" 00:00:00";
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayInforme= respuesta.informe.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            reportePdf($NumInf, $codcon){
                window.open('/informe/ReportesPdf?NumInf='+$NumInf+'&CodCon='+$codcon, '_blank');
            }
        }, 
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>