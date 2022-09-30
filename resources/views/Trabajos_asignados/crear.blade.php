@extends('adminlte::page')

@section('title', 'trabajos_asignados')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Asignar Trabajo</h3>
        </div>

        <div class="card-body">
            <form action="{{route('trabajos_asignados.insertar')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Trabajo</label>
                            <select name="trabajo" id="trabajo" class="form-control">
                                @foreach($trabajos as $trabajo)
                                <option value="{{old('trabajo',$trabajo->id)}}">{{$trabajo->nombre}}</option>
                                @endforeach
                            </select>
                            @error('trabajo')
                            <small>*{{ $message }}</small>
                            <br><br>
                        @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Cliente</label>
                            <select name="cliente" id="cliente" class="form-control">
                                @foreach($clientes as $cliente)
                                <option value="{{old('cliente',$cliente->id)}}">{{$cliente->name}}</option>
                                @endforeach
                            </select>
                            @error('cliente')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Tecnico</label>
                            <select name="tecnico" id="tecnico" class="form-control">
                                @foreach($tecnicos as $tecnico)
                                <option value="{{old('tecnico',$tecnico->id)}}">{{$tecnico->name}}</option>
                                @endforeach
                            </select>
                            @error('tecnico')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Fecha</label>
                                <input type="date" class="form-control" name="fecha"  value="fecha">
                                @error('fecha')
                                <small>*{{ $message }}</small>
                                <br><br>
                                @enderror
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>hora</label>
                            <select name="hora" id="hora" class="form-control">
                                @foreach($horas as $hora)
                                <option value="{{old('hora',$hora->id)}}">{{$hora->horaInicio.' - '.$hora->horaFin}}</option>
                                @endforeach
                            </select>
                            @error('hora')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="Asignado">Asignado</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Completado">Completado</option>
                            </select>
                            @error('estado')
                                <small>*{{ $message }}</small>
                                <br><br>
                             @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label>Ubicacion</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="latitud">Latitud</label>
                                    <input type="text" name="latitud" id="latitud" class="form-control" value="{{old('latitud')}}" >
                                    @error('latitud')
                                        <small>*{{ $message }}</small>
                                        <br><br>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="longitud">Longitud</label>
                                    <input type="text" name="longitud" id="longitud" class="form-control" value="{{old('longitud')}}" >
                                    @error('longitud')
                                        <small>*{{ $message }}</small>
                                        <br><br>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div  id="mapa" style="width: 100%; height: 400px;"  ></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark btn-lg">Asignar</button>
                    <a class="btn btn-danger btn-lg" href="{{route('trabajos_asignados.index')}}">Volver</a>
                </div>

            </form>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{-- <script>
    function initMap() {
        var latitud = -17.84530282996219;
        var longitud = -63.159622804077145;

        coordenadas = {
            lng: longitud,
            lat: latitud
        }

        generarMapa(coordenadas);
    }

    function generarMapa(coordenadas) {
        var mapa = new google.maps.Map(document.getElementById('mapa'),{
            zoom: 12,
            center: new google.maps.LatLng(coordenadas.lat,coordenadas.lng)
        });
        
        marcador = new google.maps.Marker({
            map: mapa,
            draggable: true,
            position: new google.maps.LatLng(coordenadas.lat,coordenadas.lng)
        });

        marcador.addListener('drag',function(event){
            document.getElementById("latitud").value = this.getPosition().lat();
            document.getElementById("longitud").value = this.getPosition().lng();
            
        })
        marcador.addListener('click', function() {
          mapa.setZoom(8);
          mapa.setCenter(marcador.getPosition());
        });
        
    }
</script> --}}
<script>
    let map;
  var pines=[];
  function addMarcador(location){
    
    var pin = new google.maps.Marker({
    position:location,
    map:map,
    animation:google.maps.Animation.DROP
    });
    document.getElementById("latitud").value=location.lat();
    document.getElementById("longitud").value=location.lng();
    console.log("latitud",location.lat());
    console.log("longitud",location.lng());
    for(var i in pines){
      pines[i].setMap(null);
    }

    pines.push(pin);

  }
  function initMap() {
    var myOptions = {
        zoom:14,
        center:new google.maps.LatLng(-17.7817528,-63.1810015),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('mapa'),myOptions)
    map.addListener('click',function(event){
      addMarcador(event.latLng);
    });
    var pin = new google.maps.Marker({
    position:new google.maps.LatLng(-17.7817528,-63.1810015),
    map:map,
    title: "Hola Mundo"
    });
    pines.push(pin);

 }  
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZH368gsA1Bnnn0BcY7SJBHpxeD2j5gG8&language=es-419&callback=initMap"></script>
@stop
