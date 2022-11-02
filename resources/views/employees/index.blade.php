@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Employees</h1>
@stop

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employees</h3>
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
                                    <th>Employee</th>
                                    <th></th>   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->employee }}</td>
                                        <td>
                                            <a href="{{ route('detail.employee', $employee->employee) }}" type="button" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="float: right">
                            {{ $employees->links() }}
                        </div>
                    </div> 
                </div>
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop