<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    // Store Contact Message
    public function store(Request $request)
    {
        // 1) Validation
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // 2) Save to database
        $msg = Message::create($data);

        // 3) Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Message sent successfully',
            'data' => $msg
        ], 201);
    }
}
