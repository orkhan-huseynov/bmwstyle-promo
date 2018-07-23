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
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> User Details</div>
                <div class="card-body">
                    <form role="form" method="post" action="{{ url('/admin/users/' . $user->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputName">Name</label>
                                    <input type="text" name="name" class="form-control" id="inputName" minlength="3" required value="{{ old('name', $user->name) }}" />
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputSurname">Surname</label>
                                    <input type="text" name="surname" class="form-control" id="inputSurname" minlength="3" required value="{{ old('surname', $user->surname) }}" />
                                    <span class="text-danger">{{$errors->first('surname')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputName">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" id="inputLastname" minlength="3" required value="{{ old('lastname', $user->lastname) }}" />
                                    <span class="text-danger">{{$errors->first('lastname')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputPhone">Phone</label>
                                    <input type="text" name="phone" class="form-control maskedPhone" id="inputPhone" minlength="17" maxlength="17" required value="{{ old('phone', $user->phone) }}" />
                                    <span class="text-danger">{{$errors->first('phone')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputFin">FIN</label>
                                    <input type="text" name="fin" class="form-control" id="inputFin" minlength="7" maxlength="7" value="{{ old('fin', $user->fin) }}" />
                                    <span class="text-danger">{{$errors->first('fin')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputPhoto">Photo</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="file" name="photo" class="form-control" id="inputPhoto" />
                                        </div>
                                        <div class="col-2">
                                            @if ($user->photo != null)
                                                <img src="{{ url('/storage/images' . $user->photo) }}" width="70" height="100" />
                                            @endif
                                        </div>
                                    </div>

                                    <span class="text-danger">{{$errors->first('photo')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputDateOfBirth">Date of birth</label>
                                    <div class="input-group date" id="datetimepickerDateOfBirth" data-target-input="nearest">
                                        <input type="text" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth->format('d.m.Y')) }}" class="form-control datetimepicker-input" data-target="#datetimepickerDateOfBirth"/>
                                        <div class="input-group-append" data-target="#datetimepickerDateOfBirth" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputPassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="inputPassword" />
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputPasswordConfirmation">Confirm password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" />
                                    <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputCarModel">Car model</label>
                                    <input type="text" name="car_model" class="form-control" id="inputCarModel" minlength="3" required value="{{ old('car_model', $user->car_model) }}" />
                                    <span class="text-danger">{{$errors->first('car_model')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputCarNumber">Car number</label>
                                    <input type="text" name="car_lic_number" class="form-control maskedCarNumber" id="inputCarNumber" minlength="9" maxlength="9" required value="{{ old('car_lic_number', $user->car_lic_number) }}" />
                                    <span class="text-danger">{{$errors->first('car_lic_number')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="inputCarNumber">Car VIN</label>
                                    <input type="text" name="car_vin" class="form-control" id="inputCarVin" minlength="7" maxlength="7" required value="{{ old('car_vin', $user->car_vin) }}" />
                                    <span class="text-danger">{{$errors->first('car_vin')}}</span>
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
                <div class="card-footer small text-muted">Updated at {{ $user->updated_at->format('d.m.Y h:i') }}</div>
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

        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection