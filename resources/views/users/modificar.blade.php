@extends('plantilla.dashboard')

@section('title', 'Datos del usuario')

@section('contenido')

@if(Session::has('mensaje'))
    <p class="txt_cent alert alert-success">
        <strong>
            {{ Session::get('mensaje') }}  
        </strong>
        <a href="/datos_usuarios" class="btn btn-info" role="button">Aceptar</a>
    </p>                
@endif

    <h1>Usuario existente</h1>

    <div class="row">
        <div class="col-md-10">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono fijo</th>
                    <th>Telefono celular</th>
                    <th>Dirección</th>
                    <th>Tipo</th>
                </tr>
                    @if($usuario->tipo==='1')
                        <p hidden="hidden">{{$tipoUser='Administrador'}}</p>
                    @else
                        <p hidden="hidden">{{$tipoUser='Normal'}}</p>
                    @endif
                    <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->tel_fijo}}</td>
                        <td>{{$usuario->tel_cel}}</td>
                        <td>{{$usuario->direccion}}</td>
                        <td>{{$tipoUser}}</td>
                    </tr>
            </table>
            <a href="/datos_usuarios" class="btn btn-warning" role="button">Regresar</a>
        </div>
    </div>
    <br>
    <hr>
    <div>


        <form role="form" method="post" action="/modificar_usuario/{{$usuario->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group" id="div-foto" >
                <div >
                    <img src="{{ asset('img/usuarios/'.$usuario->avatar)}}" id="output-m" >
                </div>
                    <br>
                  <label class="btn btn-default" id="etiqueta-m" >Foto de perfil
                    <h6 id="fotico"></h6>
                    <div >
                        <input type="file" class="form-control" name="file" accept="image/*"  onchange="loadFile(event)" title="Cambiar foto de perfil" id="file" value="{{ $usuario->avatar }}">
                    </div>
                  </label>
                  <hr>
              </div> 
              <div class="form-group">
                <label >Nombre</label>
                <input type="text" class="form-control" name="inputNombre" value="{{ $usuario->name }}" required   minlength="3" maxlength="180">
              </div>
              <div class="form-group">
                <label >Correo</label>
                <input type="email" class="form-control" name="inputCorreo" value="{{ $usuario->email }}"  required  minlength="6" maxlength="180">
              </div>
              <div class="form-group">
                <label >Teléfono fijo</label>
                <input type="text" class="form-control" name="inputTelFijo" value="{{ $usuario->tel_fijo }}" required   minlength="1" maxlength="30">
              </div>
              <div class="form-group">
                <label >Teléfono celular</label>
                <input type="text" class="form-control" name="inputTelCel" value="{{ $usuario->tel_cel }}" required   minlength="10" maxlength="30">
              </div>
              <div class="form-group">
                <label >Dirección</label>
                <input type="text" class="form-control" name="inputDireccion" value="{{ $usuario->direccion }}" required   minlength="10" maxlength="200">
              </div>
              <div class="form-group">
                <label >Tipo</label>
                    @if($usuario->tipo==='1')
                        <select class="form-control" name="tipo">
                            <option value="1" selected="selected">1 Administrador</option>
                            <option value="2">2 Normal</option>
                        </select>
                    @elseif($usuario->tipo==='2')
                        <select class="form-control" name="tipo">
                            <option value="1" >1 Administrador</option>
                            <option value="2" selected="selected">2 Normal</option>
                        </select>
                    @endif
              </div>
              <button type="submit" class="btn btn-success btn-block"><i class="fa fa-upload"></i> Aceptar</button>
          </form>
    </div>
          
        
    <br>
  <script>
  var loadFile = function(event) {
    //var output = document.getElementById('output-m');
    //output.src = URL.createObjectURL(event.target.files[0]);
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output-m');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);

    var nom=document.getElementById('file').files[0].name;
    var texto=document.getElementById('fotico').innerHTML=nom;
  };
</script>

@endsection