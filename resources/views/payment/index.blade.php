@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-money-coins mr-2"></i>Payments made</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Upcoming</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Delayed</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        <div class="table-responsive">
                                            <!-- Projects table -->
                                            <table class="table align-items-center table-flush" id="payments-made">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Loan ID</th>
                                                        <th scope="col">Borrower</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $payment)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('loans.view', $payment->loan_id) }}">{{ $payment->loan_id }}</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('borrower.view', $payment->loan->borrower->id) }}">{{ $payment->loan->borrower->fname }} {{ $payment->loan->borrower->lname }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $payment->amount }}
                                                        </td>
                                                        <td>
                                                            {{ $payment->date_processed }}
                                                        </td>
                                                    </tr>                                    
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                        <div class="table-responsive">
                                            <!-- Projects table -->
                                            <table class="table align-items-center table-flush" id="upcoming-payments">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Loan ID</th>
                                                        <th scope="col">Borrower</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Payment Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($upcoming_payments as $payment)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('loans.view', $payment->loan_id) }}">{{ $payment->loan_id }}</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('borrower.view', $payment->loan->borrower->id) }}">{{ $payment->loan->borrower->fname }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $payment->amount }}
                                                        </td>
                                                        <td>
                                                            {{ $payment->payment_sched }}
                                                        </td>
                                                    </tr>                                    
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <p class="description">Delayed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $('#upcoming-payments').DataTable({
            "pagingType": "numbers"
        });
        $('#payments-made').DataTable({
            "pagingType": "numbers"
        });
        $(function(){
            $("#release_date").datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush