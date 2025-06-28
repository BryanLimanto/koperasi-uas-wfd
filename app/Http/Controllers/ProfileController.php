<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberHistory;
use App\Models\Staff;
use App\Models\StaffHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateStaff(Request $request)
    {
        $request->validate([
            'supabase_id' => 'required|string|exists:staffs,supabase_id',
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $staff = Staff::where('supabase_id', $request->supabase_id)->firstOrFail();
        $original = $staff->only(['name', 'phone', 'profile']);

        // Handle file upload
        if ($request->hasFile('profile')) {
            // Delete old profile if exists
            if ($staff->profile) {
                $oldFilePath = str_replace('/storage/', '', $staff->profile);
                Storage::disk('public')->delete($oldFilePath);
            }
            
            // Store file with correct path format
            $file = $request->file('profile');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $dbPath = $file->storeAs('profiles', $filename, 'public');
            
            // Format path untuk disimpan di database
            $dbPath = '/storage/profiles/'.$filename;
        } else {
            $dbPath = $staff->profile;
        }

        // Track changes
        $changes = [];
        if ($request->filled('name') && $request->name !== $original['name']) {
            $changes[] = "Nama: '{$original['name']}' → '{$request->name}'";
        }
        if ($request->filled('phone') && $request->phone !== $original['phone']) {
            $changes[] = "Telepon: '{$original['phone']}' → '{$request->phone}'";
        }
        if ($request->hasFile('profile')) {
            $changes[] = "Foto profil diubah.";
        }

        // Update staff record
        $staff->update([
            'name' => $request->name ?? $staff->name,
            'phone' => $request->phone ?? $staff->phone,
            'profile' => $dbPath,
        ]);

        // Create history if there are changes
        if (!empty($changes)) {
            StaffHistory::create([
                'staff_id' => $staff->supabase_id,
                'description' => implode('; ', $changes),
                'updated_at' => Carbon::now(),
            ]);
        }

        return response()->json([
            'message' => 'Staff updated successfully',
            'profile_url' => $dbPath ? asset('storage/'.$dbPath) : null
        ]);
    }

    public function updateMember(Request $request)
    {
        $request->validate([
            'supabase_id' => 'required|string|exists:members,supabase_id',
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $member = Member::where('supabase_id', $request->supabase_id)->firstOrFail();
        $original = $member->only(['name', 'phone', 'profile']);

        // Handle file upload
        if ($request->hasFile('profile')) {
            // Delete old profile if exists
            if ($member->profile) {
                $oldFilePath = str_replace('/storage/', '', $member->profile);
                Storage::disk('public')->delete($oldFilePath);
            }
            
            // Store file with correct path format
            $file = $request->file('profile');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $dbPath = $file->storeAs('profiles', $filename, 'public');
            
            // Format path untuk disimpan di database
            $dbPath = '/storage/profiles/'.$filename;
        } else {
            $dbPath = $member->profile;
        }

        // Track changes
        $changes = [];
        if ($request->filled('name') && $request->name !== $original['name']) {
            $changes[] = "Nama: '{$original['name']}' → '{$request->name}'";
        }
        if ($request->filled('phone') && $request->phone !== $original['phone']) {
            $changes[] = "Telepon: '{$original['phone']}' → '{$request->phone}'";
        }
        if ($request->hasFile('profile')) {
            $changes[] = "Foto profil diubah.";
        }

        // Update staff record
        $member->update([
            'name' => $request->name ?? $member->name,
            'phone' => $request->phone ?? $member->phone,
            'profile' => $dbPath,
        ]);

        // Create history if there are changes
        if (!empty($changes)) {
            MemberHistory::create([
                'member_id' => $member->supabase_id,
                'description' => implode('; ', $changes),
                'updated_at' => Carbon::now(),
            ]);
        }

        return response()->json([
            'message' => 'Member updated successfully',
            'profile_url' => $dbPath ? asset('storage/'.$dbPath) : null
        ]);
    }

    public function updateEmailStaff(Request $request){
        // Validasi langsung
        $validated = $request->validate([
            'staff_id' => 'required|exists:staffs,supabase_id',
            'email' => 'required|email|unique:staffs,email',
        ]);

        try {
            DB::beginTransaction();

            // Update email staff
            DB::table('staffs')
                ->where('supabase_id', $validated['staff_id'])
                ->update([
                    'email' => $validated['email'],
                    'updated_at' => now(),
                ]);

            // Catat perubahan ke tabel history
            DB::table('staffs_history')->insert([
                'staff_id' => $validated['staff_id'],
                'description' => 'Email staff diubah menjadi ' . $validated['email'],
                'updated_at' => now(),
            ]);

            DB::commit();

            return response()->json(['message' => 'Email berhasil diperbarui.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal mengubah email.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
