<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // List all clients
    public function index()
    {
        return response()->json(Client::all());
    }

    // Create client
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
            'status'=> 'required|in:active,inactive',
        ]);

        $client = Client::create($request->all());

        return response()->json(['message' => 'Client created', 'data' => $client], 201);
    }

    // Show single client
    public function show($id)
    {
        return Client::findOrFail($id);
    }

    // Update client
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'status'=> 'required|in:active,inactive',
        ]);

        $client->update($request->all());

        return response()->json(['message' => 'Client updated', 'data' => $client]);
    }

    // Delete client
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();

        return response()->json(['message' => 'Client deleted']);
    }
}
