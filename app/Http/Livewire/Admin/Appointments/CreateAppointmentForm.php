<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Patient;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
	public $state = [];

	public function createAppointment()
	{
		//validate
		$this->state['time'] = '00:00:00';
		$this->state['status'] = 'open';
		Appointment::create($this->state);

		$this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully!']);
	}

    public function render()
    {
    	$patients = Patient::all();

        return view('livewire.admin.appointments.list-appointment', [
        	'patients' => $patients,
        ]);
    }
}
