@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="col">
                            <h3 class="mb-0">Borrowers</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="bording">
                            <h3>{{ \App\Borrower::all()->count() }}</h3>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="col">
                            <h3 class="mb-0">Loans</h3>
                        </div>                        
                    </div>
                    <div class="card-body">
                        <div class="bording">
                            <h3>{{ \App\Loan::all()->count() }}</h3>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header border-0">
                        
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header border-0">
                        
                    </div>
                    <div class="card-body">
                        
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