@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Loans</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('loans.create') }}" class="btn btn-sm btn-primary">Create loan</a>
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
                        <table class="table align-items-center table-flush" id="loans-table">
                            <thead class="thead-light">
                                <tr>
                                    <th scole="col">ID</th>
                                    <th scope="col">Loan Name</th>
                                    <th scope="col">Borrower</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Interest</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($loans as $loan)
                                    <tr>
                                        <td>{{ $loan->id }}</td>
                                        <td>{{ $loan->loan_name }}</td>
                                        <td><a href="{{ route('borrower.view', $loan->borrower->id) }}">{{ $loan->borrower->fname }} {{$loan->borrower->lname}}</a></td>
                                        <td>{{ number_format($loan->amount, 2,'.', ',')  }}</td>
                                        <td>{{ $loan->interest }}%</td>           
                                        <td><span class="{{ ( $loan->loanSetting->status === 'paid' ) ? 'success' : 'primary' }}">{{ $loan->loanSetting->status }}</span></td>
                                        <td>
                                            <form action="{{ route('loans.delete', $loan->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a class="btn btn-sm btn-primary" href="{{ route('loans.view', $loan->id) }}">{{ __('View') }}</a>
                                                <button class="btn btn-icon btn-sm btn-2 btn-success" type="button">
                                                    <span class="btn-inner--icon"><i class="fa fa-download" aria-hidden="true"></i></span>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirm('{{ __("Are you sure you want to delete $loan->loan_name?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>  
                                        </td>
                                    </tr>
                                @empty
                                    <h2>Nothing found</h2>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
    <!-- Modal -->
    <div class="modal fade" id="add-loan-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float:right">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('loans.add') }}" method="post" id="calculate-form">
          <div class="modal-body">
                @csrf
                @method('put')
                <div class="form-group">
                    <div class="form-group">
                        <label class="form-control-label" for="loan_name">Loan type name</label>
                        <input type="text" name="loan_name" id="loan_name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('loan_name') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control col-4" placeholder="{{ __('Amount') }}" value="{{ old('amount') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="interest">Interest</label>
                        <input type="number" step="0.01" min="0" name="interest" id="interest" class="form-control col-4" placeholder="{{ __('Interest') }}" value="{{ old('interest') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="terms">Terms</label>
                        <input type="text" name="terms" id="terms" class="form-control col-4" placeholder="{{ __('Terms') }}" value="{{ old('terms') }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="frequency" class="form-control-label">Frequency</label>
                        <select value="{{ old('frequency') }}" name="frequency" id="frequency" class="form-control col-5" required>
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
                            <input name="release_date" id="release_date" class="form-control col-5" placeholder="Select date" type="text" value="{{ old('release_date') }}" data-date-format="yyyy-mm-dd" required>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#release_date").datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#loans-table").DataTable({
                "pagingType": "numbers"
            });
        });
    </script>
@endpush