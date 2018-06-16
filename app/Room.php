<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation;
use Carbon\Carbon;

class Room extends Model
{
	/*
	function isAvailable($start, $end){}
	Revisa que la habitación esté disponible entre dos fechas
	$start = Fecha de inicio del rango
	$end = Fecha de fin del rango
	*/
    public function isAvailable($start, $end)
    {
    	$available = false; //Se asume que la habitación no esta disponible.
    	$reservations = Reservation::where('room', $this->number)->get();//Buscar todas las reservaciones de esta habitación.
    	//Ley de overlap de rangos: (StartA <= EndB) and (EndA >= StartB)
    	foreach ($reservations as $res) {	//Por cada reservación como $res
			$startB = Carbon::createFromFormat('Y-m-d', $res->start);  //Fecha de inicio
	        $endB = Carbon::createFromFormat('Y-m-d', $res->end);     //Fecha de final
	        // Ley de overlap de rangos: (StartA <= EndB) and (EndA >= StartB)
    		if (!($start <= $endB && $end >= $startB)){ //Si las fechas no se interrumpen con las que se piden
    			$available = true;
    		}
    	}
    	/*
    	if ($available) {
    		dd('El espacio esta disponible');
    	} else {
    		dd('El espacio no esta disponible.    StartA:'.$start.'    EndA:'.$end.'    Reservations:'.$reservations);
    	}*/
    	return $available;
    }
}
