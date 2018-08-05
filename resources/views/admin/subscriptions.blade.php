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
            <a href="{{ url('/admin/subscriptions/add') }}" class="btn"><i class="fa fa-plus"></i> Add Subscription</a>
        </div>
        <div class="card-body">
            <div class="table-filters container">
                <div class="row">
                    <div class="col-12">
                        <label class="filtersLabel" for="filterUser">User:</label>
                        <select class="form-control" name="filterUser" id="filterUser">
                            <option value="0">Select</option>
                            @foreach($filterUsers as $filterUser)
                                <option @if($filterUserId == $filterUser->id) selected @endif value="{{ $filterUser->id }}">{{ $filterUser->name }} {{ $filterUser->surname }} {{ $filterUser->lastname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name, Surname, Last name</th>
                        <th>Period</th>
                        <th>VIP</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>{{ $subscription->user->name }} {{ $subscription->user->surname }} {{ $subscription->user->lastname }}</td>
                            <td>{{ $subscription->period_start->format('d.m.Y') }} - {{ $subscription->period_end->format('d.m.Y') }}</td>
                            <td>@if($subscription->is_vip) <i class="fa fa-check"></i> @endif</td>
                            <td>@if($subscription->is_active) <i class="fa fa-check"></i> @endif</td>
                            <td>
                                <a href="{{ url('/admin/subscriptions/' . $subscription->id . '/edit') }}"><i class="fa fa-pencil"></i></a>
                                &nbsp;|&nbsp;
                                <a class="delete-link" href="javascript:void(0);" data-url="{{ url('/admin/subscriptions/'.$subscription->id) }}" data-return-url="{{ url('/admin/subscriptions') }}"><i class="fa fa-trash"></i></a>
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