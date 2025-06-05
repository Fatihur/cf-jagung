<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    /**
     * Display user's diagnosis history
     */
    public function index()
    {
        $user = Auth::user();

        $diagnoses = Diagnosis::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.history', compact('diagnoses'));
    }

    /**
     * Show specific diagnosis detail
     */
    public function show($id)
    {
        $user = Auth::user();

        $diagnosis = Diagnosis::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('user.diagnosis-detail', compact('diagnosis'));
    }

    /**
     * Delete a diagnosis record
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $diagnosis = Diagnosis::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        $diagnosis->delete();

        return redirect()->route('user.history')
            ->with('success', 'Riwayat diagnosis berhasil dihapus.');
    }
}
