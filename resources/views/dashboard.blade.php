<x-app-layout>

    <div class="py-12">
            <html lang="en" class="light-theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Management Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<link href="dashboard.css" rel="stylesheet">
<body>
    <div id="notification-container"></div>

    <div class="dashboard">
        <nav class="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <span>LOG MANAGEMENT</span>
            </div>
            <ul class="nav-links">
                <li class="active" data-section="dashboard" data-content="dashboard-content">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                    <div class="nav-indicator"></div>
                </li>
                <li data-section="analytics" data-content="analytics-content">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                    <div class="nav-indicator"></div>
                </li>
                <li data-section="projects" data-content="projects-content">
                    <i class="fas fa-project-diagram"></i>
                    <span>Types of Logs</span>
                    <div class="nav-indicator"></div>
                </li>
                <li data-section="messages" data-content="messages-content">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                    <div class="nav-indicator"></div>
                    <span class="badge">5</span>
                </li>
                <li data-section="settings" data-content="settings-content">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                    <div class="nav-indicator"></div>
                </li>
            </ul>
        </nav>

        <main class="main-content">
            <header>
                <div class="header-left">
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search anything...">
                    </div>
                </div>
                <div class="header-right">
                    <div class="notifications">
                        <div class="notification-trigger">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </div>
                        <div class="notifications-dropdown">
                            <div class="notifications-header">
                                <div class="header-left">
                                    <h3 class="notifications-title">Notifications</h3>
                                    <span class="mark-all">Mark all read</span>
                                </div>
                                <button class="settings-btn">
                                    <i class="fas fa-cog"></i>
                                    Settings
                                </button>
                            </div>
                            <div class="filter-pills">
                                <span class="filter-pill active">All</span>
                                <span class="filter-pill">Unread</span>
                                <span class="filter-pill">Important</span>
                            </div>
                            <div class="notification-list">
                            </div>
                            <div class="dropdown-footer">
                                <button class="filter-button">
                                    <i class="fas fa-clock"></i>
                                    Last 7 days
                                </button>
                                <button class="filter-button">
                                    <i class="fas fa-filter"></i>
                                    Filter
                                </button>
                                <a href="#" class="view-all">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="profile">
                        <div class="profile-trigger">
                            <div class="profile-avatar">
                            <span class="avatar-text">
                            <i class="fa fa-user" aria-hidden="true" style="color: white; font-size: 24px;"></i>
                            </span>

                            </div>
                            <div class="profile-info">
                                <span class="profile-name">{{ Auth::user()->name }}</span>
                                <span class="profile-role">Administrator</span>
                            </div>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="profile-dropdown">
                            <div class="dropdown-header">
                                <div class="header-avatar">
                                    <span class="avatar-text">
                                    <i class="fa fa-user" aria-hidden="true" style="color: white; font-size: 24px;"></i>
                                    </span>
                                </div>
                                <div class="header-info">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="dropdown-menu">
                            <li>
                                <x-dropdown-link :href="route('profile.edit')">
                                    <i class="fas fa-user"></i>
                                    <span>{{ __('My Profile') }}</span>
                                </x-dropdown-link>
                            </li>

                                <li>
                                    <i class="fas fa-cog"></i>
                                    <span>Settings</span>
                                </li>
                                <li>
                                    <i class="fas fa-palette"></i>
                                    <span>Theme</span>
                                    <label class="theme-switch">
                                        <input type="checkbox" id="theme-toggle">
                                        <span class="switch-slider"></span>
                                    </label>
                                </li>
                                <li>
                                    <i class="fas fa-bell"></i>
                                    <span>Notifications</span>
                                </li>
                            </ul>
                            <div class="dropdown-divider"></div>
                            <ul class="dropdown-menu">
                            <li class="logout">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" 
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </x-dropdown-link>
                                </form>
                            </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <div id="dashboard-content" class="content-section active">
                <div class="dashboard-grid">
                    <div class="stats-container">
                        <div class="stat-card glow">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-details">
                                <h3>Total Users</h3>
                                <p class="counter" data-target="15423">0</p>
                                <span class="trend positive">+12.5%</span>
                            </div>
                        </div>
                        <div class="stat-card glow">
                            <div class="stat-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-details">
                                <h3>Antivirus</h3>
                                <p class="counter" data-target="84591">0</p>
                                <span class="trend positive">+8.2%</span>
                            </div>
                        </div>
                        <div class="stat-card glow">
                            <div class="stat-icon">
                                <i class="fa fa-cogs"></i>
                            </div>
                            <div class="stat-details">
                                <h3>Firewall</h3>
                                <p class="counter" data-target="24895">0</p>
                                <span class="trend negative">-2.4%</span>
                            </div>
                        </div>
                        <div class="stat-card glow">
                            <div class="stat-icon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <div class="stat-details">
                                <h3>Total Block</h3>
                                <p class="counter" data-target="1287">0</p>
                                <span class="trend positive">+5.7%</span>
                            </div>
                        </div>
                    </div>
                    <div class="charts-container">
                        <div class="chart-card glow">
                            <div class="revenue-header">
                                <h2>Revenue Analytics</h2>
                                <select class="revenue-filter">
                                    <option value="1">Last 24 Hours</option>
                                    <option value="7" selected>Last 7 Days</option>
                                    <option value="30">Last 30 Days</option>
                                    <option value="90">Last 90 Days</option>
                                    <option value="365">Last Year</option>
                                </select>
                            </div>
                            <div id="revenueChart"></div>
                        </div>
                        <div class="chart-card glow">
                            <div class="chart-header">
                                <h3>User Activity</h3>
                                <div class="chart-actions">
                                    <div class="legend">
                                        <span class="legend-item">
                                            <span class="dot new"></span> New Users
                                        </span>
                                        <span class="legend-item">
                                            <span class="dot returning"></span> Returning
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="userActivityChart"></div>
                        </div>
                    </div>

                    <div class="activity-card glow">
                        <div class="activity-header">
                            <h2>Recent Activity</h2>
                            <button class="filter-button">
                                <i class="fas fa-filter"></i>
                                Filter
                            </button>
                        </div>
                        <div class="activity-list" id="activityList"></div>
                    </div>
                </div>
            </div>

            <div id="analytics-content" class="content-section">
                <div class="section-header">
                <h2 style="color: #4361ee; font-size: 32px; text-align: center;">Analytics Overview</h2>
                </div>
                <div class="analytics-grid">
                    <div class="analytics-card">
                        <div id="salesTrendChart"></div>
                    </div>
                    <div class="analytics-card">
                        <div id="conversionChart"></div>
                    </div>
                    <div class="analytics-metrics">
                        <div class="metric-card">
                            <i class="fas fa-users"></i>
                            <div class="metric-info">
                                <h3>Total Users</h3>
                                <span class="counter" data-target="15423">0</span>
                                <p class="trend positive">+12.5% <span>vs last month</span></p>
                            </div>
                        </div>
                        <div class="metric-card">
                            <i class="fa fa-cogs"></i>
                            <div class="metric-info">
                                <h3>Firewall</h3>
                                <span class="counter" data-target="8745">0</span>
                                <p class="trend positive">+8.2% <span>vs last month</span></p>
                            </div>
                        </div>
                        <div class="metric-card">
                            <i class="fas fa-chart-line"></i>
                            <div class="metric-info">
                                <h3>Antivirus</h3>
                                <span class="counter" data-target="452680">$0</span>
                                <p class="trend positive">+15.8% <span>vs last month</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="projects-content" class="content-section">
                <div class="section-header">
                    <h2 style="color: #4361ee; font-size: 32px; text-align: center;">Types of Logs</h2>

                </div>
                <div class="projects-grid">
                    <div class="project-card">
                        <div class="project-header">
                            <h3>Antivirus</h3>
                            <span class="status in-progress">Normal</span>
                        </div>
                        <p>Blocked due to category Advertisements & Pop-Ups</p>
                        <div class="project-meta">
                            <div class="team-members">
                                <img src="https://ui-avatars.com/api/?name=John+Doe&background=6d5acd&color=fff" alt="Team Member">
                                <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=4361ee&color=fff" alt="Team Member">
                                <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=2ed573&color=fff" alt="Team Member">
                            </div>
                            <div class="project-progress">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 75%"></div>
                                </div>
                                <span>75%</span>
                            </div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-header">
                            <h3>Firewall</h3>
                            <span class="status pending">Dangerous</span>
                        </div>
                        <p>Controlled application detected: Anydesk (Remote management tool)</p>
                        <div class="project-meta">
                            <div class="team-members">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Wilson&background=ffa502&color=fff" alt="Team Member">
                                <img src="https://ui-avatars.com/api/?name=Tom+Brown&background=ff4757&color=fff" alt="Team Member">
                            </div>
                            <div class="project-progress">
                                <div class="progress-bar">
                                    <div class="progress" style="width: 30%"></div>
                                </div>
                                <span>30%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="messages-content" class="content-section">
                <div class="section-header">
                    <h2 style="color: #4361ee; font-size: 32px; text-align: center;">Messages</h2>

                    <p>Your communications hub</p>
                </div>
                <div class="messages-container">
                    <div class="message-list">
                        <div class="message-item unread">
                            <img src="https://i.pinimg.com/736x/55/f4/3d/55f43de2412ad3f18fe90fac70c6472a.jpg" alt="Sarah Wilson">
                            <div class="message-content">
                                <div class="message-header">
                                    <h4>Abcd Ef Ghi</h4>
                                    <span>2 hours ago</span>
                                </div>
                                <p>Hey,You Blocked due to category Advertisements & Pop-Ups.</p>
                            </div>
                        </div>
                        <div class="message-item">
                            <img src="https://t4.ftcdn.net/jpg/09/37/38/41/360_F_937384196_iRHCkO9J81FruMLD0wlpw6hSeF1UOboG.jpg" alt="Mike Johnson">
                            <div class="message-content">
                                <div class="message-header">
                                    <h4>Dsa Qrew</h4>
                                    <span>5 hours ago</span>
                                </div>
                                <p>Hey,Your Controlled application detected: Anydesk (Remote management tool)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="settings-content" class="content-section">
                <div class="section-header">
                    <h2 style="color: #4361ee; font-size: 32px; text-align: center;">Settings</h2>

                    <p>Customize your dashboard experience</p>
                </div>
                <div class="settings-grid">
                    <div class="settings-card">
                        <h3>Theme Preferences</h3>
                        <div class="setting-option">
                            <span>Dark Mode</span>
                            <label class="switch">
                                <input type="checkbox" id="theme-toggle" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="setting-option">
                            <span>Compact View</span>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="settings-card">
                        <h3>Notifications</h3>
                        <div class="setting-option">
                            <span>Email Notifications</span>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="setting-option">
                            <span>Push Notifications</span>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>


            </div>
     
</x-app-layout>
