@extends('layouts.app')

@section('content')
    
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-12 mb-12 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- <h3 class="mb-0">Calculator</h3> -->
                            </div>
                        </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                              <form action="{{ route('loans.add') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="borrower_id" class="form-control-label">Borrower</label>
                                    <select value="{{ old('borrower_id') }}" name="borrower_id" id="borrower_id" class="form-control" required>
                                        <option>Select</option>
                                        @foreach ($borrowers as $borrower)
                                            <option value="{{ $borrower->id }}"> {{ $borrower->fname }} {{ $borrower->lname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="loan_name">Loan name</label>
                                    <input type="text" name="loan_name" id="loan_name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('loan_name') }}" required autofocus>
                                </div>
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
                                        <input name="release_date" id="release_date" class="form-control" placeholder="Select date" type="date" value="{{ old('release_date') }}" data-date-format="yyyy-mm-dd" required>
                                    </div>
                                </div>     
                                <button type="submit" class="btn btn-sm btn-info" id="calculate">Create</button>
                              </form>
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
@endpush