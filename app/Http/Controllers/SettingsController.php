<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function store(Request $request){
        // dd($request);
        // dd('hello there');
        // $request['allowGuarantor'] = filter_var($request['allowGuarantor'], FILTER_VALIDATE_BOOLEAN);
        $request['allowGuarantor'] = $request['allowGuarantor'] ? true : false;
        $validated = $request->validate([
            'orgName' => ['required'],
            'location' => ['required'],
            'email' => ['required','email'],
            'phone' => ['required'],
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
            
            $settings = Settings::create([
                'organization_name' => $validated['orgName'],
                'organization_address' => $validated['location'],
                'organization_email' => $validated['email'],
                'organization_phone' => $validated['phone'],
                'min_savings' => $validated['minSavings'],
                'interest_rate' => $validated['interestRate'],
                'loan_duration' => $validated['loanDuration'],
                'loan_type' => $validated['loanType'],
                'loan_max_amount' => $validated['loanMaxAmount'],
                'currency' => $validated['currency'],
                'allow_guarantor' => $validated['allowGuarantor'],
                'min_guarantor' => $validated['minGuarantor'],
                'max_guarantor' => $validated['maxGuarantor'],
                'min_savings_guarantor' => $validated['minSavingsGuarantor']
            ]);
            
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

            // echo '8';
            // sending verification email to the user 
            $user->sendEmailVerificationNotification();
            // echo '9';
            // $user->notify(new WelcomeNotification());
            Auth::login($user);
            return response()->json(['message' => 'Configuration saved successfully.', 'status' => 'success'], status: 200);
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Error saving settings: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while saving the data.', 'status' => 'success'], 500);
        }
    }
}
