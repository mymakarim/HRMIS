<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use DateTime;

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
        $category = $employee[0]->category;
        $name = $employee[0]->name;
        $payment_amount = (($employee[0]->salary) - ($employee[0]->total_absence * $employee[0]->salary_day));
        
        $employee = array(
            "id"=>$id,
            "name"=>$name,
            "category"=>$category,
            "month"=>$month,
            "year"=>$year,
            "payemnt_amount"=>$payment_amount,
        );
        return view('payments.edit-add')->withEmployee($employee);
    }

    public function checkout($id){
        $payments = DB::table('employees')
            ->select(DB::raw('employees.id, payments.emp_id, payments.payment_date, payments.month, payments.year'))
            ->leftJoin('payments', 'employees.id', '=', 'payments.emp_id')
            ->where('employees.id', "=", $id)
            ->where('payments.payment_date', "!=", null)
            ->get();

        $employee = DB::table('employees')
            ->select(DB::raw('employees.id, employees.name, employees.reg_date'))
            ->where('employees.id', "=", $id)
            ->get();

          return view('payments.checkout')->withPayments($payments)->withEmployee($employee);
    }

}
