@extends('master')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>Landing</p>
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
<form action="{{ url('register') }}" method="POST">
  {{ csrf_field() }}
  <div class="form-group">
    <select class="form-control" id="exampleFormControlSelect1" name="room">
      @foreach ($roomTypes as $roomType)
        <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
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
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

    <script>
        $('#start-date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
            
        });
        $('#end-date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy'
        });
    </script>
@endsection