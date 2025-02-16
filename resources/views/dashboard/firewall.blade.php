<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard of Firewall') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="container">
                    <div class="row">
                        <!-- Bar Chart: Top 5 Outbound Network Traffic -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Top 5 Outbound Network Traffic</div>
                                <div class="card-body">
                                    <canvas id="outboundTrafficChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Top 5 Outbound Countries -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Top 5 Outbound Countries</div>
                                <div class="card-body">
                                    <canvas id="outboundCountriesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- More Analytics -->
                    <div class="row mt-4">
                        <!-- Top Firewall Actions -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Top 5 Firewall Actions</div>
                                <div class="card-body">
                                    <ul>
                                        @foreach($topFirewallActions as $action)
                                            <li>{{ $action->action }} ({{ $action->action_count }} times)</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Top User Agents -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Top 5 User Agents</div>
                                <div class="card-body">
                                    <ul>
                                        @foreach($topUserAgents as $userAgent)
                                            <li>{{ $userAgent->user_agent }} ({{ $userAgent->user_agent_count }} times)</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- More Analytics -->
                    <div class="row mt-4">
                        <!-- Top Event Descriptions -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Top 5 Event Descriptions</div>
                                <div class="card-body">
                                    <ul>
                                        @foreach($topEventDescriptions as $event)
                                            <li>{{ $event->event_desc }} ({{ $event->event_count }} times)</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Top IP Source-Destination Pairs -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Top 5 IP Source-Destination Pairs</div>
                                <div class="card-body">
                                    <ul>
                                        @foreach($topIPPairs as $pair)
                                            <li>{{ $pair->ip_src }} → {{ $pair->ip_dst }} ({{ $pair->pair_count }} times)</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Top Severity Levels -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">Top 5 Severity Levels</div>
                                <div class="card-body">
                                    <ul>
                                        @foreach($topSeverityLevels as $severity)
                                            <li>{{ $severity->severity }} ({{ $severity->severity_count }} times)</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="footer text-center mt-4">
                    <p>&copy; 2025 Your Company | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .chart-container {
            max-width: 100%;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #666;
        }
    </style>
  <link href="{{ asset('js/bootstrap.min.css') }}" rel="stylesheet">
  <script src="{{ asset('js/chart.js') }}"></script>
  <canvas id="outboundTrafficChart"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>

        // Top 5 Outbound Network Traffic Chart
        const outboundTraffic = @json($topOutboundTraffic);
        const outboundTrafficLabels = outboundTraffic.map(item => `${item.ip_src} → ${item.ip_dst}`);
        const outboundTrafficCounts = outboundTraffic.map(item => item.traffic_count);

        new Chart(document.getElementById('outboundTrafficChart'), {
            type: 'bar',
            data: {
                labels: outboundTrafficLabels,
                datasets: [{
                    label: 'Outbound Traffic',
                    data: outboundTrafficCounts,
                    backgroundColor: '#ff6384',
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });


        // Top 5 Outbound Countries Chart
        const outboundCountries = @json($topOutboundCountries);
        const countryLabels = outboundCountries.map(item => item.country_src);
        const countryCounts = outboundCountries.map(item => item.outbound_count);

        new Chart(document.getElementById('outboundCountriesChart'), {
            type: 'bar',
            data: {
                labels: countryLabels,
                datasets: [{
                    label: 'Outbound Traffic by Country',
                    data: countryCounts,
                    backgroundColor: '#36a2eb',
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

    </script>
</x-app-layout>
