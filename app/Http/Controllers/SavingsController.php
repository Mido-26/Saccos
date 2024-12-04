<?php

namespace App\Http\Controllers;

use App\Models\Savings;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSavingsRequest;
use App\Http\Requests\UpdateSavingsRequest;

class SavingsController extends Controller
{
    public function index()
    {
        // Retrieve all savings
        $savings = Savings::with(['user'])->paginate(15);
        // dd($savings);
        return view('savings.index', compact('savings'));
    }

    public function create()
    {
        // Show the form to create a new saving
        return view('savings.create');
    }

    public function store(Request $request)
    {
        // Handle saving a new saving
        $validated = $request->validate([
            'account_balance' => 'required|numeric',
            'interest_earned' => 'required|numeric',
        ]);

        Savings::create($validated);

        return redirect()->route('savings.index');
    }

    public function show(Savings $saving)
    {
        // Show the details of a saving
        return view('savings.show', compact('saving'));
    }

    public function edit(Savings $saving)
    {
        // Show the form to edit a saving
        return view('savings.edit', compact('saving'));
    }

    public function update(Request $request, Savings $saving)
    {
        // Handle updating a saving
        $validated = $request->validate([
            'account_balance' => 'required|numeric',
            'interest_earned' => 'required|numeric',
        ]);

        $saving->update($validated);

        return redirect()->route('savings.index');
    }

    public function destroy(Savings $saving)
    {
        // Handle deleting a saving
        $saving->delete();

        return redirect()->route('savings.index');
    }
}
