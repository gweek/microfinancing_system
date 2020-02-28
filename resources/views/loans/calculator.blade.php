@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-12 mb-12 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Calculator</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                              <form id="calculate-form" method="get">
                                <div class="form-group">
                                    <label class="form-control-label" for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="{{ __('Amount') }}" value="{{ old('amount') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="interest">Interest</label>
                                    <input type="number" step="0.01" min="0" name="interest" id="interest" class="form-control" placeholder="{{ __('Interest') }}" value="{{ old('interest') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="terms">Terms / Months</label>
                                    <input type="number" name="terms" id="terms" class="form-control" placeholder="{{ __('Terms') }}" value="{{ old('terms') }}" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="frequency" class="form-control-label">Frequency</label>
                                    <select value="{{ old('frequency') }}" name="frequency" id="frequency" class="form-control" required>
                                        <option value="Weekly">Weekly</option>
                                        <option value="2 Weeks">2 Weeks</option>
                                        <option value="Monthly">Monthly</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="release_date">Release Date</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input name="release_date" id="release_date" class="form-control col-5" placeholder="Select date" type="date" value="{{ old('release_date') }}" data-date-format="yyyy-mm-dd" required>
                                    </div>
                                </div>     
                                <button type="button" class="btn btn-sm btn-info" id="calculate">Calculate</button>
                              </form>
                            </div>
                            <div class="col-md-8">
                                <div class="computation-area pl-5">
                                    <div class="com-details mb-3">
                                        <h3>Computation</h3>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td colspan="6"><span class="text-info">Loan Amount:</span></td>
                                                    <td class="pl-5"><span id="lamount"></span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"><span class="text-info">Interest per Month:</span></td>
                                                    <td class="pl-5"><span id="minterest"> </span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"><span class="text-info">Interest per Term:</span></td>
                                                    <td class="pl-5"><span id="tinterest"></span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"><span class="text-info">Amount per Term:</span></td>
                                                    <td class="pl-5"><span id="amount-term"></span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"><span class="text-info">Total Payment:</span></td>
                                                    <td class="pl-5"><span id="total-payment"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="com-payments">
                                        <h3>Payment dates</h3>
                                        <table class="table">
                                           <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Payment #</th>
                                                    <th scope="col">Amount</th>
                                                    <th>Payment Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="payment-dates">
                                                
                                            </tbody>
                                        </table>
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

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){

            $('#calculate').on('click', function(e){
                e.preventDefault();

                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': '<?php echo csrf_token() ?>',
                  }
                });

                var data = $('#calculate-form').serialize();
                // console.log(data);
                $.ajax({
                   type:'get',
                   url:'/ajaxCalculate',
                   data: data,
                   success:function(response) {

                      $('span#lamount').text($('input[name="amount"]').val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                      $('span#minterest').text(response.monthly_interest.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                      $('span#tinterest').text(response.interest.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                      $('span#amount-term').text(response.amount_term.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                      $('span#total-payment').text(response.total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

                      var payment_table = '';
                      $.each( response.dates, function(key, value){
                            payment_table += '<tr><td>'+value.id+'</td><td>'+value.amount+'</td><td>'+value.date+'</td></tr>'
                      });

                      $('tbody#payment-dates').html(payment_table);

                   }
                });
            });
        });
    </script>
@endpush