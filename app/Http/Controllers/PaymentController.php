<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use DateTime;

class PaymentController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function index(\Illuminate\Http\Request $request)
    {
                $groupedEmployees = DB::table('employees')
                     ->select(DB::raw('employees.id, payments.emp_id, payments.payment_date, employees.category, employees.salary, employees.salary_day, employees.name, absenses.month, absenses.year, count(absenses.day) as total_absence'))
                     ->leftJoin('absenses', 'employees.id', '=', 'absenses.emp_id')
                     ->leftJoin('payments', 'employees.id', '=', 'payments.emp_id')
                    //  ->where('payments.payment_date', "=", NULL)
                    //  ->where('absenses.month', "=", Date('m'))
                    //  ->where('absenses.year', "=", Date('Y'))
                     ->groupBy('absenses.emp_id')
                     ->groupBy('absenses.month')
                    //  ->where('absenses.emp_id', "=", NULL)
                     ->get();

                    //  print_r($absentEmployees);
                    //  die();
                    
                // $notPaidEmployees = DB::table('employees')
                //             ->select(DB::raw('employees.id, payments.emp_id, employees.salary, employees.name'))
                //             ->leftJoin('payments', 'employees.id', '=', 'payments.emp_id')
                //             ->where('payments.payment_date', "=", NULL)
                //             ->get();
                //             print_r($notPaidEmployees);
                            
                // $notAbsentEmployees = DB::table('employees')
                //             ->select(DB::raw('employees.id, absenses.emp_id, employees.salary, employees.name'))
                //             ->leftJoin('absenses', 'employees.id', '=', 'absenses.emp_id')
                //             ->where('absenses.emp_id', "=", NULL)
                //             ->get();
                //             print_r($notAbsentEmployees);
                //             die();
                
                // $notAbsentEmployees = DB::table('employees')
                //      ->select(DB::raw('employees.id, employees.name, absenses.emp_id'))
                //      ->rightJoin('absenses', 'employees.id', '=', 'absenses.emp_id')
                //      ->whereRaw("NOT (employees.id = absenses.emp_id)")
                //      ->get();
                //     print_r($notAbsentEmployees);
                //     die();
                    //  select * from employees 
                    //  left join absenses on employees.id = absenses.emp_id 
                    //  left join payments on employees.id = payments.emp_id
                    //  group by absenses.emp_id 
                    //  where absenses.year = current year
                    //  where absenses.month = current month
                    //  where payment date = null

                     return view('payments.browse')->withEmployees($groupedEmployees);
    }
    
    public function pay($id, $name, $category, $month, $year, $payment_amount){
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

}
