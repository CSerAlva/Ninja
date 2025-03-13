<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Dojo;
use Illuminate\Http\Request;

class DojoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');//给用户做认证
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dojos = Dojo::all();
        return view('dojos.index', compact('dojos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dojos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'location' => 'required|string',
            'description' => 'required|string',
        ]);

        if (Dojo::create($validatedData)) {
            return redirect()->route('dojos.index');
        }
        return response()->json(['error' => 'Dojo data create failed', 400]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
