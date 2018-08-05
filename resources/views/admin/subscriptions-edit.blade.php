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
                    <a href="{{ url('/admin/subscriptions') }}">Subscriptions</a>
                </li>
                <li class="breadcrumb-item active">Edit Subscription</li>
            </ol>
            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Subscription Details</div>
                <div class="card-body">
                    <form role="form" method="post" action="{{ url('/admin/subscriptions/' . $subscription->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputName">User</label>
                                    <select name="userId" class="form-control">
                                        <option value="0" required>Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" @if (old('userId', $subscription->user_id) == $user->id) selected @endif>{{ $user->name }} {{ $user->surname }} {{ $user->lastname }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('userId')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="inputPeriod">Period</label>
                                    <div class="input-group date" id="datetimepickerPeriod" data-target-input="nearest">
                                        <input type="text" name="period" value="{{ old('period', $subscription->period_start->format('m/Y')) }}" class="form-control datetimepicker-input" data-target="#datetimepickerPeriod" readonly required />
                                        <div class="input-group-append" data-target="#datetimepickerPeriod" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{$errors->first('period')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input name="isVip" value="on" @if (old('isVip', $subscription->is_vip) == 'on') checked @endif class="form-check-input" type="checkbox"> VIP subscription
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input name="isActive" value="on" @if (old('isActive', $subscription->is_active) == 'on') checked @endif class="form-check-input" type="checkbox"> Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <a class="btn btn-light" href="{{ url('/admin/subscriptions') }}">Cancel</a>
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