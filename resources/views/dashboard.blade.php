<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
</head>
<body>
    <div class="container">
        <h1 class="text-center text-primary mb-4">System Log Dashboard</h1>

        <div class="row">
            <!-- Pie Chart: Log Type Distribution -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Log Type Distribution</div>
                    <div class="card-body">
                        <canvas id="logTypeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Bar Chart: Top 5 Failed Logins -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Top 5 Failed Logins</div>
                    <div class="card-body">
                        <canvas id="failedLoginChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart: Top Traffic IPs -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Top 5 Traffic IPs</div>
                    <div class="card-body">
                        <canvas id="trafficIpChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- After Office Hours Users -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Users Logged In After Office Hours</div>
                    <div class="card-body">
                        <ul>
                            @foreach($afterOfficeUsers as $user)
                                <li>{{ $user->username }} logged in at {{ $user->time }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Antivirus Alerts -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Top Antivirus Alerts</div>
                    <div class="card-body">
                        <canvas id="antivirusAlertChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Your Company | All Rights Reserved</p>
    </div>

    <script>
        // Pie Chart: Log Type Distribution
        const logTypeData = @json($logTypeCount);
        const logTypeLabels = logTypeData.map(item => item.log_type);
        const logTypeCounts = logTypeData.map(item => item.count);

        new Chart(document.getElementById('logTypeChart'), {
            type: 'pie',
            data: {
                labels: logTypeLabels,
                datasets: [{
                    data: logTypeCounts,
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'],
                }]
            }
        });

        // Bar Chart: Top 5 Failed Logins
        const failedLogins = @json($topFailedLogins);
        const failedLoginLabels = failedLogins.map(item => item.username);
        const failedLoginCounts = failedLogins.map(item => item.count);

        new Chart(document.getElementById('failedLoginChart'), {
            type: 'bar',
            data: {
                labels: failedLoginLabels,
                datasets: [{
                    label: 'Failed Logins',
                    data: failedLoginCounts,
                    backgroundColor: '#ff6384',
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Line Chart: Top 5 Traffic IPs
        const trafficIps = @json($topTrafficIps);
        const trafficIpLabels = trafficIps.map(item => item.ip_src);
        const trafficIpCounts = trafficIps.map(item => item.count);

        new Chart(document.getElementById('trafficIpChart'), {
            type: 'line',
            data: {
                labels: trafficIpLabels,
                datasets: [{
                    label: 'Traffic',
                    data: trafficIpCounts,
                    borderColor: '#36a2eb',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2
                }]
            }
        });

        // Bar Chart: Antivirus Alerts
        const antivirusAlerts = @json($topAntivirusAlerts);
        const antivirusHostLabels = antivirusAlerts.map(item => item.host_dst);
        const antivirusCounts = antivirusAlerts.map(item => item.count);

        new Chart(document.getElementById('antivirusAlertChart'), {
            type: 'bar',
            data: {
                labels: antivirusHostLabels,
                datasets: [{
                    label: 'Alerts',
                    data: antivirusCounts,
                    backgroundColor: '#ffcd56',
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
