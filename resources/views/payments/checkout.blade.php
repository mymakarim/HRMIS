@extends('voyager::master')

@section('page_title', "Paid Payments page")
@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title" style="line-height:1.3;">
            <i class="voyager-person"></i> 
            <?php echo $payments[0]->name; ?>
            <br>
            <small>
                <b>Registerd at: </b>
                <?php
                    $timestamp = $payments[0]->reg_date;
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
                                    $month = (int)substr($payments[0]->reg_date, 5, 2);;
                                    $year = (int)substr($payments[0]->reg_date, 0, 4);;
                                    $cur_month = date('m');
                                    $cur_year = date('Y');
                                    
                                    $counter = 1;
                                    if($paymentDates != []){
                                        while($year <= $cur_year){
                                            ?>
                                            <tr>
                                            <?php
                                                if($year == $cur_year){
                                                    if($counter == 1){
                                                        $startPoint = $cur_month;
                                                    }else{
                                                        $startPoint = 12;
                                                    }
                                                    $endPoint = $month;
                                                }else{
                                                    if($counter == 1){
                                                        $startPoint = $cur_month;
                                                    }else{
                                                        $startPoint = 12;
                                                    }
                                                    $endPoint = 1;
                                                }
                                                for ($i=$startPoint; $i>=$endPoint; $i--) {
                                                    if (in_array($i . 'of' .$cur_year, $paymentDates)){
                                                        ?>
                                                            <td class="text-success">
                                                                <?php 
                                                                    echo $i . " / " . $cur_year . "<br>"; 
                                                                ?>
                                                            </td>
                                                            <td><a href="{{ route('payments.pay', ['id' => $payments[0]->id, 'month'=> $i, 'year'=>$cur_year]) }}" class="btn btn-success">Details</a>
                                                            </td>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <td><?php echo $i . " / " . $cur_year . "<br>"; ?></td>
                                                            <td><a href="{{ route('payments.pay', ['id' => $payments[0]->id, 'month'=> $i, 'year'=>$cur_year]) }}" class="btn btn-primary">Pay Now</a></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    </tr>
                                                    <?php
                                                }
                                            $cur_year--;
                                            $counter++;
                                        }
                                    }else{
                                        while($year <= $cur_year){
                                            ?>
                                            <tr>
                                            <?php
                                                if($year == $cur_year){
                                                    if($counter == 1){
                                                        $startPoint = $cur_month;
                                                    }else{
                                                        $startPoint = 12;
                                                    }
                                                    $endPoint = $month;
                                                }else{
                                                    if($counter == 1){
                                                        $startPoint = $cur_month;
                                                    }else{
                                                        $startPoint = 12;
                                                    }
                                                    $endPoint = 1;
                                                }
                                                for ($i=$startPoint; $i>=$endPoint; $i--) {
                                                    ?>
                                                        <td><?php echo $i . " / " . $cur_year . "<br>"; ?></td>
                                                        <td><a href="{{ route('payments.pay', ['id' => $payments[0]->id, 'month'=> $i, 'year'=>$cur_year]) }}" class="btn btn-primary">Pay Now</a></td>
                                                        </tr>
                                                    <?php
                                                }
                                            $cur_year--;
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


