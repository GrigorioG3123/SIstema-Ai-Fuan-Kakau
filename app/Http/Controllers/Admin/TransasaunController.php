<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transasaun;
use App\Models\Produtor;
use App\Models\KafeTipu;
use App\Models\Armajen;
use Illuminate\Http\Request;

class TransasaunController extends Controller
{
    public function index(Request $request)
    {
        $query = Transasaun::with(['produtor', 'kafeTipu', 'armajen'])
            ->orderBy('data_transasaun', 'desc')
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->where('data_transasaun', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('data_transasaun', '<=', $request->end_date);
        }

        $transasauns = $query->paginate(15);

        // Statistics for dashboard
        $totalProdusaun = Transasaun::where('tipo', 'produsaun')
            ->where('status', 'complete')
            ->sum('kilo');

        $totalVenda = Transasaun::where('tipo', 'venda')
            ->where('status', 'complete')
            ->sum('kilo');

        $pendingCount = Transasaun::where('status', 'pending')->count();

        // Calculate total kilo and valor for current page
        $totalKilo = $transasauns->sum('kilo');
        $totalValor = $transasauns->sum(function ($transasaun) {
            return $transasaun->kilo * $transasaun->folin_unitariu;
        });

        // Stats for the view
        $stats = [
            'total_transactions' => Transasaun::count(),
            'total_produsaun' => $totalProdusaun,
            'total_venda' => $totalVenda,
            'pending_count' => $pendingCount,
        ];

        return view('admin.transasauns.index', compact(
            'transasauns',
            'totalProdusaun',
            'totalVenda',
            'pendingCount',
            'totalKilo',
            'totalValor',
            'stats'
        ));
    }

    public function create()
    {
        $produtors = Produtor::orderBy('naran_produtor')->get();
        $kafeTipus = KafeTipu::where('status', 'ativu')->orderBy('naran_tipu')->get();
        $armajens = Armajen::where('status', 'ativu')->orderBy('naran_armajen')->get();

        return view('admin.transasauns.create', compact('produtors', 'kafeTipus', 'armajens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_produtor' => 'nullable|exists:produtors,id_produtor',
            'id_tipu' => 'required|exists:kafe_tipus,id_tipu',
            'id_armajen' => 'required|exists:armajens,id_armajen',
            'data_transasaun' => 'required|date',
            'tipo' => 'required|in:produsaun,venda,transferensia',
            'kilo' => 'required|numeric|min:0.01',
            'folin_unitariu' => 'required|numeric|min:0',
            'status' => 'required|in:pending,complete,cancel',
            'naran_kliente' => 'required_if:tipo,venda|nullable|string|max:100'
        ]);

        // Additional validation for production transactions
        if ($validated['tipo'] === 'produsaun' && empty($validated['id_produtor'])) {
            return redirect()->back()->withErrors(['id_produtor' => 'Produtór tenke hili ba transasaun produsaun.'])->withInput();
        }

        Transasaun::create($validated);

        return redirect()->route('admin.transasauns.index')
            ->with('success', 'Transasaun foun rejistu ho susesu!');
    }

    public function show(Transasaun $transasaun)
    {
        $transasaun->load(['produtor', 'kafeTipu', 'armajen']);
        return view('admin.transasauns.show', compact('transasaun'));
    }

    public function edit(Transasaun $transasaun)
    {
        $produtors = Produtor::orderBy('naran_produtor')->get();
        $kafeTipus = KafeTipu::where('status', 'ativu')->orderBy('naran_tipu')->get();
        $armajens = Armajen::where('status', 'ativu')->orderBy('naran_armajen')->get();

        return view('admin.transasauns.edit', compact('transasaun', 'produtors', 'kafeTipus', 'armajens'));
    }

    public function update(Request $request, Transasaun $transasaun)
    {
        $validated = $request->validate([
            'id_produtor' => 'nullable|exists:produtors,id_produtor',
            'id_tipu' => 'required|exists:kafe_tipus,id_tipu',
            'id_armajen' => 'required|exists:armajens,id_armajen',
            'data_transasaun' => 'required|date',
            'tipo' => 'required|in:produsaun,venda,transferensia',
            'kilo' => 'required|numeric|min:0.01',
            'folin_unitariu' => 'required|numeric|min:0',
            'status' => 'required|in:pending,complete,cancel',
            'naran_kliente' => 'required_if:tipo,venda|nullable|string|max:100'
        ]);

        // Additional validation for production transactions
        if ($validated['tipo'] === 'produsaun' && empty($validated['id_produtor'])) {
            return redirect()->back()->withErrors(['id_produtor' => 'Produtór tenke hili ba transasaun produsaun.'])->withInput();
        }

        $transasaun->update($validated);

        return redirect()->route('admin.transasauns.index')
            ->with('success', 'Transasaun atualiza ho susesu!');
    }

    public function destroy(Transasaun $transasaun)
    {
        $transasaun->delete();

        return redirect()->route('admin.transasauns.index')
            ->with('success', 'Transasaun deleta ho susesu!');
    }

    public function produsaun()
    {
        $transasauns = Transasaun::with(['produtor', 'kafeTipu', 'armajen'])
            ->where('tipo', 'produsaun')
            ->orderBy('data_transasaun', 'desc')
            ->paginate(15);

        return view('admin.transasauns.produsaun', compact('transasauns'));
    }

    public function venda()
    {
        $transasauns = Transasaun::with(['kafeTipu', 'armajen'])
            ->where('tipo', 'venda')
            ->orderBy('data_transasaun', 'desc')
            ->paginate(15);

        return view('admin.transasauns.venda', compact('transasauns'));
    }
}
