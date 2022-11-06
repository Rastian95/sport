<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;
use Laravel\Jetstream\Jetstream;

class PerfilController extends Controller
{

    public function show(Request $request)
    {
        return Inertia::render('Admin/Profile/Show', [
            'sessions' => $this->sessions($request)->all(),
        ]);
    }


    public function sessions(Request $request)
    {
        if (config('session.driver') !== 'database-multi-guard') {
            return collect();
        }
        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('authenticable_id', Auth::user()->getAuthIdentifier())
                ->where('authenticable_type', Auth::user()->getMorphClass())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) use ($request) {
            $agent = $this->createAgent($session);
            return (object) [
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    protected function createAgent($session)
    {
        return tap(new Agent, function ($agent) use ($session) {
            $agent->setUserAgent($session->user_agent);
        });
    }

}
