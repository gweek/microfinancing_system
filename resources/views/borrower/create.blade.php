@extends('layouts.app')

@section('content')
    
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-xl-12 mb-12 mb-xl-0">
                <form method="post" action="{{ route('borrower.add') }}">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @csrf
                    @method('put')
                    <div class="row mb-5">

                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h3 class="mb-0">{{ __('Personal Info') }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-control-label" for="fname">First Name</label>
                                        <input type="text" name="fname" id="fname" class="form-control col-8" placeholder="{{ __('First Name') }}" value="{{ old('fname') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="lname">Last Name</label>
                                        <input type="text" name="lname" id="lname" class="form-control col-8" placeholder="{{ __('Last Name') }}" value="{{ old('lname') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="input-mi">Middle Name</label>
                                        <input type="text" name="mi" id="input-mi" class="form-control col-8" placeholder="{{ __('Middle Name') }}" value="{{ old('mi') }}" autofocus>
                                    </div>

                                    <div class="form-group">
                                      <label for="civil_status" class="form-control-label">Civil Status</label>
                                      <select value="{{ old('civil_status') }}" name="civil_status" id="civil_status" class="form-control col-5">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Divored">Divorced</option>
                                        <option value="Other">Other</option>
                                      </select>
                                    </div>        

                                    <div class="form-group">
                                        <label class="form-control-label" for="input-age">Age</label>
                                        <input type="text" name="age" id="input-age" class="form-control col-2" placeholder="{{ __('') }}" value="{{ old('age') }}" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="birth_date">Birth Date</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="birth_date" id="birth_date" class="form-control col-5" placeholder="Select date" type="text" value="{{ old('birth_date') }}" data-date-format="yyyy-mm-dd">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h3 class="mb-0">{{ __('Contact Info') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-control-label" for="cnumber">Contact Number</label>
                                            <input type="text" name="cnumber" id="cnumber" class="form-control col-7" placeholder="{{ __('') }}" value="{{ old('cnumber') }}" autofocus required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control col-7" placeholder="{{ __('') }}" value="{{ old('email') }}" autofocus required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label" for="address">Address</label>
                                            <input type="textarea" name="address" id="address" class="form-control" placeholder="{{ __('') }}" value="{{ old('address') }}" autofocus>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h3 class="mb-0">{{ __('Current Employment Details') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-control-label" for="employment_status">Employment Status</label>
                                          <select value="{{ old('employment_status') }}" name="employment_status" id="employment_status" class="form-control col-5">
                                            <option value="Employed">Employed</option>
                                            <option value="Unemployed">Unemployed</option>
                                            <option value="Self-Employed">Self-Employed</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="company">Company</label>
                                            <input type="text" name="company" id="company" class="form-control col-7" placeholder="{{ __('') }}" value="{{ old('company') }}" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="job_title">Job Title</label>
                                            <input type="text" name="job_title" id="job_title" class="form-control col-7" placeholder="{{ __('') }}" value="{{ old('job_title') }}" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="income">Monthly Income</label>
                                            <input type="text" name="income" id="income" class="form-control col-7" placeholder="{{ __('') }}" value="{{ old('income') }}" autofocus>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="float:right">Save</button>
                </form>                       
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#birth_date").datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush