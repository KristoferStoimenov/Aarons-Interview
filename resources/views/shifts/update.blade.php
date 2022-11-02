@extends('adminlte::page')

@section('title', 'Create Shift')

@section('content_header')
    <h1>Create Shift</h1>
@stop

@section('content')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Shift</h3>
                            </div>
                            <form action="{{ route('update.shift', $shift->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="employee">Employee Name</label>
                                        <input type="text" class="form-control" name="employee" id="employee" placeholder="Enter Name" value="{{ $shift->employee }}">
                                        @error('employee')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="employer">Employer</label>
                                        <input type="text" class="form-control" name="employer" id="employer" placeholder="Employer" value="{{ $shift->employer }}">
                                        @error('employer')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="hours">Hours</label>
                                        <input type="number" class="form-control" name="hours" id="hours" placeholder="Hours" value="{{ $shift->hours }}">
                                        @error('hours')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="rate_per_hour">Rate Per Hour</label>
                                        <input type="number" class="form-control" name="rate_per_hour" id="rate_per_hour" placeholder="Rate Per Hour" value="{{ $shift->rate_per_hour }}">
                                        @error('rate_per_hour')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="taxable">Taxable</label>
                                        <input type="checkbox" class="form-control" name="taxable" id="taxable" @if($shift->taxable) checked @endif >
                                        @error('taxable')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            @foreach($statuses as $status)
                                            <option value="{{ $status }}" @if($shift->status === $status) selected @endif >{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="shift_type">Shift Type</label>
                                        <select class="form-control" name="shift_type" id="shift_type">
                                            @foreach($shiftTypes as $type)
                                                <option value="{{ $type }}" @if($shift->shift_type === $type) selected @endif>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('shift_type')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" value="{{ $shift->date }}">
                                        @error('date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="paid_at">Paid At</label>
                                        <input type="datetime-local" name="paid_at" id="paid_at" value="{{ $shift->paid_at }}">
                                        @error('paid_at')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>    
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

            setTimeout(function() {
                $('.alert').hide();
            }, 4000);
            
        });
    </script>
@stop