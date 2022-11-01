@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Employees</h1>
@stop

@section('content')
        <form action="{{ route('import.employees') }}" method="POST" enctype="multipart/form-data" class="mb-3" id="import_form">
            @csrf
            <input type="file" name="employees" id="import_employees">
            @if($errors->has('employees'))
                <br>
                <span style="color: red">{{ $errors->first('employees') }}</span>    
            @endif
        </form>
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
                                    <th></th>   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
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
                                        <td>
                                            <button type="button" class="btn btn-primary">VIew</button>
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

@section('js')
    <script>
        $('document').ready(function() {
            $('#import_employees').on('change', function(){
                $('#import_form').submit();
            })
        });
    </script>
@stop