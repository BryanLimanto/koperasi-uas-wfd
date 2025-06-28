<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberAccount;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberDashboard extends Controller
{
    public function getMember(Request $request) {
        $email = $request->input('email');

        $user = Member::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Get the member's account information
        $memberAccount = MemberAccount::where('member_id', $user->supabase_id)->first();

        $response = [
            'supabase_id' => $user->supabase_id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'username' => $user->username, 
            'profile' => $user->profile,
        ];

        // If member account exists, add the financial data to the response
        if ($memberAccount) {
            $response['account'] = [
                'simpanan_pokok' => $memberAccount->simpanan_pokok,
                'simpanan_wajib' => $memberAccount->simpanan_wajib,
                'simpanan_sukarela' => $memberAccount->simpanan_sukarela,
                'sibuhar' => $memberAccount->sibuhar,
                'loan' => $memberAccount->loan,
                'is_active' => $memberAccount->is_active,
            ];
        }

        return response()->json($response);
    }

    public function updateSimpananPokok(Request $request)
    {
         $validated = $request->validate([
            'member_id' => 'required',
            'staff_id' => 'nullable',
            'amount' => 'required',
        ]);

        $deposit = $validated['amount'];

        $allocations = [
            'simpanan_pokok' => $deposit * 0.5,
            'simpanan_wajib' => $deposit * 0.25,
            'simpanan_sukarela' => $deposit * 0.25,
        ];

        $account = MemberAccount::where('member_id', $validated['member_id'])
            ->where('is_active', true)
            ->where('is_deleted', false)
            ->firstOrFail();

        foreach ($allocations as $column => $amount) {
            try {
                $account->increment($column, $amount);

                try {
                    TransactionHistory::create([
                        'member_account_id' => $account->id,
                        'amount' => $amount,
                        'member_id' => $validated['member_id'],
                        'staff_id' => $validated['staff_id'],
                        'description' => ucfirst(str_replace('_', ' ', $column)),
                        'type' => 'deposit',
                    ]);
                } catch (\Exception $e) {
                    Log::error("Gagal insert TransactionHistory untuk $column: " . $e->getMessage());
                }
            } catch (\Exception $e) {
                Log::error("Gagal pada $column: " . $e->getMessage());
            }
        }

        return response()->json([
            'message' => 'Deposit berhasil dialokasikan',
            'total_amount' => $deposit,
            'allocations' => $allocations,
        ]);
    }

    private function handleTransaction(Request $request, string $column, string $description, string $type)
    {
        $validated = $request->validate([
            'member_id' => 'required',
            'staff_id' => 'nullable',
            'amount' => 'required',
        ]);

        $account = MemberAccount::where('member_id', $validated['member_id'])
            ->where('is_active', true)
            ->where('is_deleted', false)
            ->firstOrFail();

        $account->increment($column, $validated['amount']);

        TransactionHistory::create([
            'member_account_id' => $account->id,
            'amount' => $validated['amount'],
            'member_id' => $validated['member_id'],
            'staff_id' => $validated['staff_id'],
            'description' => $description,
            'type' => $type,
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil',
            'type' => $type,
            'column' => $column,
            'amount' => $validated['amount'],
        ]);
    }

    public function updateSibuhar(Request $request)
    {
        return $this->handleTransaction($request, 'sibuhar', 'Deposit Sibuhar', 'deposit');
    }
}
