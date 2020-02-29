<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PaymentSchedule;
use App\Borrower;
class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //
        $borrowers = Borrower::all();
        return view('loans.create', compact('borrowers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Loan $loan)
    {
        //
        $data = $request->validate([
            'borrower_id' => 'required',
            'loan_name' => 'required|max:100|string',
            'interest' => 'required|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'terms' => 'required|string|max:25',
            'frequency' => 'required|in:Monthly,2 Weeks,Weekly',
            'amount' => 'required|integer',
            'release_date' => 'date'
        ]);

        $newLoan = $loan->create($data);

        $divisor = '';
        $days = '';
        switch ($data['frequency']) {
            case 'Monthly':
                $divisor = 1;
                $days = 30;
                break;
            case '2 Weeks':
                $divisor = 2;
                $days = 15;
                break;
            case 'Weekly':
                $divisor = 4;
                $days = 7;
                break;
        }
        
        //interest
        $amount_interest = $data['amount'] * ($data['interest']/100)/$divisor;
        
        //total payments applying interest
        $amount_total = $data['amount'] + $amount_interest * $data['terms'] * $divisor;
        
        //payment per term
        $amount_term = number_format(round($data['amount'] / ($data['terms'] * $divisor), 2) + $amount_interest, 2, '.', ',');
        
        $monthly_interest = $amount_interest*$divisor;


        function tofloat($num) {
            $dotPos = strrpos($num, '.');
            $commaPos = strrpos($num, ',');
            $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
                ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
          
            if (!$sep) {
                return floatval(preg_replace("/[^0-9]/", "", $num));
            }

            return floatval(
                preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
                preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
            );
        }

        $newLoan->loanSetting()->create([
            'release_date' => $data['release_date'],
            'loan_amount' => $data['amount'],
            'loan_interest_month' => $monthly_interest,
            'loan_interest_term' => $amount_interest,
            'loan_interest_total' => tofloat($amount_term),
            'gran_total' => tofloat($amount_total),
            'next_payment_id' => 1
        ]);

        $date = $data['release_date'];

        $now = Carbon::now('utc')->toDateTimeString();
        $payment_dates = array();
        for ($i = 1; $i <= $data['terms'] * $divisor; $i++)
        {
            $frequency = $days * $i;
            $newdate = strtotime ('+'.$frequency.' day', strtotime($date)) ;
            //check if payment date landed on weekend
            //if Sunday, make it Monday. If Saturday, make it Friday
            if(date('D', $newdate) == 'Sun') {
                $newdate = strtotime('+1 day', $newdate) ;
            } elseif(date ('D' , $newdate) == 'Sat') {
                $newdate = strtotime('-1 day', $newdate) ;
            }
            
            $newdate = date('m/d/Y', $newdate);
            // $table = $table . '<tr><td>'.$i.'</td><td>'.$amount_term.'</td><td>'.$newdate.'</td></tr>';
            $payment_dates[] = array('payment_number' => $i, 'amount' => tofloat($amount_term), 'payment_sched' => date('y-m-d', strtotime($newdate)), 'created_at' => $now, 'updated_at' => $now, 'loan_id' => $newLoan->id);
        }

        $newLoan->paymentSchedule()->insert($payment_dates);

        return redirect()->route('loans.index')->withStatus(__('Loan created.'));

    }

    public function calculator(){
        return view('loans.calculator');
    }


    public function calculate(Request $request)
    {

        $data = $request->validate([
            // 'loan_name' => 'required|max:100|string',
            'interest' => 'required|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'terms' => 'required|string|max:25',
            'frequency' => 'required|in:Monthly,2 Weeks,Weekly',
            'amount' => 'required|max:25',
            'release_date' => 'date'
        ]);

        $divisor = '';
        $days = '';
        switch ($data['frequency']) {
            case 'Monthly':
                $divisor = 1;
                $days = 30;
                break;
            case '2 Weeks':
                $divisor = 2;
                $days = 15;
                break;
            case 'Weekly':
                $divisor = 4;
                $days = 7;
                break;
        }
        
        //interest
        $amount_interest = $data['amount'] * ($data['interest']/100)/$divisor;
        
        //total payments applying interest
        $amount_total = $data['amount'] + $amount_interest * $data['terms'] * $divisor;
        
        //payment per term
        $amount_term = number_format(round($data['amount'] / ($data['terms'] * $divisor), 2) + $amount_interest, 2, '.', ',');
        
        $monthly_interest = $amount_interest*$divisor;

        $date = $data['release_date'];

        $payment_dates = array();
        for ($i = 1; $i <= $data['terms'] * $divisor; $i++)
        {
            $frequency = $days * $i;
            $newdate = strtotime ('+'.$frequency.' day', strtotime($date)) ;
            //check if payment date landed on weekend
            //if Sunday, make it Monday. If Saturday, make it Friday
            if(date('D', $newdate) == 'Sun') {
                $newdate = strtotime('+1 day', $newdate) ;
            } elseif(date ('D' , $newdate) == 'Sat') {
                $newdate = strtotime('-1 day', $newdate) ;
            }
            
            $newdate = date('m/d/Y', $newdate);
            // $table = $table . '<tr><td>'.$i.'</td><td>'.$amount_term.'</td><td>'.$newdate.'</td></tr>';
            $payment_dates[] = array('id' => $i, 'amount' => $amount_term, 'date' => $newdate);
        }


        $output = array('interest' => $amount_interest, 'total' => $amount_total, 'amount_term' => $amount_term, 'dates' => $payment_dates, 'monthly_interest' => $monthly_interest);

        return response()->json($output);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
        return view('loans.view', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
        $loan->delete();

        return redirect('/loans');
    }
}
