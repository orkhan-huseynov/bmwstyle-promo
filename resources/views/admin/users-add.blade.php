@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/users') }}">Users</a>
                </li>
                <li class="breadcrumb-item active">Add User</li>
            </ol>
            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> User Details</div>
                <div class="card-body">
                    <form role="form" method="post" action="{{ url('/admin/users/') }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('POST') }}
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputName">Name</label>
                                    <input type="text" name="name" class="form-control" id="inputName" minlength="3" required value="{{ old('name') }}" />
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSurname">Surname</label>
                                    <input type="text" name="surname" class="form-control" id="inputSurname" minlength="3" required value="{{ old('surname') }}" />
                                    <span class="text-danger">{{$errors->first('surname')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputName">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" id="inputLastname" minlength="3" required value="{{ old('lastname') }}" />
                                    <span class="text-danger">{{$errors->first('lastname')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputPhone">Phone</label>
                                    <input type="text" name="phone" class="form-control maskedPhone" id="inputPhone" minlength="17" maxlength="17" required value="{{ old('phone') }}" />
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputFin">FIN</label>
                                    <input type="text" name="fin" class="form-control" id="inputFin" minlength="7" maxlength="7" value="{{ old('fin') }}" />
                                    <span class="text-danger">{{$errors->first('fin')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputPhoto">Photo</label>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="file" name="photo" class="form-control" id="inputPhoto" />
                                        </div>
                                    </div>

                                    <span class="text-danger">{{$errors->first('photo')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label class="control-label" for="inputEmail">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail" minlength="3" required value="{{ old('email') }}" />
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputDateOfBirth">Date of birth</label>
                                    <div class="input-group date" id="datetimepickerDateOfBirth" data-target-input="nearest">
                                        <input type="text" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control datetimepicker-input" data-target="#datetimepickerDateOfBirth"/>
                                        <div class="input-group-append" data-target="#datetimepickerDateOfBirth" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
                                </div>
                            </div>
                        </div>
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12 col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label" for="inputPassword">Password</label>--}}
                                    {{--<input type="password" name="password" class="form-control" id="inputPassword" />--}}
                                    {{--<span class="text-danger">{{$errors->first('password')}}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-12 col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="control-label" for="inputPasswordConfirmation">Confirm password</label>--}}
                                    {{--<input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" />--}}
                                    {{--<span class="text-danger">{{$errors->first('password_confirmation')}}</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputCarModel">Car model</label>
                                    <input type="text" name="car_model" class="form-control" id="inputCarModel" minlength="3" required value="{{ old('car_model') }}" />
                                    <span class="text-danger">{{$errors->first('car_model')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputCarNumber">Car number</label>
                                    <input type="text" name="car_lic_number" class="form-control maskedCarNumber" id="inputCarNumber" minlength="9" maxlength="9" required value="{{ old('car_lic_number') }}" />
                                    <span class="text-danger">{{$errors->first('car_lic_number')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputCarVin">Car VIN</label>
                                    <input type="text" name="car_vin" class="form-control" id="inputCarVin" minlength="7" maxlength="7" required value="{{ old('car_vin') }}" />
                                    <span class="text-danger">{{$errors->first('car_vin')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputCardNumber">Card Number</label>
                                    <input type="text" name="card_number" class="form-control" id="inputCardNumber" minlength="1" maxlength="10" required value="{{ old('card_number') }}" />
                                    <span class="text-danger">{{$errors->first('card_number')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <a class="btn btn-light" href="{{ url('/admin/users') }}">Cancel</a>
                                <input type="submit" class="btn btn-success" value="Save" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer small text-muted"></div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright © BMW Club Azerbaijan {{ date('Y') }}</small>
                </div>
            </div>
        </footer>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
@endsection