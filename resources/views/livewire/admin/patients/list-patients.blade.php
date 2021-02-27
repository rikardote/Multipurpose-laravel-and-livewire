<div>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Pacientes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Pacientes</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <div class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end mb-2">
                    <button wire:click.prevent="addNew" class="btn btn-primary">
                        <i class="fa fa-plus-circle mr-1">
                            Agregar nuevo paciente
                        </i>
                    </button>
                </div>
              <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Nombre</th>
                                 <th scope="col">Edad</th>
                                 <th scope="col">Direccion</th>
                                 <th scope="col">email</th>
                                 <th scope="col">telefono</th>
                                 <th scope="col">Opciones</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td scope="row"> {{$patient->id }} </td>
                                    <td>{{ $patient->fullname  }}</td>
                                    <td>{{ $patient->age }} </td>
                                    <td>{{ $patient->direccion }} </td>
                                    <td>{{ $patient->email }} </td>
                                    <td>{{ $patient->telefono_1 }} </td>
                                    <td>
                                        <a href="" wire:click.prevent="editPatient({{ $patient }})" >
                                            <i class="fa fa-edit mr-2"></i>
                                        </a>
                                        <a href="" wire:click.prevent="confirmPatientRemoval({{ $patient->id }})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $patients->links() }}
                </div>
              </div>

            </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
      <!-- Modal -->
        <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" data-backdrop="false" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updatePatient' : 'createPatient' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                                <span>Modificar Paciente</span>
                            @else
                                <span>Agregar Nuevo Paciente</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_paterno">Apellido Paterno</label>
                                        <input type="text" wire:model.defer="state.apellido_paterno" class="form-control @error('apellido_paterno') is-invalid @enderror" id="apellido_paterno" aria-describedby="apellido_paternoHelp" placeholder="Ingresa Apellido Paterno">
                                        @error('apellido_paterno')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellido_materno">Apellido Materno</label>
                                        <input type="text" wire:model.defer="state.apellido_materno" class="form-control @error('apellido_materno') is-invalid @enderror" id="apellido_materno" aria-describedby="apellido_maternohelp" placeholder="Ingresa Apellido Materno">
                                        @error('apellido_materno')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre(s)</label>
                                        <input type="text" wire:model.defer="state.nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" aria-describedby="nombreHelp" placeholder="Ingresa el nombre">
                                        @error('nombre')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="direccion">Direccion</label>
                                    <input type="text" wire:model.defer="state.direccion" class="form-control @error('direccion') is-invalid @enderror" id="direccion" aria-describedby="direccionHelp" placeholder="Ingresa la direccion">
                                    @error('direccion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="telefono_1">Telefono 1</label>
                                            <input type="string" wire:model.defer="state.telefono_1" class="form-control @error('telefono_1') is-invalid @enderror" id="telefono_1" aria-describedby="telefono_1Help" placeholder="Telefono principal 10 digitos">
                                            @error('telefono_1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <label for="telefono_2">Telefono 2</label>
                                            <input type="string" wire:model.defer="state.telefono_2" class="form-control @error('telefono_2') is-invalid @enderror" id="telefono_2" aria-describedby="telefono_2Help" placeholder="Telefono adicional 10 digitos">
                                            @error('telefono_2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                    <input type="text" wire:model="state.fecha_nacimiento" onchange="@this.set('state.fecha_nacimiento', this.value);" class="form-control" @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" data-mask>
                                    @error('fecha_nacimiento')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="responsable">Responsable del menor</label>
                                    <input type="text" wire:model.defer="state.responsable" class="form-control"  id="responsable" placeholder="Si es menor de edad, ingresar el responsable"/>
                                    @error('responsable')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <label for="sexo">Sexo</label>
                                <div class="form-group">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" wire:model.defer="state.sexo" type="radio" name="sexo" id="sexo", value="Femenino">
                                        <label class="form-check-label" for="inlineRadio1">Femenino</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" wire:model.defer="state.sexo" type="radio" name="sexo" id="sexo" value="Masculino">
                                        <label class="form-check-label" for="inlineRadio2">Masculino</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Ingresa E-mail">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ocupacion">Ocupacion</label>
                                    <input type="text" wire:model.defer="state.ocupacion" class="form-control"  id="ocupacion" placeholder="Ocupacion"/>
                                    @error('ocupacion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ultima_visita">Ultima visita al destista</label>
                                    <input type="text" wire:model.defer="state.ultima_visita" class="form-control" id="ultima_visita" placeholder="Ultima visita"/>
                                    @error('ultima_visita')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="refer_id">Medio de informacion</label>
                                    <select wire:model.defer="state.refer_id" class="form-control" wire:model.defer="state.refer_id">
                                        @foreach($refers as $refer)
                                            <option value="{{ $refer->id }}">{{ $refer->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('refer_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times mr-1"></i> Cancel</button>
                            <button type="submit" class="btn btn-primary"> <i class="fa fa-save mr-1"></i>
                                @if($showEditModal)
                                    <span>Guardar Cambios</span>
                                @else
                                    <span>Guardar</span>
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Borrar Paciente</h5>
                    </div>
                    <div class="modal-body">
                        <h4>Seguro de borrar este paciente?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times mr-1"></i> Cancelar</button>
                        <button type="button" wire:click.prevent="deletePatient" class="btn btn-danger"> <i class="fa fa-trash mr-1"></i>Borrar Paciente</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
