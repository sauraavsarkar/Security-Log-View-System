<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Firewall;
use Illuminate\Support\Facades\DB;

class FirewallController extends Controller
{
    // Method to get the top 5 outbound network traffic based on 'action'
    public function getTopOutboundTraffic()
    {
        return Firewall::where('action', 'like', '%outbound-network-traffic%')
            ->select('ip_src', 'ip_dst', DB::raw('count(*) as traffic_count'))
            ->groupBy('ip_src', 'ip_dst')
            ->orderByDesc('traffic_count')
            ->take(5)
            ->get();
    }

    // Method to get the top 5 countries for outbound traffic
    public function getTopOutboundCountries()
    {
        return Firewall::where('direction', 'outbound')
            ->select('country_src', DB::raw('count(*) as outbound_count'))
            ->groupBy('country_src')
            ->orderByDesc('outbound_count')
            ->take(5)
            ->get();
    }

    // Method to get the top 5 cities for outbound traffic
    public function getTopOutboundCities()
    {
        return Firewall::where('direction', 'outbound')
            ->select('city_src', DB::raw('count(*) as city_outbound_count'))
            ->groupBy('city_src')
            ->orderByDesc('city_outbound_count')
            ->take(5)
            ->get();
    }

    // Method to get the top 5 logs with the 'blocked' severity
    public function getTopBlockedLogs()
    {
        return Firewall::where('severity_action', 'blocked')
            ->select('ip_src', 'ip_dst', DB::raw('count(*) as blocked_count'))
            ->groupBy('ip_src', 'ip_dst')
            ->orderByDesc('blocked_count')
            ->take(5)
            ->get();
    }

    // Method to get the top 5 user agents in firewall logs
    public function getTopUserAgents()
    {
        return Firewall::select('user_agent', DB::raw('count(*) as user_agent_count'))
            ->groupBy('user_agent')
            ->orderByDesc('user_agent_count')
            ->take(5)
            ->get();
    }

    // Method to get the top 5 event descriptions from the logs
    public function getTopEventDescriptions()
    {
        return Firewall::select('event_desc', DB::raw('count(*) as event_desc_count'))
            ->groupBy('event_desc')
            ->orderByDesc('event_desc_count')
            ->take(5)
            ->get();
    }

    // Method to get the top 5 IP pairs with the most traffic
    public function getTopIPPairs()
    {
        return Firewall::select('ip_src', 'ip_dst', DB::raw('count(*) as ip_pair_count'))
            ->groupBy('ip_src', 'ip_dst')
            ->orderByDesc('ip_pair_count')
            ->take(5)
            ->get();
    }

    // Method to get the top 5 firewall actions
    public function getTopFirewallActions()
    {
        return Firewall::select('action', DB::raw('count(*) as action_count'))
            ->groupBy('action')
            ->orderByDesc('action_count')
            ->take(5)
            ->get();
    }

    // Method to get the top 5 severity levels
    public function getTopSeverityLevels()
    {
        return Firewall::select('severity', DB::raw('count(*) as severity_count'))
            ->groupBy('severity')
            ->orderByDesc('severity_count')
            ->take(5)
            ->get();
    }
    

    // Main method to collect all the necessary data for the dashboard
    public function index()
    {
        $topOutboundTraffic = $this->getTopOutboundTraffic();
        $topOutboundCountries = $this->getTopOutboundCountries();
        $topOutboundCities = $this->getTopOutboundCities();
        $topBlockedLogs = $this->getTopBlockedLogs();
        $topUserAgents = $this->getTopUserAgents();
        $topEventDescriptions = $this->getTopEventDescriptions();
        $topIPPairs = $this->getTopIPPairs();
        $topFirewallActions = $this->getTopFirewallActions();
        $topSeverityLevels = $this->getTopSeverityLevels();

        // Dump the variables and halt the script (remove it after debugging)
        // dd(
        //     $topOutboundTraffic,
        //     $topOutboundCountries,
        //     $topOutboundCities,
        //     $topBlockedLogs,
        //     $topUserAgents,
        //     $topEventDescriptions,
        //     $topIPPairs,
        //     $topFirewallActions,
        //     $topSeverityLevels
        // );

        // Pass the data to the view
        return view('dashboard.firewall', compact(
            'topOutboundTraffic',
            'topOutboundCountries',
            'topOutboundCities',
            'topBlockedLogs',
            'topUserAgents',
            'topEventDescriptions',
            'topIPPairs',
            'topFirewallActions',
            'topSeverityLevels'
        ));
    }
}
