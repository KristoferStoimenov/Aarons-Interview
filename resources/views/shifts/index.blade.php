@extends('adminlte::page')

@section('title', 'Shifts')

@section('content_header')
    <h1>Shifts</h1>
@stop

@section('content')
        <div class="row">
            <div class="col">
                <form action="{{ route('import.shifts') }}" method="POST" enctype="multipart/form-data" class="mb-3" id="import_form">
                    @csrf
                    <label for="import_shifts">Import Shifts (CSV file)</label><br>
                    <input type="file" name="shifts" id="import_shifts">
                    @if($errors->has('shifts'))
                        <br>
                        <span style="color: red">{{ $errors->first('shifts') }}</span>    
                    @endif
                </form>
            </div>
            <div class="col">
                <form action="{{ route('index.shifts') }}" method="GET" style="float: right;">
                    <label for="total_pay_filter">Minimum Total Pay</label><br>
                    <input type="number" name="total_pay_filter" value="{{ isset($_GET['total_pay_filter']) ? $_GET['total_pay_filter'] : null }}">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Shifts</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                    <a href="{{ route('create.shift') }}" type="submit" class="btn btn-primary">
                                        Create Shift
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Employer</th>
                                    <th>Hours</th>
                                    <th>Rate Per Hour</th>
                                    <th>Total Pay</th>
                                    <th>Taxable</th>
                                    <th>Status</th>
                                    <th>Shift</th>
                                    <th>Date</th>
                                    <th>Paid At</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shifts as $shift)
                                    <tr>
                                        <td>{{ $shift->employee }}</td>
                                        <td>{{ $shift->employer }}</td>
                                        <td>{{ $shift->hours }}</td>
                                        <td>{{ $shift->rate_per_hour }}</td>
                                        <td>{{ $shift->total_pay }}</td>
                                        <td>{{ $shift->taxable ? 'Yes' : 'No' }}</td>
                                        <td>{{ $shift->status }}</td>
                                        <td>{{ $shift->shift_type }}</td>
                                        <td>{{ $shift->date }}</td>
                                        <td>{{ $shift->paid_at }}</td>
                                        <td>
                                            <a href="{{ route('edit.shift', $shift->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                        <form id="deleteShift{{ $shift->id }}" action={{ route('delete.shift', $shift->id) }} method='POST'>
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="document.getElementById('deleteShift{{ $shift->id }}').submit()" class="btn btn-danger">
                                                Delete
                                            </a>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="float: right">
                            {{ $shifts->links() }}
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
            $('#import_shifts').on('change', function(){
                $('#import_form').submit();
            })
        });
    </script>
@stop