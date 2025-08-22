# Security Log View System

<!-- Replace with your logo or relevant image -->

## 📌 Overview

The Security Log View System is a comprehensive application developed using **PHP (Laravel)** and **MySQL**. It automates the ingestion of CSV-formatted system logs, processes and stores the data in a structured database, and provides real-time analytics through an interactive dashboard. The system also features automated email notifications to alert users of potential security threats.

---

## ⚙️ Features

### Automated CSV Log Processing
- Reads and parses CSV files from designated folders.  
- Stores structured data in a MySQL database.  
- Supports multiple log types (e.g., Antivirus, Firewall, System logs).  
- Retains original CSV files for historical analysis.  

### Interactive Dashboard
- Built with **Chart.js** for data visualization.  
- Displays key metrics such as:  
  - Top failed login attempts  
  - Users logging in outside office hours  
  - Devices with antivirus alerts  
  - IP addresses generating the most traffic  

### Threat Detection & Email Alerts
- Monitors logs for suspicious activities.  
- Sends email notifications to administrators upon detecting potential threats.  

### Scalability & Flexibility
- Dynamically creates database tables based on CSV file names.  
- Supports various log formats and structures.  
- Facilitates historical log analysis for auditing and compliance.  

---

## 🛠️ Installation

### Prerequisites
- PHP >= 8.0  
- Composer  
- MySQL  
- Node.js (for frontend assets)  

### Steps
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/sauraavsarkar/Security-Log-View-System.git
   cd Security-Log-View-System
