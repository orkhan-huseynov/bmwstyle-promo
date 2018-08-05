@extends('layouts.app')

@section('content')

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('/admin') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Subscriptions</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
            <a href="{{ url('/admin/subscriptions/add') }}" class="btn"><i class="fa fa-remove"></i> Error</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <h4>{{ $errorTitle }}</h4>
              <p>{{ $errorMessage }}</p>
              <p></p>
              <a class="btn btn-info" href="{{ url('/admin/subscriptions') }}">Return to subscriptions list</a>
          </div>
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