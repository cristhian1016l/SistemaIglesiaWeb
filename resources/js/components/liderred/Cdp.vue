<template>
    <div class="container">
    <div class="row" v-show="lista==0">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">LISTA DE TODAS LAS CASAS DE PAZ DE SU RED</h3></div>
        </div>
    </div>    

    <div v-show="lista==0">    
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Casas de Paz</h3>
                    <div class="scrollable">
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>CDP</th>
                                        <th>Líder</th>
                                        <th>Dirección</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Día de reunión</th>
                                        <th>Tipo de Casa de Paz</th>
                                        <th>Total Miembros</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>                                                                        
                                    <tr v-for="(cdp, index) in arrayCdp" :key="index">
                                        <td>
                                            <a @click="mostrarMiembros(cdp.CodCasPaz)" v-text="cdp.CodCasPaz"></a>
                                        <td v-text="cdp.Nombres"></td>
                                        <td v-text="cdp.DirCasPaz"></td>
                                        <td v-text="cdp.FecIniCasPaz"></td>
                                        <td v-text="cdp.DiaReuCasPaz"><span class="label label-success"></span></td>                                        
                                        <td v-text="cdp.TipCasPaz"></td>
                                        <td v-text="cdp.TotMimCasPaz"></td>
                                        <td>                                            
                                            <a href="#" @click="reportePdf(cdp.CodCasPaz, cdp.Nombres)" target="_blank" ><div class="col-sm-6 col-md-4 col-lg-3"><i class="fa fa-file-pdf-o"></i></div></a>
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

    <div v-show="lista==1">    
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title">Lista de Miembros</h3>
                    <button class="btn btn-info" @click="vista0()">Regresar</button>
                    <div class="scrollable">
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombres</th>
                                        <th>Telefono</th>
                                        <th>Edad</th>
                                        <th>Fecha de Ingreso</th>
                                        <th>Fecha de Bautizo</th>
                                        <th>Tipo de Creyente</th>
                                    </tr>
                                </thead>
                                <tbody>                                                                        
                                    <tr v-for="(miembro, index) in arrayMiembros" :key="index">
                                        <td v-text="miembro.CodCon"></td>
                                        <td>
                                            <a @click="mostrarDetalles(miembro.CodCon)">{{ miembro.NomCon }} {{ miembro.ApeCon }}</a>
                                        </td>
                                        <td v-text="miembro.NumCel"></td>
                                        <td v-text="calcularEdad2(miembro.FecNacCon)"></td>
                                        <td v-text="miembro.FecReg"><span class="label label-success"></span></td>                                        
                                        <td v-text="miembro.FecBau"></td>
                                        <td v-text="miembro.TipCon"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

        <div class="row" v-show="lista==2">
    <div class="col-md-4 col-xs-12" v-for="(miembroDet, id) in arrayDetalleMiembro" :key="id">
        <div class="white-box">
            <div class="user-bg"> <img width="100%" alt="user" src="/images/users/custom.png"> </div>
            <div class="user-btm-box">
                <!-- .row -->
                <div class="row text-center m-t-10">
                    <div class="col-md-6 b-r"><strong>Nombres</strong>
                        <p v-text="miembroDet.NomCon"></p>
                    </div>
                    <div class="col-md-6"><strong>Apellidos</strong>
                        <p v-text="miembroDet.ApeCon"></p>
                    </div>
                </div>
                <!-- /.row -->
                <hr>
                <!-- .row -->
                <div class="row text-center m-t-10">
                    <div class="col-md-6 b-r"><strong>Email</strong>
                        <p v-text="miembroDet.EmailCon"></p>
                    </div>
                    <div class="col-md-6"><strong>Celular</strong>
                        <p v-text="miembroDet.NumCel"></p>
                    </div>
                </div>
                <!-- /.row -->
                <hr>
                <!-- .row -->
                <div class="row text-center m-t-10">
                    <div class="col-md-12"><strong>Dirección</strong>
                        <p v-text="miembroDet.DirCon"></p>
                    </div>
                </div>
                <hr>
                <button class="btn btn-info" @click="vista1()">Regresar</button>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-xs-12">
        <div class="white-box">
            <!-- .tabs -->
            <ul class="nav nav-tabs tabs customtab">
                <!--<li class="active tab">
                    <a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Proceso</span> </a>
                </li>-->
                <li class="active tab">
                    <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Perfil</span> </a>
                </li>
                <!--<li class="tab">
                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Editar Perfil</span> </a>
                </li>-->
            </ul>
            <!-- /.tabs -->
            <div class="tab-content">
                <!-- .tabs 1 -->
                <div class="tab-pane" id="home">
                    <!--<div class="steamline">
                        <div class="sl-item">
                            <div class="sl-left"> <img src="/images/users/genu.jpg" alt="user" class="img-circle" /> </div>
                            <div class="sl-right">
                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                    <p>assign a new task <a href="#"> Design weblayout</a></p>
                                    <div class="m-t-20 row"><img src="/images/img1.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="/images/img2.jpg" alt="user" class="col-md-3 col-xs-12" /> <img src="/images/img3.jpg" alt="user" class="col-md-3 col-xs-12" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="/images/users/sonu.jpg" alt="user" class="img-circle" /> </div>
                            <div class="sl-right">
                                <div class="m-l-40"> <a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                    <div class="m-t-20 row">
                                        <div class="col-md-2 col-xs-12"><img src="/images/img1.jpg" alt="user" class="img-responsive" /></div>
                                        <div class="col-md-9 col-xs-12">
                                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa</p> <a href="#" class="btn btn-success"> Design weblayout</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="/images/users/ritesh.jpg" alt="user" class="img-circle" /> </div>
                            <div class="sl-right">
                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                    <p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
                                </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="/images/users/govinda.jpg" alt="user" class="img-circle" /> </div>
                            <div class="sl-right">
                                <div class="m-l-40"><a href="#" class="text-info">John Doe</a> <span class="sl-date">5 minutes ago</span>
                                    <p>assign a new task <a href="#"> Design weblayout</a></p>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
                <!-- /.tabs1 -->
                <!-- .tabs2 -->
                <div class="tab-pane active" id="profile">
                    <div class="row" v-for="(miembroDet, id) in arrayDetalleMiembro" :key="id">
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Nombres Completos</strong>
                            <br>
                            <p class="text-muted">{{ miembroDet.NomCon }} {{ miembroDet.ApeCon }}</p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Celular</strong>
                            <br>
                            <p class="text-muted" v-text="miembroDet.NumCel"></p>
                        </div>
                        <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                            <br>
                            <p class="text-muted" v-text="miembroDet.EmailCon"></p>
                        </div>
                        <div class="col-md-3 col-xs-6"> <strong>Dirección</strong>
                            <br>
                            <p class="text-muted" v-text="miembroDet.DirCon"></p>
                        </div>
                    </div>
                    <hr>
                    <!--<h5>Introducción al liderazgo <span class="pull-right">80%</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h5>Evangelismo <span class="pull-right">50%</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h5>Sublíderes de Casa de Paz <span class="pull-right">50%</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>
                    <h5>Líderes de Casa de Paz <span class="pull-right">90%</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>                    
                    <h5>Curso de Mentores <span class="pull-right">70%</span></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>
                    </div>-->
                </div>
                <!-- /.tabs2 -->
                <!-- .tabs3 -->
                <div class="tab-pane" id="settings"  v-for="(miembroDet, id) in arrayDetalleMiembro" :key="id">
                    <form class="form-horizontal form-material">
                        <div class="form-group">
                            <label class="col-md-12">Nombres</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" v-bind:value="miembroDet.NomCon">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Apellidos</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" v-bind:value="miembroDet.ApeCon"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email" v-bind:value="miembroDet.EmailCon"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Celular</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="123 456 7890" class="form-control form-control-line" v-bind:value="miembroDet.NumCel"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Dirección</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Dirección Exacta" class="form-control form-control-line" v-bind:value="miembroDet.DirCon" >
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-line">
                                    <option>London</option>
                                    <option>India</option>
                                    <option>Usa</option>
                                    <option>Canada</option>
                                    <option>Thailand</option>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Actualizar Perfil</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tabs3 -->
            </div>
        </div>
    </div>
    
    </div>
    </div>    
</template>

<script>
    
    export default {
        
        data(){
            return{
                lista: 0,
                arrayCdp: [],
                arrayMiembros: [],
                arrayDetalleMiembro: [],
            }
        },
        methods : {
            listarCdp (){
                let me=this;
                var url= '/cdp/listarCdp';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCdp= respuesta.cdps.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            mostrarMiembros(idcdp){
                let me = this;
                this.lista=1;            
                var url = '/cdp/listarMiembros?idcdp='+idcdp;
                axios.get(url).then(function(response){
                    var respuesta= response.data;
                    me.arrayMiembros = respuesta.listaMiembros.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            mostrarDetalles(codcon){
                let me = this;
                this.lista=2;                
                var url = '/cdp/listarDetalleMiembros?codcon='+codcon;
                axios.get(url).then(function(response){
                    var respuesta= response.data;
                    me.arrayDetalleMiembro = respuesta.detalleMiembro.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            calcularEdad2(fecha) {                             
                if (fecha == null) {
                    return '';
                }
                var hoy = new Date();
                var cumpleanos = new Date(fecha);
                var edad = hoy.getFullYear() - cumpleanos.getFullYear();
                var m = hoy.getMonth() - cumpleanos.getMonth();                

                if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                    edad--;
                }

                return edad;
            },
            vista0() {
                this.lista = 0;
            },
            vista1() {
                this.lista = 1;
            },
            reportePdf($codcdp, $nombres){
                window.open('/informe/ReportesOracion?codcdp='+$codcdp+'&nomlid='+$nombres, '_blank');
            }
        }, 
        mounted() {
            this.listarCdp();            
            console.log('Component mounted.')
        }
    }        
</script>