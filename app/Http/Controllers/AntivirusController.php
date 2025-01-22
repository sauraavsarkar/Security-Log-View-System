<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\LogEntry;

class AntivirusController extends Controller
{
    public function index()
    {
        $topFailedLogins = $this->getTopFailedLogins();
        $logTypeCount = $this->getLogTypeCount();
        $afterOfficeUsers = $this->getUsersLoggedInAfterOffice();
        $topAntivirusAlerts = $this->getTopAntivirusAlerts();
        $topTrafficIps = $this->getTopTrafficIps();

        return view('dashboard.antivirus', compact(
            'topFailedLogins', 'logTypeCount', 'afterOfficeUsers', 
            'topAntivirusAlerts', 'topTrafficIps'
        ));

        // dd(compact(
        //     'topFailedLogins', 'logTypeCount', 'afterOfficeUsers', 
        //     'topAntivirusAlerts', 'topTrafficIps'
        // ));


    }

    public function getTopFailedLogins()
    {
        return LogEntry::select('username', 'event_type', DB::raw('COUNT(*) as count'))
            ->groupBy('username', 'event_type')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    }
    

    public function getLogTypeCount()
    {
        return LogEntry::select('log_type', DB::raw('count(*) as count'))
            ->groupBy('log_type')
            ->get();
    }

    public function getUsersLoggedInAfterOffice()
    {
        return LogEntry::whereTime('time', '<', '18:00:00')
            ->select('username', 'time')
            ->get();
    }

    public function getTopAntivirusAlerts()
    {
        return LogEntry::where('log_type', 'Antivirus')
            ->select('host_dst', DB::raw('count(*) as count'))
            ->groupBy('host_dst')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    }

    public function getTopTrafficIps()
    {
        return LogEntry::select('ip_src', DB::raw('count(*) as count'))
            ->groupBy('ip_src')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    }
}