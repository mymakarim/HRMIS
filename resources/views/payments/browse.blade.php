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
                                        <th>Name</th>
                                        <th>Payment Records</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td><?php echo $employee->name; ?></td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('payments.checkout', ['id' => $employee->id]) }}" >
                                                Checkout
                                            </a>
                                        </td>
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


