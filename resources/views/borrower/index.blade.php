@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-12 mb-12 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Borrowers</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('borrower.create') }}" class="btn btn-sm btn-primary">Add borrower</a>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th>Email</th>
                                    <th>Loans</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            @forelse ($borrowers as $borrower)
                                <tr>
                                    <td>{{$borrower->fname}} {{ $borrower->lname }} </td>
                                    <td>{{ $borrower->cnumber }}</td>
                                    <td>{{ $borrower->email }}</td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('borrower.view', $borrower->id ) }}" class="btn btn-sm btn-info">View</a>
                                        <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->
                                        <form action="{{ route( 'borrower.delete', $borrower->id ) }}" method="post" style="display:inline-block;">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirm('{{ __("Are you sure you want to delete $borrower->fname $borrower->lname") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
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
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush