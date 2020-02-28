@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="mb-0">Personal info</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><span class="text-muted">First Name :</span> {{ $borrower->fname }}</p>
                        <p class="mb-0"><span class="text-muted">Last Name :</span> {{ $borrower->lname }}</p>
                        <p class="mb-0"><span class="text-muted">Middle Name :</span> {{ $borrower->mi }}</p>
                        <p class="mb-0"><span class="text-muted">Age :</span> {{ $borrower->age }}</p>
                        <p class="mb-0"><span class="text-muted">Date of Birth :</span> {{ date("M d Y", strtotime($borrower->birth_date))  }}</p>
                        <p class="mb-0"><span class="text-muted">Civil Status :</span> {{ $borrower->civil_status }}</p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Contact Info</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><span class="text-muted">Contact Number :</span> {{ $borrower->cnumber }}</p>
                        <p class="mb-0"><span class="text-muted">Email :</span> {{ $borrower->email }}</p>
                        <p class="mb-0"><span class="text-muted">Address :</span> {{ $borrower->address }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Current Employment Details</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><span class="text-muted">Employment Status :</span> {{ $borrower->employment_status }}</p>
                        <p class="mb-0"><span class="text-muted">Company :</span> {{ $borrower->company }}</p>
                        <p class="mb-0"><span class="text-muted">Job Title :</span> {{ $borrower->job_title }}</p>
                        <p class="mb-0"><span class="text-muted">Monthly income :</span> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Loans</h3>
                            </div>
                            <div class="col text-right">
                                <!-- <a href="" class="btn btn-sm btn-primary">Add loan</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('ID') }}</th>
                                    <th scope="col">{{ __('Amount') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrower->loans as $loan)
                                    <tr>
                                        <td><a href="{{ route('loans.view', $loan->id) }}"> {{ $loan->id }} </a></td>
                                        <td><span>{{ $loan->amount }}</span></td>
                                        <td><span class="success">ACTIVE</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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