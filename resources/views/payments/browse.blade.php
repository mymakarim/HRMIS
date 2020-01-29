@extends('voyager::master')

@section('page_title', "Payments page")

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-person"></i> Payments
        </h1>
    </div>
@stop
<?php 
    function calc_payment($total_salary, $absense_days, $salary_day){
        $today = Date('d');
        return(($salary_day * $today) - ($salary_day * $absense_days));
    }
?>
@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                    <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Name</th>
                                        <th>Job Category</th>
                                        <th>Absenses</th>
                                        <th>Payment Amount</th>
                                        <th>Pay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td><b>{{ ($employee->month != '')? $employee->month . " / " . $employee->year : Date('m/Y')  }}</b></td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->category }}</td>
                                        <td>{{ $employee->total_absence }}</td>
                                        <td><?php echo $payment_amount = calc_payment($employee->salary, $employee->total_absence, $employee->salary_day); ?></td>
                                        <td><a href="{{ route('payments.create', ['id' => $employee->id, 'name' => $employee->name, 'category' => $employee->category, 'month' => $employee->month, 'year' => $employee->year, 'payment_amount' => $payment_amount]) }}" >
                                            @if($employee->payment_date != '')
                                                <i class="voyager-wallet text-success"></i>
                                            @else
                                                <i class="voyager-wallet text-secondary"></i>
                                            @endif
                                        </a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


