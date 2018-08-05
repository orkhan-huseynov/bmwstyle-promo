@extends('layouts.app')

@section('content')

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('/admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
            <a href="{{ url('/admin/users/add') }}" class="btn"><i class="fa fa-plus"></i> Add User</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name, Surname, Last name</th>
                        <th>Card number</th>
                        <th>Phone</th>
                        <th>Car Model</th>
                        <th>Car Number</th>
                        <th>VIN</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }} {{ $user->surname }} {{$user->lastname}}</td>
                            <td>{{ $user->card_number }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->car_model }}</td>
                            <td>{{ $user->car_lic_number }}</td>
                            <td>{{ $user->car_vin }}</td>
                            <td>
                                <a href="{{ url('/admin/users/' . $user->id . '/edit') }}"><i class="fa fa-pencil"></i></a>&nbsp;<a class="delete-link" href="javascript:void(0);" data-url="{{ url('/admin/users/'.$user->id) }}" data-return-url="{{ url('/admin/users') }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated at {{ $lastUpdate }}</div>
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