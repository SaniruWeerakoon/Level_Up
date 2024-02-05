<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index()
    {
        return view('tokens.index', [
            'tokens' => auth()->user()->tokens,
        ]);
    }


    public function store(Request $request)
    {

        $user = auth()->user();
// Check if a token with the same name already exists
        $existingToken = $user->tokens()->where('name', $request->name)->first();
        if ($existingToken) {
            // Token with the same name already exists, handle accordingly (e.g., display a message)
            return redirect()->route('api-token.index')->with('error', 'Token with the same name already exists.');
        }

        $token = $user->createToken($request->name);

        return view('tokens.index', [
            'token' => $token,
            'tokens' => auth()->user()->tokens,
        ]);
    }

    public function show($id)
    {
        return view('tokens.show', [
            'token' => auth()->user()->tokens()->where('id', $id)->firstOrFail(),
        ]);
    }


    public function destroy($id)
    {
        $user = auth()->user();

        $user->tokens()->where('id', $id)->delete();

        return redirect()->route('api-token.index');
    }

    public function create()
    {
    }


    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

}
