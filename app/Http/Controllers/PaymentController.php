<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use DateTime;
use TCG\Voyager\Facades\Voyager;

class PaymentController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function index(\Illuminate\Http\Request $request)
    {
                $employees = DB::table('employees')
                     ->select(DB::raw('employees.id, employees.name'))
                     ->get();

                return view('payments.browse')->withEmployees($employees);
    }
    
    public function pay($id, $month, $year){
        $employee = DB::table('employees')
            ->select(DB::raw('employees.id, employees.category, employees.salary, employees.salary_day, employees.name, absenses.month, absenses.year, count(absenses.day) as total_absence'))
            ->join('absenses', 'employees.id', '=', 'absenses.emp_id')
            ->where('absenses.month', "=", $month)
            ->where('absenses.year', "=", $year)
            ->where('employees.id', "=", $id)
            ->get();

        $payment = DB::table('payments')
            ->select(DB::raw('comment, payment_date, file, id, emp_id, month, year'))
            ->where('emp_id', "=", $id)
            ->where('month', "=", $month)
            ->where('year', "=", $year)
            ->get();

        $category = $employee[0]->category;
        $name = $employee[0]->name;
        $payment_amount = (($employee[0]->salary) - ($employee[0]->total_absence * $employee[0]->salary_day));
        
        $employee = array(
            "id"=>$id,
            "name"=>$name,
            "category"=>$category,
            "month"=>$month,
            "year"=>$year,
            "payment_amount"=>$payment_amount,
        );
        if(count($payment) > 0) {
            $payment = array(
                "comment"=>$payment[0]->comment,
                "payment_date"=>$payment[0]->payment_date,
                "file"=>$payment[0]->file,
            );
        }else{
            $payment = null;
        }
        return view('payments.edit-add')->withEmployee($employee)->withPayment($payment);
    }

    public function checkout($id){
        $payments = DB::table('employees')
            ->select(DB::raw('employees.id, payments.emp_id, payments.payment_date, payments.month, payments.year, employees.name, employees.reg_date'))
            ->leftJoin('payments', 'employees.id', '=', 'payments.emp_id')
            ->where('employees.id', "=", $id)
            ->where('payments.payment_date', "!=", null)
            ->where('employees.id', "=", $id)
            ->get();

        return view('payments.checkout')->withPayments($payments);
    }
    public function store(\Illuminate\Http\Request $request){
        $slug = $this->getSlug($request);
        $file = $request->file('file');

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        print_r($file);
        
        die();
    }
}
