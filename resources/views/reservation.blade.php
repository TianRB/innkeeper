@extends('master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>Reservar</p>
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
  <p>Información de la Habitación</p>
</div>
<form action="{{ url('reservation') }}" method="POST">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="" name="nombre" value="{{ old('nombre') }}">
    <small id="emailHelp" class="form-text text-muted">Placeholder</small>
  </div>
  <div class="form-group">
    <label for="apellido">Apellido</label>
    <input type="text" class="form-control" id="apellido" aria-describedby="emailHelp" placeholder="" name="apellido" value="{{ old('apellido') }}">
    <small id="emailHelp" class="form-text text-muted">Placeholder</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="" name="email" value="{{ old('email') }}">
    <small id="emailHelp" class="form-text text-muted">Placeholder</small>
  </div>
  <div class="form-group">
    <label for="tel">Teléfono</label>
    <input type="text" class="form-control" id="tel" aria-describedby="emailHelp" placeholder="" name="tel" value="{{ old('tel') }}">
    <small id="emailHelp" class="form-text text-muted">Placeholder</small>
  </div>
  <div class="form-group">
    <label for="notes">Notas</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes" value="{{ old('notes') }}"></textarea>
    <small id="emailHelp" class="form-text text-muted">Placeholder</small>
  </div>
{{--   <div class="form-group">
    <select class="form-control" id="exampleFormControlSelect1" name="room">
      @foreach ($rooms as $room)
        <option value="{{ $room->id }}">{{ $room->name }}</option>
	  @endforeach
    </select>
  </div> 
  <div class="form-group">
    <label for="start-date">Fecha de entrada:</label>
    <input type="text" id="start-date" width="276" name="inicio" value="{{ old('inicio') }}"/>
  </div>
  <div class="form-group">
    <label for="end-date">Fecha de salida:</label>
    <input type="text" id="end-date" width="276" name="final" value="{{ old('final') }}"/>
  </div>--}}
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

    <script>
        $('#start-date').datepicker({
            uiLibrary: 'bootstrap4'
            
        });
        $('#end-date').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection