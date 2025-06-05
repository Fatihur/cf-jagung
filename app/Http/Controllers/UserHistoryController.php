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
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Diagnosis::where('user_id', $user->id);

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by disease (search in results JSON)
        if ($request->filled('disease')) {
            $query->where('results', 'like', '%' . $request->disease . '%');
        }

        $diagnoses = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

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
