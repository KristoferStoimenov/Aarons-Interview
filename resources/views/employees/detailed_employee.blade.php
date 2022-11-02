@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Employee Info</h1>
@stop

@section('content')
    <div class="col-md-12">
        <div class="card card-widget widget-user">
            <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{ $employeeInfo->employee }}</h3>
                <h5 class="widget-user-desc">Employee</h5>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ $employeeInfo->average_rate_per_hour }}</h5>
                            <span class="description-text">AVG Rate per Hour</span>
                        </div>
                    </div>
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ $employeeInfo->average_total_pay }}</h5>
                            <span class="description-text">AVG Total Pay</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Last 5 Completed Payments</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee</th>
                                <th>Employer</th>
                                <th>Hours</th>
                                <th>Rate Per Hour</th>
                                <th>Taxable</th>
                                <th>Status</th>
                                <th>Shift</th>
                                <th>Date</th>
                                <th>Paid At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lastCompletedPayments as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->employee }}</td>
                                    <td>{{ $employee->employer }}</td>
                                    <td>{{ $employee->hours }}</td>
                                    <td>{{ $employee->rate_per_hour }}</td>
                                    <td>{{ $employee->taxable ? 'Yes' : 'No' }}</td>
                                    <td>{{ $employee->status }}</td>
                                    <td>{{ $employee->shift_type }}</td>
                                    <td>{{ $employee->date }}</td>
                                    <td>{{ $employee->paid_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop