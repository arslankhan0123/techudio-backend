<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\QuoteRequest;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $thisMonth = now()->startOfMonth();
        $lastMonth = now()->subMonthNoOverflow()->startOfMonth();

        // % change this month vs last month
        $trend = function (string $model) use ($thisMonth, $lastMonth): ?float {
            $current = $model::where('created_at', '>=', $thisMonth)->count();
            $previous = $model::whereBetween('created_at', [$lastMonth, $thisMonth])->count();
            if ($previous === 0) {
                return $current > 0 ? 100.0 : null;
            }

            return round((($current - $previous) / $previous) * 100, 1);
        };

        $stats = [
            [
                'label' => 'Quote Requests',
                'value' => QuoteRequest::count(),
                'trend' => $trend(QuoteRequest::class),
                'note' => QuoteRequest::where('created_at', '>=', $thisMonth)->count().' this month',
                'route' => route('admin.quotes.index'),
                'grad' => 'from-violet-500 to-indigo-500',
            ],
            [
                'label' => 'Unread Quotes',
                'value' => QuoteRequest::unread()->count(),
                'trend' => null,
                'note' => 'waiting for review',
                'route' => route('admin.quotes.index', ['status' => 'unread']),
                'grad' => 'from-cyan-400 to-blue-500',
            ],
            [
                'label' => 'Contact Messages',
                'value' => ContactMessage::count(),
                'trend' => $trend(ContactMessage::class),
                'note' => ContactMessage::unread()->count().' unread',
                'route' => route('admin.contacts.index'),
                'grad' => 'from-indigo-500 to-blue-500',
            ],
            [
                'label' => 'Leads Today',
                'value' => QuoteRequest::whereDate('created_at', today())->count() + ContactMessage::whereDate('created_at', today())->count(),
                'trend' => null,
                'note' => 'quotes + messages',
                'route' => null,
                'grad' => 'from-emerald-400 to-teal-500',
            ],
        ];

        // Leads per month — last 12 months
        $months = collect(range(11, 0))->map(fn ($i) => now()->startOfMonth()->subMonthsNoOverflow($i));
        $since = $months->first();
        $countByMonth = fn ($model) => $model::where('created_at', '>=', $since)->get(['created_at'])
            ->groupBy(fn ($r) => $r->created_at->format('Y-m'))->map->count();
        $quotesByMonth = $countByMonth(QuoteRequest::class);
        $contactsByMonth = $countByMonth(ContactMessage::class);
        $chart = $months->map(fn (Carbon $m) => [
            'label' => $m->format('M'),
            'full' => $m->format('F Y'),
            'quotes' => $quotesByMonth[$m->format('Y-m')] ?? 0,
            'contacts' => $contactsByMonth[$m->format('Y-m')] ?? 0,
        ]);
        $chartMax = max(1, $chart->max(fn ($c) => $c['quotes'] + $c['contacts']));

        // Most requested services
        $quotes = QuoteRequest::get(['services', 'budget']);
        $serviceCounts = $quotes->flatMap(fn ($q) => $q->serviceLabels())->countBy()->sortDesc();
        $topServices = $serviceCounts->take(5);
        $quotesWithServices = max(1, $quotes->filter(fn ($q) => ! empty($q->services))->count());

        // Budget breakdown
        $budgets = $quotes->pluck('budget')->filter()->countBy()->sortDesc();

        // Latest leads (quotes + messages merged)
        $recent = QuoteRequest::latest()->take(6)->get()->map(fn ($q) => [
            'type' => 'Quote', 'name' => $q->full_name, 'email' => $q->email,
            'detail' => $q->budget ?: implode(', ', array_slice($q->serviceLabels(), 0, 1)) ?: '—',
            'unread' => ! $q->read_at, 'at' => $q->created_at, 'url' => route('admin.quotes.show', $q),
        ])->concat(ContactMessage::latest()->take(6)->get()->map(fn ($m) => [
            'type' => 'Message', 'name' => $m->full_name, 'email' => $m->email,
            'detail' => \Illuminate\Support\Str::limit($m->message, 40),
            'unread' => ! $m->read_at, 'at' => $m->created_at, 'url' => route('admin.contacts.show', $m),
        ]))->sortByDesc('at')->take(6)->values();

        $totalUsers = User::count();

        return view('dashboard', compact('stats', 'chart', 'chartMax', 'topServices', 'quotesWithServices', 'budgets', 'recent', 'totalUsers'));
    }
}
