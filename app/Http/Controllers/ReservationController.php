<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomType;
use App\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('ReservationController@index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('ReservationController@create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    name
    lastname
    email
    tel
    notes
    start
    end
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'tel' => 'nullable|numeric',
            'inicio' => 'required|before:final|date_format:"m/d/Y"',
            'final' => 'required|after:inicio|date_format:"m/d/Y"',
        ]);
        $input = $request->all();
        dd($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('ReservationController@show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('ReservationController@edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('ReservationController@update');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('ReservationController@destroy');
    }

    public function makeForm(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            //'room' => 'nullable|numeric',
            'inicio' => 'required|before:final|date_format:"d/m/Y"',
            'final' => 'required|after:inicio|date_format:"d/m/Y"',
        ]);
        
        $startDate = Carbon::createFromFormat('d/m/Y', $request->input('inicio'));  //Fecha de inicio
        $endDate = Carbon::createFromFormat('d/m/Y', $request->input('final'));     //Fecha de final
        $allRooms = Room::where('type', $request->input('room'))->get();     //Todas las habitaciones con tipo de Habitación especificado
        $availableRooms = array();  //Se inicializa como arreglo vacío
        foreach ($allRooms as $room) {   //Por cada habitación
            if ($room->isAvailable($startDate, $endDate)) { //Si la habitación esta disponible en fechas
                //dd('Room available');
                array_push($availableRooms, $room);//la habitación se guarda en el arreglo
            } else {
                //dd('Rooms unavailable');
            }
        }
        // dd($availableRooms);

        if (empty($availableRooms)) {
            return Redirect::back()->withErrors(['No hay habitaciones de este tipo disponibles en las fechas seleccionadas']);
        } else {
            return view('reservation', ['rooms' => $availableRooms]);
        }
        // dd($availableRooms);
        // dd('Start Date: '.$startDate.'    End Date: '.$endDate);
        // dd('End of makeForm');

    }
    
    public function roomTypeAvailable($id)
    {

    }
}
