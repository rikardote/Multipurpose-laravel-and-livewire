<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Admin\AdminComponent;

class ListAppointments extends AdminComponent
{
    public $state = [];
    public $appointment;
    public $appointmentIdBeingRemoved = null;

    public $showEditModal = false;

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createAppointment()
    {

       $validatedData = Validator::make($this->state,[
            'patient_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'status' => 'nullable',
            'note' => 'nullable',
        ])->validate();

        Appointment::create($validatedData);

        //session()->flash('message', 'Patient added successfuly!');

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Cita Programada Satisfactoriamente!']);

    }

    public function render()
    {
        $patients = Patient::all();
        $appointments = Appointment::all();

        return view('livewire.admin.appointments.list-appointments', [
        	'patients' => $patients,'appointments' => $appointments,
        ]);
    }
    public function updateAppointment()
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

        $this->appointments->update($validatedData);

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
