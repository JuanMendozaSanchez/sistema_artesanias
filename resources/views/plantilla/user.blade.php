
@extends('plantilla.dashboard')

@section('title', 'Perfil')

@section('contenido')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="{{ asset('img/muestra/tres.jpg') }}" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="{{ asset('img/usuarios/'.Auth::user()->avatar)}}" alt="..."/>
                                  <h4 class="title">{{ Auth::user()->name }}<br />
                                    @if(Auth::user()->tipo=='1')
                                        <p><small>Administrador</small><p>
                                    @else
                                        <p><small>Normal</small><p>
                                    @endif
                                     
                                  </h4>
                                </div>
                                <p class="description text-center">
                                    {{ Auth::user()->direccion }}
                                </p>
                                <p class="description text-center">
                                     Celular: {{ Auth::user()->tel_cel }}
                                </p>
                                <p class="description text-center">
                                    Correo: {{ Auth::user()->email }}
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <!--<h5>12<br /><small>Files</small></h5>-->
                                    </div>
                                    <div class="col-md-4">
                                        <h5>{{ Auth::user()->id }}<br /><small>Clave</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <!--<h5>24,6$<br /><small>Spent</small></h5>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="card">
                            <div class="header">
                                <h4 class="title">Team Members</h4>
                            </div>
                            <div class="content">
                                <ul class="list-unstyled team-members">
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('recursos/img/faces/face-0.jpg')}}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        DJ Khaled
                                                        <br />
                                                        <span class="text-muted"><small>Offline</small></span>
                                                    </div>

                                                    <div class="col-xs-3 text-right">
                                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('recursos/img/faces/face-1.jpg')}}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        Creative Tim
                                                        <br />
                                                        <span class="text-success"><small>Available</small></span>
                                                    </div>

                                                    <div class="col-xs-3 text-right">
                                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('recursos/img/faces/face-3.jpg')}}" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        Flume
                                                        <br />
                                                        <span class="text-danger"><small>Busy</small></span>
                                                    </div>

                                                    <div class="col-xs-3 text-right">
                                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-envelope"></i></btn>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                            </div>
                        </div>-->
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Perfil</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="/modificar_usuario/{{Auth::user()->id}}">
                                    @csrf
                                    <input type="hidden" class="form-control" name="file" id="file" value="">
                                    <input type="hidden" class="form-control" name="profile" id="file" value="activado">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Clave</label>
                                                <input type="text" class="form-control border-input" disabled placeholder="Clave" value="{{ Auth::user()->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="inputNombre" class="form-control border-input" placeholder="Usuario" value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Dirección de correo</label>
                                                <input type="email" name="inputCorreo" class="form-control border-input" placeholder="Correo" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Teléfono fijo</label>
                                                <input type="text" name="inputTelFijo" class="form-control border-input" placeholder="Teléfono fijo" value="{{ Auth::user()->tel_fijo }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Teléfono celular</label>
                                                <input type="text" name="inputTelCel" class="form-control border-input" placeholder="Teléfono celular" value="{{ Auth::user()->tel_cel }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" name="inputDireccion" class="form-control border-input" placeholder="Dirección actual" value="{{ Auth::user()->direccion }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            @if(Auth::user()->tipo=='1')
                                                <div class="form-group">
                                                    <label>Tipo usuario</label>
                                                    <input type="hidden" name="tipo" value="{{ Auth::user()->tipo }}">
                                                    <input type="text"  class="form-control border-input" disabled placeholder="Tipo usuario" value="Administrador">
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label>Tipo usuario</label>
                                                    <input type="hidden" name="tipo" value="{{ Auth::user()->tipo }}">
                                                    <input type="text" name="tipo" class="form-control border-input" disabled placeholder="Tipo usuario" value="Normal">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <!--<div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control border-input" placeholder="Country" value="Australia">
                                            </div>-->
                                        </div>
                                        <div class="col-md-4">
                                            <!--<div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="number" class="form-control border-input" placeholder="ZIP Code">
                                            </div>-->
                                        </div>
                                    </div>

                                    <!--<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" value="Mike">Oh so, your weak rhyme
You doubt I'll bother, reading into it
I'll probably won't, left to my own devices
But that's the difference in our opinions.</textarea>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="text-center">
                                        <hr>
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Actualizar Perfil</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
@endsection
