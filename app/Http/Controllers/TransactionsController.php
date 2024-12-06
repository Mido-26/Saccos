<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Savings;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTransactionsRequest;
use App\Http\Requests\UpdateTransactionsRequest;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $role = session('role');
    $query = Transactions::query();
    if ($role == 'admin' || $role == 'staff'){
        
    }else{
        $id = Auth::user()->id;
        $query->where('user_id', '=', $id);
    }
    // $query = Transactions::query();


    // Paginate and get filtered results
    $transactions = $query->orderBy('id', 'desc')->paginate(10);
    // dd($transactions);
    $total = 0;
        foreach ($transactions as $transaction) {
            $total = $total + $transaction->amount;
        }
    // Pass the request inputs to the view to retain selected filters
    return view('transactions.index', compact('transactions', 'total'))->withInput($request->all());
}


    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('unauthorized');
        }

        // Retrieve all user IDs
        $ids = User::pluck('id')->toArray();

        // Retrieve users with only first_name, last_name, and id, including their savings
        $users = User::select('id', 'first_name', 'last_name')->with('savings')->get();

        return view('transactions.create', compact('users', 'ids'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('unauthorized');
        }

        // dd($request->all());
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'amount' => 'required|numeric|min:20000',
            'description' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);
    

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Fetch the savings account
            $user = User::findOrFail($request->user_id);
            // dd($user);
            $savingsAccount = $user->savings;
            //  dd($savingsAccount);
            // $userId = $->user_id;
            // Handle the transaction balance update based on the type (Deposit/Withdrawal)
            if ($request->type == 'Deposit') {
                $savingsAccount->account_balance += $request->amount;  // Increase balance on deposit
                $savingsAccount->last_deposit_date = now();
            } elseif ($request->type == 'Withdrawal') {
                if ($savingsAccount->account_balance >= $request->amount) {
                    $savingsAccount->account_balance -= $request->amount;  // Decrease balance on withdrawal
                    $savingsAccount->last_deposit_date = now();
                } else {
                    return redirect()->back()->withErrors(['error' => 'Insufficient balance for withdrawal.']);
                }
            }

            // Save the updated savings account balance
            $savingsAccount->save();

            // Create the transaction with polymorphic relationship
            $transaction = Transactions::create([
                'user_id' => $validated['user_id'],
                'type' => $validated['type'],
                'amount' => $validated['amount'],
                'description' => $validated['description'] ?? null,
                'transaction_reference' => Transactions::generateTransactionReference(), // Generate unique reference
                'payment_method' => $validated['payment_method'],
                'currency' => 'TZS',
                'initiator_id' => Auth::id(), // Logged-in user
                'completed_at' => now(),
            ]);

            // Commit the transaction
            DB::commit();

            // Redirect to the transactions index with a success message
            return redirect()->route('transactions.index')->with('success', 'Transaction added successfully and balance updated.');
        } catch (\Exception $e) {
            // Rollback in case of any error
            DB::rollBack();

            // Redirect with error message
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function show(Transactions $transaction)
{
    // Check if the user is not an admin or doesn't own the transaction
    if (Auth::user()->role !== 'admin' && $transaction->user_id !== Auth::id()) {
        return redirect()->route('unauthorized');
    }

    // Return the transaction details view
    return view('transactions.show', compact('transaction'));
}


    public function edit(Transactions $transaction){
        $users = User::select('id', 'first_name', 'last_name')->with('savings')->get();
        return view('transactions.edit', compact('users', 'transaction'));
    }


    public function update(Request $request, $id)
{
    if (Auth::user()->role !== 'admin') {
        return redirect()->route('unauthorized');
    }
    // dd($request->all());
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'type' => 'required|string',
        'amount' => 'required|numeric|min:20000',
        'description' => 'nullable|string',
        'payment_method' => 'required|string',
    ]);

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Fetch the existing transaction and associated savings account
        $transaction = Transactions::findOrFail($id);
        // $savingsAccount = Savings::findOrFail($validated['user_id']);
        $userId = $request->user_id;
        $savingsAccount = $transaction->user->savings;
        // dd($savingsAccount);
        // Reverse the previous transaction impact on the account balance
        if ($transaction->type == 'Deposit') {
            $savingsAccount->account_balance -= $transaction->amount;
        } elseif ($transaction->type == 'Withdrawal') {
            $savingsAccount->account_balance += $transaction->amount;
        }

        // Update balance based on new transaction type and amount
        if ($request->type == 'Deposit') {
            $savingsAccount->account_balance += $request->amount;
            $savingsAccount->last_deposit_date = now();
        } elseif ($request->type == 'Withdrawal') {
            if ($savingsAccount->account_balance >= $request->amount) {
                $savingsAccount->account_balance -= $request->amount;
            } else {
                return redirect()->back()->withErrors(['error' => 'Insufficient balance for withdrawal.']);
            }
        }

        // Save the updated savings account balance
        $savingsAccount->save();

        // Update transaction details
        $transaction->update([
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->type,
            'user_id' => $userId,
            'payment_method' => $validated['payment_method'],
        ]);

        // Commit the transaction
        DB::commit();

        // Redirect to transactions index with a success message
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully and balance adjusted.');
    } catch (\Exception $e) {
        // Rollback in case of any error
        DB::rollBack();

        // Redirect with error message
        return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
    }
}
}
