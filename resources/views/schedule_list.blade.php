
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        :root {
            --bg-primary: #f5f5f5;
            --bg-secondary: #ffffff;
            --text-primary: #333333;
            --text-secondary: #6b7280;
            --accent-color: #2563eb;
            --accent-hover: #1d4ed8;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] {
            --bg-primary: #1a1a1a;
            --bg-secondary: #2d2d2d;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --accent-color: #3b82f6;
            --accent-hover: #60a5fa;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            --card-shadow-hover: 0 4px 6px rgba(0, 0, 0, 0.4);
        }

        body {
            background-color: var(--bg-primary);
            padding: 2rem;
            color: var(--text-primary);
            transition: background-color 0.3s, color 0.3s;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .header h1 {
            font-size: 1.5rem;
            color: var(--text-primary);
        }

        .generate-pdf, .theme-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .generate-pdf:hover, .theme-toggle:hover {
            background-color: var(--accent-hover);
        }

        .event-card {
            background-color: var(--bg-secondary);
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: var(--card-shadow);
            transition: box-shadow 0.2s, background-color 0.3s;
        }

        .event-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .event-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .event-title {
            color: var(--accent-color);
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .event-day {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .event-datetime, .event-location {
            color: var(--text-secondary);
            margin-bottom: 0.25rem;
        }

        .pdf-icon {
            color: var(--text-secondary);
            cursor: pointer;
            transition: color 0.2s;
        }

        .pdf-icon:hover {
            color: var(--accent-color);
        }

        @media (max-width: 640px) {
            body {
                padding: 1rem;
            }
            
            .header-buttons {
                gap: 0.5rem;
            }

            .generate-pdf span, .theme-toggle span {
                display: none;
            }

            .generate-pdf, .theme-toggle {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Schedule List</h1>
            <div class="header-buttons">
                <button class="generate-pdf">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <span>Generate PDF</span>
                </button>
                <button class="theme-toggle">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    
                </button>
            </div>
        </div>

        <div class="event-card">
            <div class="event-header">
                <div>
                    <h2 class="event-title">Event Title 4</h2>
                    <p class="event-day">Monday</p>
                    <p class="event-datetime">Oct 14, 2024 | 10:00 AM - 12:00 PM</p>
                    <p class="event-location">Main Hall</p>
                </div>
                <svg class="pdf-icon" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
        </div>
    </div>

    <script>
        const themeToggle = document.querySelector('.theme-toggle');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
        
        // Set initial theme based on system preference
        if (prefersDark.matches) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', newTheme);
        });
    </script>
</body>
</html>