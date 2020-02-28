@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-6 mb-12 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Roles</h3>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addRole">Add role</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">role name</th>
                                    <th scole="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>    
                                        <form action="{{ route('roles.delete', $role->name) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirm('{{ __("Are you sure you want to delete this role?") }}') ? this.parentElement.submit() : ''">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>    

                                    </td>
                                </tr>
                            @empty
                                <h3>No Records</h3>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"></h3>
                            </div>
                            <div class="col text-right">
                                <!-- <a href="#!" class="btn btn-sm btn-primary">See all</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <form method="post" action="{{ route('roles.store') }}">
                @csrf
                @method('put')
              <div class="modal-body">
                <div class="form-group">
                    <label class="form-control-label" for="name">Name</label>
                    <input type="text" name="name" id="input-name" class="form-control" placeholder="{{ __('Role Name') }}" value="" required autofocus maxlength="15">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary">Create Role</button>
              </div>

            </form>
            </div>
          </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush