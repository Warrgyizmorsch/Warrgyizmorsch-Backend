<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class LoginListener
{
    protected static $lastLoggedInAt = null;
    public function handle(Login $event)
    {
        $now = now();

        // check if event fired recently (within 2 seconds)
        if (static::$lastLoggedInAt && static::$lastLoggedInAt->diffInSeconds($now) < 2) {
            return; // skip duplicate trigger
        }

        static::$lastLoggedInAt = $now;
        
        $user = $event->user;

        // ✅ Make sure current session row has the user_id
        DB::table('sessions')
            ->where('id', session()->getId())
            ->update([
                'user_id' => $user->id,
            ]);

        // ✅ Force single session (remove other sessions of this user)
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', session()->getId())
            ->delete();

        // ✅ Parse User Agent
        $agent = new Agent();
        $agent->setUserAgent(request()->userAgent());

        $platform = $agent->platform() ?: 'Unknown Platform'; // Windows, iOS, Android, Mac
        $browser = $agent->browser() ?: 'Unknown Browser';
        $device = $agent->isDesktop() ? 'Desktop' : ($agent->device() ?: 'Unknown Device');

        $userAgentSummary = "{$platform} | {$browser} | {$device}";

        // Store in existing column
        LoginHistory::create([
            'user_id' => $user->id,
            'ip_address' => request()->ip(),
            'user_agent' => $userAgentSummary,
        ]);
    }
}
