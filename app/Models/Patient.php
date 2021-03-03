<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;



    protected $fillable = [
        'direccion',
        'apellido_paterno',
        'apellido_materno',
        'nombre',
        'email',
        'telefono_1',
        'telefono_2',
        'responsable',
        'ocupacion',
        'sexo',
        'refer_id',
        'fecha_nacimiento',
        'ultima_visita'
    ];


    public function getfullnameAttribute($value)
    {

       return $this->apellido_paterno.' '.$this->apellido_materno.' '.$this->nombre;

    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }

    public function setnombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }
    public function setapellidopaternoAttribute($value)
    {
        $this->attributes['apellido_paterno'] = strtoupper($value);
    }
    public function setapellidomaternoAttribute($value)
    {
        $this->attributes['apellido_materno'] = strtoupper($value);
    }
    public function setocupacionAttribute($value)
    {
        $this->attributes['ocupacion'] = strtoupper($value);
    }
    public function setemailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function setresponsableAttribute($value)
    {
        $this->attributes['responsable'] = strtoupper($value);
    }
    public function setdireccionAttribute($value)
    {
        $this->attributes['direccion'] = strtoupper($value);
    }

    protected $casts = [
    	'fecha_nacimiento' => 'date:d/m/Y',
    ];

    public function setfechanacimientoAttribute($value)
    {
        $this->attributes['fecha_nacimiento'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

}
