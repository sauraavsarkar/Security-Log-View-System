<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Antivirus;

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
            'topFailedLogins', 'afterOfficeUsers', 'topAntivirusAlerts', 'topTrafficIps' ,'logTypeCount'
        ));

        //   dd(compact(
        //     'topFailedLogins', 'afterOfficeUsers', 
        //     'topAntivirusAlerts', 'topTrafficIps','logTypeCount'
        // ));
    }

    public function failedLogins()
    {
        $topFailedLogins = $this->getTopFailedLogins();
        $afterOfficeUsers = $this->getUsersLoggedInAfterOffice();
        $topAntivirusAlerts = $this->getTopAntivirusAlerts();
        $topTrafficIps = $this->getTopTrafficIps();

        return view('dashboard.antivirus.failedlogins', compact(
            'topFailedLogins', 'afterOfficeUsers', 'topAntivirusAlerts', 'topTrafficIps'
        ));
    }

    /**
     * Get top 5 users with failed login attempts.
     */
    public function getTopFailedLogins()
    {
        return Antivirus::select('*', DB::raw('COUNT(*) OVER(PARTITION BY `event_type`) AS count'))
        ->orderByDesc(DB::raw('count'))
        ->get();
    }
    

    public function getLogTypeCount()
    {
        return Antivirus::select('*', DB::raw('COUNT(*) OVER(PARTITION BY `event_type`) AS count'))
        ->orderByDesc(DB::raw('count'))
        ->get();
    }

    public function getUsersLoggedInAfterOffice()
    {
        return Antivirus::select('host_dst', 'username', DB::raw('COUNT(*) as username_count'))
        ->groupBy('host_dst', 'username')
        ->get();
    }

    /**
     * Get top 5 devices with most antivirus alerts.
     */
    public function getTopAntivirusAlerts()
    {
        return Antivirus::select('host_dst', DB::raw('COUNT(*) as count'))
            ->groupBy('host_dst')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    }

    /**
     * Get top 5 IPs with the most traffic.
     */
    public function getTopTrafficIps()
    {
        return Antivirus::select('ip_src', DB::raw('COUNT(*) as count'))
            ->groupBy('ip_src')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    }
}
