<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produtor;
use Illuminate\Http\Request;

class ProdutorController extends Controller
{
    public function index()
    {
        $produtors = Produtor::orderBy('naran_produtor')->paginate(20);
        return view('admin.produtors.index', compact('produtors'));
    }

    public function create()
    {
        return view('admin.produtors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'naran_produtor' => 'required|string|max:100',
            'telefone' => 'nullable|string|max:15',
            'suku' => 'nullable|string|max:50'
        ]);

        Produtor::create($request->all());

        return redirect()->route('admin.produtors.index')
            ->with('success', 'Produtór rejistu ho susesu!');
    }

    public function show(Produtor $produtor)
    {
        $transasauns = $produtor->transasauns()
            ->with(['kafeTipu', 'armajen'])
            ->orderBy('data_transasaun', 'desc')
            ->get();

        $totalProdusaun = $produtor->transasauns()
            ->where('tipo', 'produsaun')
            ->where('status', 'complete')
            ->sum('kilo');

        $totalVenda = $produtor->transasauns()
            ->where('tipo', 'venda')
            ->where('status', 'complete')
            ->sum('kilo');

        return view('admin.produtors.show', compact('produtor', 'transasauns', 'totalProdusaun', 'totalVenda'));
    }

    public function edit(Produtor $produtor)
    {
        return view('admin.produtors.edit', compact('produtor'));
    }

    public function update(Request $request, Produtor $produtor)
    {
        $request->validate([
            'naran_produtor' => 'required|string|max:100',
            'telefone' => 'nullable|string|max:15',
            'suku' => 'nullable|string|max:50'
        ]);

        $produtor->update($request->all());

        return redirect()->route('admin.produtors.index')
            ->with('success', 'Produtór atualiza ho susesu!');
    }

    public function destroy(Produtor $produtor)
    {
        $produtor->delete();
        return redirect()->route('admin.produtors.index')
            ->with('success', 'Produtór deleta ho susesu!');
    }
}
