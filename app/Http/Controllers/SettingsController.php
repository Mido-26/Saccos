<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function store(Request $request){
        // dd($request);
        // dd('hello there');

        $validated = $request->validate([
            'orgName' => [],
            'location' => [],
            'email' => [],
            'phone' => [],
            'minSavings' => ['required', 'numeric', 'min:0'],
            'interestRate' => ['required', 'numeric', 'min:0', 'max:100'],
            'loanDuration' => ['required', 'integer', 'min:1'],
            'loanType' => ['required', 'string', 'in:fixed,reducing'],
            'loanMaxAmount' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'max:3'],
            'allowGuarantor' => ['sometimes', 'boolean'],
            'minGuarantor' => ['nullable', 'integer', 'min:1', 'required_if:allowGuarantor,true'],
            'maxGuarantor' => ['nullable', 'integer', 'min:1', 'required_if:allowGuarantor,true'],
            'minSavingsGuarantor' => ['nullable', 'numeric', 'min:0', 'required_if:allowGuarantor,true'],
            // user validation
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'admin_email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15|unique:users,phone_number',
            'password' => 'required|string|min:8|confirmed',
            'Date_OF_Birth' => ['required','date','before:' . now()->subYears(18)->format('Y-m-d')],
            'Address' => 'required|string',
        ]);

        try {
            // Save configuration settings in the database
            $settings = new Settings();
            $settings->organization_name = $validated['orgName'];
            $settings->organization_address = $validated['location'];
            $settings->organization_email = $validated['email'];
            $settings->organization_phone = $validated['phone'];
            $settings->min_savings = $validated['minSavings'];
            $settings->interest_rate = $validated['interestRate'];
            $settings->loan_duration = $validated['loanDuration'];
            $settings->loan_type = $validated['loanType'];
            $settings->loan_min_amount = $validated['loanMinAmount'];
            $settings->currency = $validated['currency'];

            // If guarantor is allowed, save additional fields
            if ($request->allowGuarantor) {
                $settings->allow_guarantor = true;
                $settings->min_guarantor = $validated['minGuarantor'];
                $settings->max_guarantor = $validated['maxGuarantor'];
                $settings->min_savings_guarantor = $validated['minSavingsGuarantor'];
            } else {
                $settings->allow_guarantor = false;
            }

            $settings->save();

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->admin_email,
                'phone_number' => $request->phone_number,
                'Date_OF_Birth' => $request->Date_OF_Birth,
                'Address' => $request->Address,
                'password' => Hash::make($request->password),
                'status' => 'active',
                'role' => 'admin'
            ]);

            return response()->json(['message' => 'Configuration saved successfully.'], 200);
        } catch (\Exception $e) {
            // Log error for debugging
            // Log::error('Error saving settings: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while saving the data.'], 500);
        }
    }
}
