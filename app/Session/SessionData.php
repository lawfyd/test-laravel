<?php

namespace App\Session;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class SessionData extends Model
{
    public static function getData()
    {
        self::addData(session('_token'));

        $data = DB::table('sessions')
            ->select('browser_name', DB::raw('count(*) as total'))
            ->groupBy('browser_name')
            ->get();

        return $data;
    }

    /**
     * @param $token
     * add data to session table
     */
    public static function addData($token)
    {
        $result = DB::table('sessions')
            ->where('id', '=', $token)
            ->get();

        // check exist session
        if (!$result->toArray()) {
            $agent = new Agent;
            DB::table('sessions')->insert(
                [
                    'id' => $token,
                    'payload' => base64_encode($token),
                    'last_activity' => time(),
                    'browser_name' => $agent->browser(),
                    'user_agent' => request()->header('User-Agent'),
                    'ip_address' => request()->ip()
                ]
            );
        };
    }
}
