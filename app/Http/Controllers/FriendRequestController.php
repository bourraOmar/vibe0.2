<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    // Envoyer une demande d'ami
    public function sendRequest($receiver_id)
    {
        // Vérifie si la demande existe déjà
        if (FriendRequest::where('user_id', Auth::id())->where('friend_id', $receiver_id)->exists()) {
            return back()->with('error', 'Demande déjà envoyée.');
        }

        FriendRequest::create([
            'user_id' => Auth::id(),
            'friend_id' => $receiver_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Demande envoyée.');
    }

    // Accepter une demande
    public function acceptRequest($request_id)
    {
        $request = FriendRequest::findOrFail($request_id);

        if ($request->friend_id != Auth::id()) {
            return back()->with('error', 'Non autorisé.');
        }

        $request->update(['status' => 'accepted']);

        return back()->with('success', 'Demande acceptée.');
    }

    // Refuser une demande
    public function rejectRequest($request_id)
    {
        $request = FriendRequest::findOrFail($request_id);

        if ($request->friend_id != Auth::id()) {
            return back()->with('error', 'Non autorisé.');
        }

        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Demande refusée.');
    }

    public function showRequests()
    {
        $friendRequests = FriendRequest::where('friend_id', Auth::id())->where('status', 'pending')->get();
        return view('requests', compact('friendRequests'));
    }

    
}
