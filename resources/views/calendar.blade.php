<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reuse existing styles from your code */
        :root {
            --primary-color: #4f46e5;
            --sidebar-width: 280px;
            --header-height: 70px;
            --border-color: #e5e7eb;
            --bg-color: #f9fafb;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Calendar specific styles */
        .calendar-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: calc(var(--header-height) + 2rem) auto 0;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .calendar-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
        }

        .calendar-nav {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .nav-btn {
            background: none;
            border: 1px solid var(--border-color);
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            color: #374151;
            transition: var(--transition);
        }

        .nav-btn:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: var(--border-color);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .calendar-weekday {
            background: #f8fafc;
            padding: 12px;
            text-align: center;
            font-weight: 500;
            color: #64748b;
        }

        .calendar-day {
            background: white;
            padding: 12px;
            min-height: 100px;
            position: relative;
        }

        .calendar-day.today {
            background: #eef2ff;
        }

        .calendar-day.different-month {
            background: #f8fafc;
            color: #94a3b8;
        }

        .date-number {
            position: absolute;
            top: 8px;
            right: 8px;
            font-size: 0.875rem;
            color: #64748b;
        }

        .event-dot {
            width: 8px;
            height: 8px;
            background: var(--primary-color);
            border-radius: 50%;
            margin-right: 4px;
            display: inline-block;
        }

        .event-list {
            margin-top: 24px;
            font-size: 0.875rem;
        }

        .event-item {
            padding: 4px;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--primary-color);
            cursor: pointer;
        }

        /* Sidebar styles from your existing code */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: white;
            border-right: 1px solid var(--border-color);
            transform: translateX(-100%);
            transition: var(--transition);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-logo {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-left: 0.75rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #374151;
            text-decoration: none;
            transition: var(--transition);
        }

        .menu-item:hover {
            background-color: #f3f4f6;
            color: var(--primary-color);
        }

        .menu-item i {
            width: 1.5rem;
            margin-right: 0.75rem;
        }

        /* Header styles from your existing code */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            z-index: 999;
        }

        .menu-trigger {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #374151;
            cursor: pointer;
            padding: 0.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .datetime {
            font-size: 0.875rem;
            color: #6b7280;
        }
    </style>
</head>
<body>
@include('sidebar') 

    <!-- Header -->
    <header class="header">
        <button class="menu-trigger" id="menuTrigger">
            <i class="fas fa-bars"></i>
        </button>
        <div class="user-info">
            <div class="datetime" id="datetime"></div>
            <i class="fas fa-user-circle"></i>
        </div>
    </header>

    <!-- Calendar Container -->
    <div class="calendar-container">
        <div class="calendar-header">
            <h2 class="calendar-title" id="currentMonth">November 2024</h2>
            <div class="calendar-nav">
                <button class="nav-btn" id="prevMonth">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="nav-btn" id="today">Today</button>
                <button class="nav-btn" id="nextMonth">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="calendar-grid" id="calendarGrid">
            <!-- Calendar will be generated here -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize variables
            const calendar = document.getElementById('calendarGrid');
            const monthDisplay = document.getElementById('currentMonth');
            const prevBtn = document.getElementById('prevMonth');
            const nextBtn = document.getElementById('nextMonth');
            const todayBtn = document.getElementById('today');
            const menuTrigger = document.getElementById('menuTrigger');
            const sidebar = document.querySelector('.sidebar');
            let currentDate = new Date();
            
            // Sample events data (you can replace this with your actual events)
            const events = {
                '2024-11-07': ['Team Meeting - 10:00 AM', 'Project Review - 2:00 PM'],
                '2024-11-15': ['Client Presentation - 11:00 AM'],
                '2024-11-20': ['Workshop - 9:00 AM', 'Training - 2:00 PM']
            };

            // Calendar generation function
            function generateCalendar(date) {
                const year = date.getFullYear();
                const month = date.getMonth();
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const startingDay = firstDay.getDay();
                const monthLength = lastDay.getDate();
                
                // Clear previous calendar
                calendar.innerHTML = '';

                // Add weekday headers
                const weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                weekdays.forEach(day => {
                    const weekdayCell = document.createElement('div');
                    weekdayCell.className = 'calendar-weekday';
                    weekdayCell.textContent = day;
                    calendar.appendChild(weekdayCell);
                });

                // Add days from previous month
                const prevMonth = new Date(year, month, 0);
                const prevMonthDays = prevMonth.getDate();
                for (let i = startingDay - 1; i >= 0; i--) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day different-month';
                    dayCell.innerHTML = `<span class="date-number">${prevMonthDays - i}</span>`;
                    calendar.appendChild(dayCell);
                }

                // Add days of current month
                for (let day = 1; day <= monthLength; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day';
                    
                    // Check if it's today
                    const today = new Date();
                    if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                        dayCell.classList.add('today');
                    }

                    dayCell.innerHTML = `<span class="date-number">${day}</span>`;

                    // Add events for this day
                    const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    if (events[dateString]) {
                        const eventList = document.createElement('div');
                        eventList.className = 'event-list';
                        events[dateString].forEach(event => {
                            const eventItem = document.createElement('div');
                            eventItem.className = 'event-item';
                            eventItem.innerHTML = `<span class="event-dot"></span>${event}`;
                            eventList.appendChild(eventItem);
                        });
                        dayCell.appendChild(eventList);
                    }

                    calendar.appendChild(dayCell);
                }

                // Update month display
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                monthDisplay.textContent = `${monthNames[month]} ${year}`;
            }

            // Navigation functions
            prevBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                generateCalendar(currentDate);
            });

            nextBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                generateCalendar(currentDate);
            });

            todayBtn.addEventListener('click', () => {
                currentDate = new Date();
                generateCalendar(currentDate);
            });

            // Sidebar toggle
            menuTrigger.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside
            document.addEventListener('click', (e) => {
                if (sidebar.classList.contains('active') && 
                    !sidebar.contains(e.target) && 
                    !menuTrigger.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            });

            // Update datetime in header
            function updateDateTime() {
                const now = new Date();
                const dateTimeString = now.toLocaleString('en-GB', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                document.getElementById('datetime').textContent = dateTimeString;
            }

            setInterval(updateDateTime, 1000);
            updateDateTime();

            // Initialize calendar
            generateCalendar(currentDate);
        });

        
    </script>
</body>
</html>