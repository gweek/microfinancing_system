<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $payments  = Payment::all();

        $upcoming_payments = \App\PaymentSchedule::where('status', 'UNPAID')->orderBy('payment_sched', 'asc')->get();

        return view('payment.index', compact('payments', 'upcoming_payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, \App\PaymentSchedule $sched)
    {

        // dd($sched->loan->loanSetting->payment_made_total);

        $data = $request->validate([
            'amount' => 'required|integer',
            'date_processed' => 'required|date', 
        ]);



        $payment = new Payment();
        $payment->amount = $data['amount'];
        $payment->date_processed = $data['date_processed'];
        $payment->payment_sched_id = $sched->id;
        $payment->loan_id = $sched->loan_id;

        $sched->status = 'PAID';
        $sched->paid_date = $data['date_processed'];
        $sched->amount_paid = $data['amount'];
        $payment_made_total = $sched->loan->loanSetting->payment_made_total;

        if( $payment->save() ){
            
            $save_schedule = $sched->update();

            if($save_schedule){

                    $match = ['loan_id' => $sched->loan_id, 'status' => 'UNPAID'];
                    $active_schedule = \App\PaymentSchedule::where($match)->first();
                    $sched->loan->loanSetting->payment_made_total = $payment_made_total + $data['amount'];

                    if($active_schedule){
                        $sched->loan->loanSetting->next_payment_id = $active_schedule->payment_number;
                    } else {
                        $sched->loan->loanSetting->status = true;
                    }

                    $sched->loan->loanSetting->update();

            }

        }

        return redirect('/loans');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
