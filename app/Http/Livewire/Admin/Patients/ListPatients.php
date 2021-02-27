<?php

namespace App\Http\Livewire\Admin\Patients;

use Carbon\Carbon;
use App\Models\Refer;
use App\Models\Patient;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Admin\AdminComponent;

class ListPatients extends AdminComponent
{
    public $state = [];
    public $patient;
    public $patientIdBeingRemoved = null;

    public $showEditModal = false;

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createPatient()
    {
        $validatedData = Validator::make($this->state,[
            'nombre' => 'required',
            'email' => 'required|email|unique:patients',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'direccion' => 'required',
            'telefono_1' => 'required|unique:patients',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'ocupacion' => 'nullable',
            'ultima_visita' => 'nullable',
            'telefono_2' => 'nullable',
            'refer_id' => 'required',
        ])->validate();

        Patient::create($validatedData);

        //session()->flash('message', 'Patient added successfuly!');

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Paciente ingresado satisfactoriamente!']);

    }

    public function render()
    {
        $patients = Patient::latest()->paginate(15);
        $refers = Refer::all();

        return view('livewire.admin.patients.list-patients')->with('patients',$patients)->with('refers', $refers);
    }

    public function editPatient(patient $patient)
    {
        $this->showEditModal = true;

        $this->patient = $patient;

        $this->state = $patient->toArray();

        $this->dispatchBrowserEvent('show-form');


    }

    public function updatePatient()
    {

        $validatedData = Validator::make($this->state,[
            'nombre' => 'required',
            'email' => 'required|email',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'direccion' => 'required',
            'telefono_1' => 'required',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'ocupacion' => 'nullable',
            'ultima_visita' => 'nullable',
            'telefono_2' => 'nullable',
            'refer_id' => 'required',
        ])->validate();

        $this->patient->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Paciente actualizado exitosamente!']);

    }
    public function confirmPatientRemoval($PatientId)
    {
        $this->patientIdBeingRemoved = $PatientId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deletePatient()
    {
        $patient = Patient::findOrFail($this->patientIdBeingRemoved);
        $patient->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Paciente eliminado exitosamente!']);
    }

}
