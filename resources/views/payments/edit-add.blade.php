@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* yahya */
        .fixedBottomButton {
            position: fixed;
            bottom:50px;
            right:50px;
            padding:30px 37px;
            font-size:25px;
            border-radius:50% !important;
        }
        ul.radio li {
            width:50%;
        }
        /* end yahya */
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_title',"Payment Page")

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-wallet"></i>
        Do Payment
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form" action="{{ route('voyager.payments.store') }}" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Comment</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                        <!-- yahya - use this -->
                        <textarea class="form-control richTextBox" name="comment" id="richtextComment">
                            <?php if($payment['comment'] != null) {
                                echo $payment['comment'];
                            }
                            ?>
                        </textarea>

                        </div>
                    </div><!-- .panel -->

                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> Payment Details</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="hidden" name="emp_id"
                                    value="{{ $employee['id'] }}">
                            </div>

                            <div class="form-group">
                                <label for="slug">Employee Name</label>
                                <input readonly type="text" class="form-control" id="name" name="name"
                                    placeholder="name"
                                    value="{{ $employee['name'] }}">
                            </div>

                            <div class="form-group">
                                <label for="slug">Payment Amount</label>
                                <input readonly type="text" class="form-control" id="payment_amount" name="payment_amount"
                                    placeholder="payment Amount"
                                    value="{{ $employee['payment_amount'] }}">
                            </div>

                            <div class="form-group">
                                <label for="slug">Salary Month</label>
                                <input readonly type="text" class="form-control" id="month" name="month"
                                    placeholder="Month"
                                    value="{{ $employee['month'] }}">
                            </div>

                            <div class="form-group">
                                <label for="slug">Salary Year</label>
                                <input readonly type="text" class="form-control" id="year" name="year"
                                    placeholder="year"
                                    value="{{ $employee['year'] }}">
                            </div>

                            <div class="form-group">
                                <label for="payment_date">Payment Date</label>
                                <?php if($payment['payment_date'] == null){ ?>
                                <input type="date" id="CodeNawisdatePicker" class="form-control" name="payment_date" placeholder="Payment Date">
                                <?php }else{ ?>
                                <input type="text" readonly class="form-control" id="CodeNawisdatePickerValue" value="<?php echo $payment['payment_date']; ?>">
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="payment_date">Payment File</label>
                                <?php if($payment['file'] == null) { ?>
                                <input type="file" class="custom-file-input" name="file" placeholder="Payment File">
                                <?php }else{ ?>
                                    <br>
                                    <a href="
                                <?php 
                                    if($payment['file'] != null) {
                                        echo $payment['file']; 
                                    }
                                ?>
                                ">
                                <?php print_r(substr($payment['file'],19,48)); ?>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php if($payment['payment_date'] == null){ ?>
            <button type="submit" class="btn btn-primary fixedBottomButton save"><i class="voyager-file-text"></i></button>
            <?php } ?>
        </form>

    </div>
    <script>
        <?php if($payment['payment_date'] == null){ ?>
        document.getElementById('CodeNawisdatePicker').valueAsDate = new Date();
        <?php } ?>
    </script>
@stop
