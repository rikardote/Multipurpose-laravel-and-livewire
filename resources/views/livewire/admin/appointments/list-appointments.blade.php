<div>
    <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Citas</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Citas</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

    <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-12">
        	<div class="d-flex justify-content-end mb-2">
                <button wire:click.prevent="addNew" class="btn btn-primary">
                    <i class="fa fa-plus-circle mr-1">
                        Agendar nueva cita
                    </i>
                </button>
        	</div>
          <div class="card">
            <div class="card-body">
              <table class="table table-hover">
      				  <thead>
      				    <tr>
      				      <th scope="col">#</th>
      				      <th scope="col">Cliente</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Horario</th>
      				      <th scope="col">Status</th>
      				      <th scope="col">Options</th>
      				    </tr>
      				  </thead>
      				  <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <th scope="row">{{$appointment->id}}</th>
                                    <td>{{$appointment->nombre}}</td>
                                    <td>{{$appointment->date}}</td>
                                    <td>{{$appointment->time}}</td>
                                    <td>{{$appointment->status}}</td>
                                    <td>
                                        <a href="">
                                            <i class="fa fa-edit mr-2"></i>
                                        </a>
                                        <a href="" >
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
      				  </tbody>
      				</table>
            </div>
            <div class="card-footer d-flex justify-content-end">

            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateAppointment' : 'createAppointment' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                                <span>Editar Cita</span>
                            @else
                                <span>Agendar Cita</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="content">
                            <div class="container-fluid">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="patient_id">Paciente:</label>
                                                                <div wire:ignore class="input-group date" id="appointmentPatient" data-target-input="nearest" data-appointmentpatient="@this">
                                                                    <select id="appointmentPatientInput" class="form-control mi-selector" data-target="#appointmentPatient">
                                                                        <option value="">Selecciona un Paciente</option>
                                                                        @foreach($patients as $patient)
                                                                            <option value="{{ $patient->id }}">{{ $patient->id }} - {{ $patient->fullname }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Fecha:</label>
                                                                <div wire:ignore class="input-group date" id="appointmentDate" data-target-input="nearest" data-appointmentdate="@this">
                                                                    <input id="appointmentDateInput" type="text" class="form-control datetimepicker-input" data-target="#appointmentDate"/>
                                                                    <div class="input-group-append" data-target="#appointmentDate" data-toggle="datetimepicker">
                                                                        <div class="input-group-text">
                                                                            <i class="far fa-calendar-alt"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Horario:</label>
                                                                <div wire:ignore class="input-group date" id="appointmentTime" data-target-input="nearest" data-appointmenttime="@this">
                                                                    <input  type="text" class="form-control datetimepicker-input" data-target="#appointmentTime" id="appointmentTimeInput">
                                                                    <div class="input-group-append" data-target="#appointmentTime" data-toggle="datetimepicker">
                                                                        <div class="input-group-text">
                                                                            <i class="far fa-clock"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="note">Nota:</label>
                                                                <textarea wire:model.defer="state.note" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="button" class="btn btn-secondary"><i class="fa fa-times mr-1"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Save</button>
                                                </div>

                                            </div>

                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>




  <!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Delete User</h5>
      </div>

      <div class="modal-body">
        <h4>Are you sure you want to delete this user?</h4>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
        <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete User</button>
      </div>
    </div>
  </div>
</div>
</div>
