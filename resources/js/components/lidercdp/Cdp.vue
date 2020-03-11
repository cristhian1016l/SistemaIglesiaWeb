<template>
    <div class="container">
    <div class="row" v-show="lista==0">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">CASAS DE PAZ ASIGNADAS</h3></div>
        </div>
    </div>    
    <div class="row" v-show="lista==0">
    <div class="container">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for="(cdp, index) in arrayCdp" :key="index">
        <div class="panel panel-default">
            <div class="panel-heading" v-text="cdp.CodCasPaz"></div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <a @click="listarMiembros(cdp.CodCasPaz)" class="btn btn-custom m-t-10 collapseble" >Elegir Casa de Paz </a>
                    <!--<a @click="modificarCdp(cdp.CodCasPaz); recuperarData(cdp)" class="btn btn-custom m-t-10 collapseble" >Modificar Casa de Paz </a>-->
                    <h4 class="box-title">Dirección</h4>
                    <p v-text="cdp.DirCasPaz"></p> 
                    <h4 class="box-title">Fecha de Inicio</h4>
                    <p v-text="calcularTiempo(cdp.FecIniCasPaz)"></p> 
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
                            &lt;/div&gt; </code> 
                        </div>
                    </div>
                </div>
                <div class="panel-footer"> Hay {{ cdp.TotMimCasPaz }} miembros en esta casa de paz</div>
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

    <div class="row" v-show="lista==3">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">MODIFICAR DATOS DE CASA DE PAZ</h3>
                    <div class="form-group">
                        <label class="col-md-12">CASA DE PAZ {{ codCdp }}</label>
                        <div class="col-md-12">
                            <input style="background-color:#2f323e; color:#7ba2b4;" type="text" class="form-control" v-model="codCdp" :readonly="true"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> DIRECCIÓN </label>
                        <div class="col-md-12">
                            <input type="text" id="example-email" name="example-email" class="form-control" placeholder="Dirección" onkeyup="this.value = this.value.toUpperCase();" v-model="dirCdp"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">DÍA DE REUNIÓN</label>
                        <div class="col-sm-12">
                            <select class="form-control" v-model="diaCdp">
                                <option value="LUNES">LUNES</option>
                                <option value="MARTES87">MARTES</option>
                                <option value="MIERCOLES">MIERCOLES</option>
                                <option value="JUEVES">JUEVES</option>
                                <option value="VIERNES">VIERNES</option>
                                <option value="SABADO">SABADO</option>
                                <option value="DOMINGO">DOMINGO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" @click="actualizarCdp()">ACTUALIZAR CASA DE PAZ</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light" @click="vista0()">CANCELAR</button>
                    </div>
            </div>
        </div>
    </div>


    </div>    
</template>

<script>
    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import 'sweetalert2/src/sweetalert2.scss';

    export default {
        data(){
            return{
                arrayCdp: [],
                arrayMiembros: [],
                lista: 0,
                arrayDetalleMiembro: [],
                arrayDetalleProceso: [],
                arrayDatosUpdate: [],
                arrayCdpData: [],
                codCdp: '',
                dirCdp: '',
                diaCdp: '',
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
                this.lista=1;                
                var url = '/informe/listarMiembros?idcdp='+idcdp;
                axios.get(url).then(function(response){
                    var respuesta= response.data;
                    me.arrayMiembros = respuesta.listaMiembros.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            modificarCdp(idcdp){
                let me = this;
                this.lista=3; 
                var url = '/informe/editarCdp?idcdp='+idcdp;
                axios.get(url).then(function(response){
                    var respuesta= response.data;
                    me.arrayCdpData = respuesta.cdp.data;  
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            recuperarData(data = [])
            {
                let me = this;
                me.codCdp=data['CodCasPaz'];
                me.dirCdp=data['DirCasPaz'];
                me.diaCdp=data['DiaReuCasPaz'];
            },    

            actualizarCdp()
            {               
                let me = this;

                axios.put('/informe/editarCdp',{
                    'CodCasPaz': this.codCdp,
                    'DirCasPaz': this.dirCdp,
                    'DiaReuCasPaz': this.diaCdp,
                }).then(function (response) {
                    me.codCdp = '';
                    me.dirCdp = '';
                    me.diaCdp = '';
                    Swal.fire(
                        'Casa de Paz editada Correctamente!',
                        '',
                        'success'
                    )
                    me.lista = 0;
                }).catch(function (error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'No se editó la Casa de Paz',
                        text: error
                    })
                    me.lista = 0;
                }); 
            },

            mostrarDetalles(codcon){
                let me = this;
                this.lista=2;                
                var url = '/informe/listarDetalleMiembros?codcon='+codcon;
                axios.get(url).then(function(response){
                    var respuesta= response.data;
                    me.arrayDetalleMiembro = respuesta.detalleMiembro.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            calcularTiempo(fecha){
                var date = new Date(),
                vfecha = new Date(fecha);
                var diff = Math.floor(date.getTime() - vfecha.getTime());
                var day = 1000 * 60 * 60 * 24;

                var days = Math.floor(diff/day);
                var months = Math.floor(days/31);
                var years = Math.floor(months/12);

                var message = "";
                message += " esta casa de paz tiene "
                message += days + " días activo" 
                /*message += months + " months "
                message += years + " years ago \n"*/
                return message
            },

            calcularEdad(fecha){
                var date = new Date(),
                vfecha = new Date(fecha);
                var diff = Math.floor(date.getTime() - vfecha.getTime());
                var day = 1000 * 60 * 60 * 24;

                var days = Math.floor(diff/day);
                var months = Math.floor(days/31);
                var years = Math.floor(months/12);

                var message = "";
                message += years + " años \n"
                return message
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
            
            formatoFechaConversion(fecha) {
                var info = fecha.split('-').reverse().join('/');
                return info;
            },

            vista0()
            {
                this.lista = 0;
            },

            vista1(){
                this.lista = 1;
            },

            vista2(){
                this.lista = 2;
            }
            
        },
        mounted() {
            this.listarCdp();
            console.log('Component mounted.')
        }
    }
</script>
