<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armajen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArmajenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $armajens = Armajen::paginate(20);

        return view('admin.armajen.index', compact('armajens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.armajen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naran_armajen' => 'required|string|max:100',
            'lokalisasaun' => 'nullable|string|max:100',
            'kapasidade_max' => 'required|numeric|min:0',
            'kapasidade_atual' => 'nullable|numeric|min:0',
            'status' => 'required|in:ativu,inativu',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Armajen::create($request->all());

        return redirect()->route('admin.armajen.index')
            ->with('success', 'Armajen foun ho susesu!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Armajen $armajen)
    {
        return view('admin.armajen.show', compact('armajen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Armajen $armajen)
    {
        return view('admin.armajen.edit', compact('armajen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Armajen $armajen)
    {
        $validator = Validator::make($request->all(), [
            'naran_armajen' => 'required|string|max:100',
            'lokalisasaun' => 'nullable|string|max:100',
            'kapasidade_max' => 'required|numeric|min:0',
            'kapasidade_atual' => 'nullable|numeric|min:0',
            'status' => 'required|in:ativu,inativu',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $armajen->update($request->all());

        return redirect()->route('admin.armajen.index')
            ->with('success', 'Armajen atualiza ho susesu!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Armajen $armajen)
    {
        $armajen->delete();

        return redirect()->route('admin.armajen.index')
            ->with('success', 'Armajen hamos ho susesu!');
    }
}
