<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function registerStaff(Request $request)
    {
        // ✅ Validate request
        $request->validate([
            'supabase_id' => 'required|string|unique:users,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'string',
            'username' => 'required|string',
            'profile' => 'nullable|image|max:2048',
        ]);

        // ✅ Handle optional profile upload
        $path = null;
        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store("profiles/{$request->id}", 'public');
        }

        // ✅ Save user
        Staff::create([
            'supabase_id' => $request->input('supabase_id'),
            'name' => $request -> input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'username' => $request->input('username'),
            'profile' => $path ? Storage::url($path) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
        ]);

        return response()->json(['message' => 'User registered in MySQL']);
    }

    public function verifyStaff(Request $request)
    {
        $request->validate([
            'supabase_id' => 'required|exists:staffs,supabase_id',
            'email_verified_at' => 'nullable|date',
        ]);

        try {
            $user = Staff::findOrFail($request->supabase_id);
            $user->update($request->only('email_verified_at'));
            
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user'
            ], 500);
        }
    }

    public function verifyMember(Request $request)
    {
        $request->validate([
            'supabase_id' => 'required|exists:members,supabase_id',
            'email_verified_at' => 'nullable|date',
            'is_active' => 'boolean'
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Update the user's email verification status
            $user = Member::findOrFail($request->supabase_id);
            $user->update($request->only('email_verified_at'));
            
            // Update the member_account's is_active status if it exists in the request
            if ($request->has('is_active')) {
                DB::table('member_accounts')
                    ->where('member_id', $request->supabase_id) 
                    ->update(['is_active' => $request->is_active]);
            }

            // Commit the transaction
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully'
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function registerMember(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'supabase_id' => 'required|string|unique:members,supabase_id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string',
                'username' => 'required|string|unique:users,username',
                'amount' => 'required|numeric|min:0',
                'staff_id' => [
                    'required',
                    Rule::exists('staffs', 'supabase_id'),
                ],
                'profile' => 'nullable|image|max:2048',
            ]);

            DB::beginTransaction();

            // 1. Create user in MySQL
            $userData = [
                'supabase_id' => $validated['supabase_id'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'username' => $validated['username'],
                'email_verified_at' => null, // Will be updated when email is confirmed
                'created_at' => now(),
                'updated_at' => now()
            ];

            if ($request->hasFile('profile')) {
                $path = $request->file('profile')->store("profiles/{$request->id}", 'public');
                $userData['profile'] = $path? Storage::url($path) : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg';  // Add this line to match staff registration
            }

            DB::table('members')->insert($userData);

            // 2. Create member account with initial zero balances
            $accountId = DB::table('member_accounts')->insertGetId([
                'member_id' => $validated['supabase_id'],
                'simpanan_pokok' => 0,
                'simpanan_wajib' => 0,
                'simpanan_sukarela' => 0,
                'sibuhar' => 0,
                'loan' => 0,
                'is_active' => false, // Will activate after email confirmation
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Calculate and record initial deposits
            $deposit = $validated['amount'];
            $allocations = [
                'simpanan_pokok' => $deposit * 0.5,
                'simpanan_wajib' => $deposit * 0.25,
                'simpanan_sukarela' => $deposit * 0.25
            ];

            // Create history records
            $histories = [];
            foreach ($allocations as $type => $amount) {
                $histories[] = [
                    'member_account_id' => $accountId,
                    'member_id' => $validated['supabase_id'],
                    'staff_id' => $validated['staff_id'],
                    'amount' => $amount,
                    'description' => "Initial deposit - " . ucfirst(str_replace('_', ' ', $type)),
                    'type' => 'deposit',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            DB::table('transaction_history')->insert($histories);

            // Update account balances
            DB::table('member_accounts')->where('id', $accountId)->update($allocations + [
                'updated_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Member records created successfully',
                'user_id' => $validated['supabase_id']
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create member records: ' . $e->getMessage()
            ], 500);
        }
    }
}
