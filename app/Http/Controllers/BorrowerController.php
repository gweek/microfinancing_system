<?php

namespace App\Http\Controllers;

use App\Borrower;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $borrowers = Borrower::all();

        return view('borrower.index', compact('borrowers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('borrower.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Borrower $borrower)
    {
        //
        $data = $request->validate([
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'mi'    => 'max:25',
            'civil_status' => 'nullable|in:Married,Widowed,Separated,Divorced,Single,Other',
            'age' => 'max:3',
            'cnumber' => 'required|max:25',
            'email' => 'required|email:rfc,dns',
            'address' => 'max:255',
            'employment_status' => 'in:Employed,Unemployed,Self-Employed',
            'birth_date' => 'date',
            'company' => 'max:100',
            'job_title' => 'max:50',
        ]);

        $borrower->create($data);
        return redirect()->route('borrower.index')->withStatus(__('Borrower successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function show(Borrower $borrower)
    {
        //

        return view('borrower.view', compact('borrower'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrower $borrower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrower $borrower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function delete(Borrower $borrower)
    {
        //
        $borrower->delete();

        return redirect('/borrower');
    }
}
