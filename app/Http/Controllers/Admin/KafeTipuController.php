<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KafeTipu;
use Illuminate\Http\Request;

class KafeTipuController extends Controller
{
    public function index()
    {
        $kafeTipus = KafeTipu::orderBy('naran_tipu')->paginate(20);

        return view('admin.kafe-tipu.index', compact('kafeTipus'));
    }

    public function create()
    {
        return view('admin.kafe-tipu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'naran_tipu' => 'required|string|max:50|unique:kafe_tipus',
            'deskrisaun' => 'nullable|string',
            'folin_base' => 'required|numeric|min:0',
            'kategoria' => 'required|in:Premium,Standard,Economy',
            'status' => 'required|in:ativu,inativu',
        ]);

        KafeTipu::create($request->all());

        return redirect()->route('admin.kafe-tipu.index')
            ->with('success', 'Kafé tipu rejistu ho susesu!');
    }

    public function show(KafeTipu $kafeTipu)
    {
        $kafeTipu->load(['transasauns' => function($query) {
            $query->with('produtor', 'armajen')->orderBy('data_transasaun', 'desc');
        }]);

        return view('admin.kafe-tipu.show', compact('kafeTipu'));
    }

    public function edit(KafeTipu $kafeTipu)
    {
        return view('admin.kafe-tipu.edit', compact('kafeTipu'));
    }

    public function update(Request $request, KafeTipu $kafeTipu)
    {
        $request->validate([
            'naran_tipu' => 'required|string|max:50|unique:kafe_tipus,naran_tipu,' . $kafeTipu->id_tipu . ',id_tipu',
            'deskrisaun' => 'nullable|string',
            'folin_base' => 'required|numeric|min:0',
            'kategoria' => 'required|in:Premium,Standard,Economy',
            'status' => 'required|in:ativu,inativu',
        ]);

        $kafeTipu->update($request->all());

        return redirect()->route('admin.kafe-tipu.index')
            ->with('success', 'Kafé tipu atualiza ho susesu!');
    }

    public function destroy(KafeTipu $kafeTipu)
    {
        // Check if kafe tipu has transactions
        if ($kafeTipu->transasauns()->count() > 0) {
            return redirect()->route('admin.kafe-tipu.index')
                ->with('error', 'La bele delete kafé tipu ne\'ebé iha transasaun!');
        }

        $kafeTipu->delete();

        return redirect()->route('admin.kafe-tipu.index')
            ->with('success', 'Kafé tipu deleta ho susesu!');
    }
}
