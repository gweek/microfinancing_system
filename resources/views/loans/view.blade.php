@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-5 pb-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                        <table class="loan-details">
                            <tbody>
                                <tr>
                                    <td colspan="4"><b>Loan ID:</b></td>
                                    <td class="pl-3"><span>{{ $loan->id }}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><span>Borrower:</span></td>
                                    <td class="pl-3"><span>{{ $loan->borrower->fname }}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><span>Release Date:</span></td>
                                    <td class="pl-3"><span>{{ $loan->release_date }}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><span>Interest:</span></td>
                                    <td class="pl-3"><span>{{ $loan->interest }}%</span></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><span>Amount:</span></td>
                                    <td class="pl-3"><span>{{ number_format($loan->amount, 2,'.',',') }}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><span>Status:</span></td>
                                    <td class="pl-3"><span class="{{ ( $loan->loanSetting->status === 'paid' ) ? 'success' : 'primary' }}">{{ $loan->loanSetting->status }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="loan-details">
                                <tbody class="">
                                    <tr>
                                        <td colspan="6"><span class="">Loan Type:</span></td>
                                        <td class="pl-3"><span id="lamount">Flate Rate</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><span>Amount:</span></td>
                                        <td class="pl-3"><span>{{ number_format($loan->amount, 2,'.',',') }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><span class="">Interest per Month:</span></td>
                                        <td class="pl-3"><span id="minterest">{{ number_format($loan->loanSetting->loan_interest_month, 2,'.',',') }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><span class="">Interest per Term:</span></td>
                                        <td class="pl-3"><span id="tinterest">{{ number_format($loan->loanSetting->loan_interest_term, 2,'.',',') }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><span class="">Amount per Term:</span></td>
                                        <td class="pl-3"><span id="amount-term">{{ number_format($loan->loanSetting->loan_interest_total, 2,'.',',') }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><span class="">Total Payment:</span></td>
                                        <td class="pl-3"><span id="total-payment">{{ number_format($loan->loanSetting->gran_total, 2,'.',',') }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="loan-details">
                                <tbody>
                                    <tr>
                                        <td colspan="4"><span>Loan Term months:</span></td>
                                        <td class="pl-2"><span>{{ $loan->terms }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><span>Loan Period:</span></td>
                                        <td class="pl-2"><span>{{ $loan->frequency }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><span>Annual Int. Rate:</span></td>
                                        <td class="pl-2"><span>{{ $loan->interest }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><span>Payment #:</span></td>
                                        <td class="pl-2"><span>{{ $loan->paymentSchedule->count() }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><span>Next Payment Schedule:</span></td>
                                        <td class="pl-2"><span class="success"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>      
                </div>
            </div>

            <div class="row">
            <div class="col-xl-12 mb-12 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Payment schedule</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Payment #</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Schedule Date</th>
                                    <th scope="col">Processed Date</th>
                                    <th scope="">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($loan->paymentSchedule as $payment)
                                <tr>
                                    <td>
                                        {{ $payment->payment_number }}
                                    </td>
                                    <td>
                                        {{ number_format($payment->amount, 2, '.', ',') }}
                                    </td>
                                    <td>
                                        {{ $payment->payment_sched }}
                                    </td>
                                    <td>
                                        {{ $payment->paid_date }}
                                    </td>
                                    <td>
                                        <span class="{{ ( $payment->status === 'PAID' ) ? 'success' : 'danger' }}">{{ $payment->status }}</span>
                                    </td>
                                    <td>
                                        @if ($payment->status === 'UNPAID')
                                        <button data-payment="{{ $payment->id }}" id="" type="button" class="record-payment btn btn-sm btn-success" data-toggle="modal" data-target="#record-payment-form">Record payment</button>
                                        @endif
                                    </td>
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
    <!-- Modal -->
    <div class="modal fade" id="record-payment-form" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" method="post" id="payment-form">
          <div class="modal-body">
                @csrf
                @method('put')
                <div class="form-group">

                    <div class="form-group">
                        <label class="form-control-label" for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control col-4" placeholder="{{ __('Amount') }}" value="{{ old('amount') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="date_processed">Date processed</label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input type="date" name="date_processed" id="date_processed" class="form-control col-5" placeholder="Select date" type="text" value="{{ old('date_processed') }}"  required>
                        </div>
                    </div>  
                </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">cancel</button>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript">

        $(document).on('click', '.record-payment', function(){
            var origin   = window.location.origin; 
            $("form#payment-form").attr('action', origin+'/payments/create/'+$(this).data('payment'));
        });
    </script>
@endpush