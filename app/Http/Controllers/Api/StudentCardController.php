<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentCardController extends Controller
{
    // GET /api/student-card/status
    public function status(Request $request)
    {
        $cardId = $request->query('card_id');
        if ($cardId) {
            $user = \App\Models\User::where('card_id', $cardId)->first();
            if (!$user) {
                return response()->json(['error' => 'Card not found'], 404);
            }
        } else {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }
        $hasMembership = $user->membership_id !== null;
        $membershipType = $hasMembership ? optional($user->membership)->type : null;
        return response()->json([
            'student_id' => $user->id,
            'has_active_membership' => $hasMembership,
            'membership_type' => $membershipType,
        ]);
    }
}
