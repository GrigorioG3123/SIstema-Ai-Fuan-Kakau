<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produtor;
use App\Models\Transasaun;
use App\Models\KafeTipu;
use App\Models\Armajen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutor = Produtor::count();
        $totalTransasaun = Transasaun::where('status', 'complete')->count();
        $totalKafeTipu = KafeTipu::where('status', 'ativu')->count();

        $totalProdusaun = Transasaun::where('tipo', 'produsaun')
            ->where('status', 'complete')
            ->sum('kilo');

        $totalVenda = Transasaun::where('tipo', 'venda')
            ->where('status', 'complete')
            ->sum('kilo');

        $recentTransasauns = Transasaun::with(['produtor', 'kafeTipu', 'armajen'])
            ->orderBy('data_transasaun', 'desc')
            ->take(10)
            ->get();

        $topProdutors = Produtor::select('produtors.*')
            ->join('transasauns', 'produtors.id_produtor', '=', 'transasauns.id_produtor')
            ->where('transasauns.status', 'complete')
            ->selectRaw('SUM(transasauns.kilo) as total_kilo, COUNT(transasauns.id_transasaun) as total_transasaun')
            ->groupBy('produtors.id_produtor', 'produtors.naran_produtor', 'produtors.telefone', 'produtors.suku', 'produtors.data_rejistu', 'produtors.created_at', 'produtors.updated_at')
            ->orderBy('total_kilo', 'desc')
            ->take(5)
            ->get();

        $stockData = [
            'labels' => ['Arabica', 'Robusta', 'Timor Hybrid'],
            'data' => [100, 150, 80]
        ];

        // Chart data for last 6 months
        $chartData = [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'produsaun' => [120, 150, 180, 140, 160, 190],
            'venda' => [100, 130, 160, 120, 140, 170]
        ];

        return view('admin.dashboard', compact(
            'totalProdutor',
            'totalTransasaun',
            'totalKafeTipu',
            'totalProdusaun',
            'totalVenda',
            'recentTransasauns',
            'topProdutors',
            'stockData',
            'chartData'
        ));
    }

    public function relatorioGeral()
    {
        $stats = [
            'total_produtor' => Produtor::count(),
            'total_transasaun' => Transasaun::where('status', 'complete')->count(),
            'total_kilo' => Transasaun::where('status', 'complete')->sum('kilo'),
            'total_produsaun' => Transasaun::where('tipo', 'produsaun')
                ->where('status', 'complete')
                ->sum('kilo'),
            'total_venda' => Transasaun::where('tipo', 'venda')
                ->where('status', 'complete')
                ->sum('kilo'),
            'total_revenue' => Transasaun::where('tipo', 'venda')
                ->where('status', 'complete')
                ->sum('total_valor'),
            'total_kafe_tipu' => KafeTipu::where('status', 'ativu')->count(),
            'total_armajen' => Armajen::count(),
            'total_transactions' => Transasaun::count(),
            'total_transactions_prod' => Transasaun::where('tipo', 'produsaun')->count(),
            'total_transactions_venda' => Transasaun::where('tipo', 'venda')->count(),
            'pending_transactions' => Transasaun::where('status', 'pending')->count(),
            'total_profit' => Transasaun::where('tipo', 'venda')
                ->where('status', 'complete')
                ->sum('total_valor'),
            'overall_conversion_rate' => 85.5
        ];

        $stockSummary = [
            ['tipu' => 'Arabica', 'stock' => 150.5],
            ['tipu' => 'Robusta', 'stock' => 200.0],
            ['tipu' => 'Timor Hybrid', 'stock' => 75.2]
        ];

        $topProducers = Produtor::select('produtors.*')
            ->join('transasauns', 'produtors.id_produtor', '=', 'transasauns.id_produtor')
            ->where('transasauns.status', 'complete')
            ->selectRaw('SUM(transasauns.kilo) as total_produsaun')
            ->groupBy('produtors.id_produtor', 'produtors.naran_produtor', 'produtors.telefone', 'produtors.suku', 'produtors.data_rejistu', 'produtors.created_at', 'produtors.updated_at')
            ->orderBy('total_produsaun', 'desc')
            ->take(5)
            ->get();

        $chartData = [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'produsaun' => [120, 150, 180, 140, 160, 190],
            'venda' => [100, 130, 160, 120, 140, 170],
            'revenue' => [5000, 6500, 8000, 6000, 7000, 9500]
        ];

        $monthlyPerformance = [
            ['month' => 'January', 'produsaun' => 120, 'venda' => 100, 'revenue' => 5000, 'profit' => 4500, 'conversion_rate' => 83.3],
            ['month' => 'February', 'produsaun' => 150, 'venda' => 130, 'revenue' => 6500, 'profit' => 5850, 'conversion_rate' => 86.7],
            ['month' => 'March', 'produsaun' => 180, 'venda' => 160, 'revenue' => 8000, 'profit' => 7200, 'conversion_rate' => 88.9],
            ['month' => 'April', 'produsaun' => 140, 'venda' => 120, 'revenue' => 6000, 'profit' => 5400, 'conversion_rate' => 85.7],
            ['month' => 'May', 'produsaun' => 160, 'venda' => 140, 'revenue' => 7000, 'profit' => 6300, 'conversion_rate' => 87.5],
            ['month' => 'June', 'produsaun' => 190, 'venda' => 170, 'revenue' => 9500, 'profit' => 8550, 'conversion_rate' => 89.5]
        ];

        return view('admin.relatorios.geral', compact('stats', 'stockSummary', 'topProducers', 'chartData', 'monthlyPerformance'));
    }

    public function relatorioAnual(Request $request)
    {
        $ano = $request->get('ano', date('Y'));

        $dados = Transasaun::whereYear('data_transasaun', $ano)
            ->where('status', 'complete')
            ->selectRaw('
                tipo,
                SUM(kilo) as total_kilo,
                SUM(total_valor) as total_valor,
                COUNT(*) as total_transasaun
            ')
            ->groupBy('tipo')
            ->get();

        return view('admin.relatorios.anual', compact('dados', 'ano'));
    }

    public function relatorioMensal(Request $request)
    {
        $ano = $request->get('ano', date('Y'));
        $mes = $request->get('mes', date('m'));

        // Dados mensais por tipo de transação
        $dadosMensais = Transasaun::whereYear('data_transasaun', $ano)
            ->whereMonth('data_transasaun', $mes)
            ->where('status', 'complete')
            ->selectRaw('
                tipo,
                SUM(kilo) as total_kilo,
                SUM(total_valor) as total_valor,
                COUNT(*) as total_transasaun
            ')
            ->groupBy('tipo')
            ->get();

        // Dados diários do mês
        $dadosDiarios = Transasaun::whereYear('data_transasaun', $ano)
            ->whereMonth('data_transasaun', $mes)
            ->where('status', 'complete')
            ->selectRaw('
                DATE(data_transasaun) as data,
                tipo,
                SUM(kilo) as total_kilo,
                SUM(total_valor) as total_valor,
                COUNT(*) as total_transasaun
            ')
            ->groupBy('data', 'tipo')
            ->orderBy('data')
            ->get();

        // Estatísticas do mês
        $statsMes = [
            'total_produsaun' => Transasaun::whereYear('data_transasaun', $ano)
                ->whereMonth('data_transasaun', $mes)
                ->where('tipo', 'produsaun')
                ->where('status', 'complete')
                ->sum('kilo'),
            'total_venda' => Transasaun::whereYear('data_transasaun', $ano)
                ->whereMonth('data_transasaun', $mes)
                ->where('tipo', 'venda')
                ->where('status', 'complete')
                ->sum('kilo'),
            'total_revenue' => Transasaun::whereYear('data_transasaun', $ano)
                ->whereMonth('data_transasaun', $mes)
                ->where('tipo', 'venda')
                ->where('status', 'complete')
                ->sum('total_valor'),
            'total_transacoes_prod' => Transasaun::whereYear('data_transasaun', $ano)
                ->whereMonth('data_transasaun', $mes)
                ->where('tipo', 'produsaun')
                ->where('status', 'complete')
                ->count(),
            'total_transacoes_venda' => Transasaun::whereYear('data_transasaun', $ano)
                ->whereMonth('data_transasaun', $mes)
                ->where('tipo', 'venda')
                ->where('status', 'complete')
                ->count(),
        ];

        $nomeMes = [
            '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril',
            '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto',
            '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro'
        ];

        return view('admin.relatorios.mensal', compact('dadosMensais', 'dadosDiarios', 'statsMes', 'ano', 'mes', 'nomeMes'));
    }

    public function transasaunsProdusaun()
    {
        $transasauns = Transasaun::with(['produtor', 'kafeTipu', 'armajen'])
            ->where('tipo', 'produsaun')
            ->orderBy('data_transasaun', 'desc')
            ->paginate(20);
        return view('admin.transasauns.produsaun', compact('transasauns'));
    }

    public function transasaunsVenda()
    {
        $transasauns = Transasaun::with(['produtor', 'kafeTipu', 'armajen'])
            ->where('tipo', 'venda')
            ->orderBy('data_transasaun', 'desc')
            ->paginate(20);

        return view('admin.transasauns.venda', compact('transasauns'));
    }

    public function transasaunsIndex()
    {
        $transasauns = Transasaun::with(['produtor', 'kafeTipu', 'armajen'])
            ->orderBy('data_transasaun', 'desc')
            ->paginate(20);

        $totalProdusaun = Transasaun::where('tipo', 'produsaun')
            ->where('status', 'complete')
            ->sum('kilo');

        $totalVenda = Transasaun::where('tipo', 'venda')
            ->where('status', 'complete')
            ->sum('kilo');

        $pendingCount = Transasaun::where('status', 'pending')->count();

        $totalKilo = Transasaun::sum('kilo');
        $totalValor = Transasaun::sum('total_valor');

        $stats = [
            'total_transactions' => Transasaun::count(),
            'total_produsaun' => $totalProdusaun,
            'total_venda' => $totalVenda,
            'pending_count' => $pendingCount
        ];

        return view('admin.transasauns.index', compact('transasauns', 'totalProdusaun', 'totalVenda', 'pendingCount', 'totalKilo', 'totalValor', 'stats'));
    }

    public function kafeTipuIndex()
    {
        $kafeTipus = KafeTipu::orderBy('naran_tipu')->paginate(20);

        return view('admin.kafe-tipu.index', compact('kafeTipus'));
    }
}
