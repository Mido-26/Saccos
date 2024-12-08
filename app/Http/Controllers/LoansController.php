<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Loans;
use App\Models\Referee;
use App\Models\Savings;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreLoansRequest;
use App\Http\Requests\UpdateLoansRequest;
use App\Notifications\RefereeNotification;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loans::paginate(15);
        return view('loans.index',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $settin = Settings::first();
        $minSavings = $settin->min_savings_guarantor;
        $maxLoans = $settin->max_guarantor;
        $no = true;
        // get all savings account that have savings > $minSavings
        $savings = Savings::with('user')
                ->where('account_balance', '>=', $minSavings)
                ->get();

        if ($savings->isEmpty()) {
            $referee = ['referee' => 'No referee contact your admin'];
            $no = null;
            return view('loans.create',compact('referee', 'no'));
        }        
        // Loop through savings to access user data.
        // foreach ($savings as $saving) {
        //     $referee = $saving->user; // Access the user directly via the relationship.
        //     // Do something with $user and $saving.
        // }
        $referee = $savings;
        return view('loans.create',compact('referee', 'no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'loanAmount' => 'required|numeric|min:1|max:1000000',
        'loanDuration' => 'required|integer|min:1|max:60',
        'interestRate' => 'required|numeric|min:0|max:100',
        'principalAmount' => 'required|numeric|min:0',
        'monthlyPayments' => 'required|numeric|min:0',
        'description' => 'required|string|max:255',
        'referee_0' => 'required|exists:users,id',
        'referee_1' => 'required|exists:users,id',
        'referee_2' => 'required|exists:users,id',
    ]);

    $loan = Loans::create([
        'loan_amount' => $validated['loanAmount'],
        'loan_duration' => $validated['loanDuration'],
        'interest_rate' => $validated['interestRate'],
        'principal_amount' => $validated['principalAmount'],
        'monthly_payments' => $validated['monthlyPayments'],
        'description' => $validated['description'],
        'user_id' => Auth::id(),
    ]);

    foreach (['referee_0', 'referee_1', 'referee_2'] as $refereeKey) {
        Referee::create([
            'loan_id' => $loan->id,
            'user_id' => $validated[$refereeKey],
        ]);

        $referee = User::find($validated[$refereeKey]);
        $referee->notify(new RefereeNotification($loan, $referee->name));
    }

    return redirect()->route('loans.index')->with('success', 'Loan created and referees notified successfully!');
}



    /**
     * Display the specified resource.
     */
    public function show(Loans $loans)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loans $loans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoansRequest $request, Loans $loans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loans $loans)
    {
        //
    }
}
