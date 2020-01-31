@extends('voyager::master')

@section('page_title', "Paid Payments page")
@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title" style="line-height:1.3;">
            <i class="voyager-person"></i> 
            <?php echo $employee[0]->name; ?>
            <br>
            <small>
                <b>Registerd at: </b>
                <?php
                    $timestamp = $employee[0]->reg_date;
                    echo date("F jS, Y", strtotime($timestamp)); 
                ?>
            </small>
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                    <div class="table-responsive">
                            <table id="dataTable" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Payment Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $paymentDates = [];
                                    foreach ($payments as $payment) {
                                        array_push($paymentDates, $payment->month . 'of' . $payment->year);
                                    }
                                    $month = (int)substr($employee[0]->reg_date, 5, 2);;
                                    $year = (int)substr($employee[0]->reg_date, 0, 4);;
                                    $cur_month = date('m');
                                    $cur_year = date('Y');
                                    
                                    $counter = 1;
                                    if($paymentDates != []){
                                        while($year <= $cur_year){
                                            ?>
                                            <tr>
                                            <?php
                                            if($year == $cur_year){
                                                    for ($i=1; $i<=$cur_month; $i++) {
                                                        if (in_array($i . 'of' .$year, $paymentDates)){
                                                            ?>
                                                                <td class="text-success">
                                                                    <?php 
                                                                    echo $i . " / " . $year . "<br>"; 
                                                                    ?>
                                                                </td>
                                                                <td><a href="" class="btn btn-success">Details</a></td>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <td><?php echo $i . " / " . $year . "<br>"; ?></td>
                                                                <td><a href="{{ route('payments.pay', ['id' => $employee[0]->id, 'month'=> $i, 'year'=>$year]) }}" class="btn btn-primary">Pay Now</a></td>
                                                            <?php
                                                        }
                                                        ?>
                                                        </tr>
                                                        <?php
                                                    }
                                            }else{
                                                if($counter==1){
                                                    $newCounter = $month;
                                                }else{
                                                    $newCounter = 1;
                                                }
                                                for ($i=$newCounter; $i<=12; $i++) {
                                                    if (in_array($i . 'of' .$year, $paymentDates)){
                                                        ?>
                                                            <td class="text-success">
                                                                <?php 
                                                                    echo $i . " / " . $year . "<br>"; 
                                                                ?>
                                                            </td>
                                                            <td><a href="" class="btn btn-success">Details</a></td>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <td><?php echo $i . " / " . $year . "<br>"; ?></td>
                                                            <td><a href="{{ route('payments.pay', ['id' => $employee[0]->id, 'month'=> $i, 'year'=>$year]) }}" class="btn btn-primary">Pay Now</a></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            $year++;
                                            $counter++;
                                        }
                                    }else{
                                        while($year <= $cur_year){
                                            ?>
                                            <tr>
                                            <?php
                                            if($year == $cur_year){
                                                    for ($i=1; $i<=$cur_month; $i++) { 
                                                        ?>
                                                            <td><?php echo $i . " / " . $year . "<br>"; ?></td>
                                                            <td><a href="{{ route('payments.pay', ['id' => $employee[0]->id, 'month'=> $i, 'year'=>$year]) }}" class="btn btn-primary">Pay Now</a></td>
                                                            </tr>
                                                        <?php
                                                    }
                                            }else{
                                                if($counter==1){
                                                    $newCounter = $month;
                                                }else{
                                                    $newCounter = 1;
                                                }
                                                for ($i=$newCounter; $i<=12; $i++) {
                                                    ?>
                                                        <td><?php echo $i . " / " . $year . "<br>"; ?></td>
                                                        <td><a href="{{ route('payments.pay', ['id' => $employee[0]->id, 'month'=> $i, 'year'=>$year]) }}" class="btn btn-primary">Pay Now</a></td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                            $year++;
                                            $counter++;
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


