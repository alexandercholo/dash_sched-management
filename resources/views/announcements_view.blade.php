<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Announcements</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, sans-serif;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        /* Theme Variables */
        html[data-theme="light"] {
            --bg-color: #fff9e6;
            --card-bg: #ffffff;
            --text-color: #333333;
            --border-color: #e0e0e0;
            --accent-color: #4CAF50;
            --secondary-bg: #f5f5f5;
            --muted-text: #666666;
            --badge-bg: rgba(0, 0, 0, 0.05);
        }

        html[data-theme="dark"] {
            --bg-color: #1a1a1a;
            --card-bg: #242424;
            --text-color: #e0e0e0;
            --border-color: #333333;
            --accent-color: #4CAF50;
            --secondary-bg: #2a2a2a;
            --muted-text: #888888;
            --badge-bg: rgba(255, 255, 255, 0.05);
        }

        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-color);
        }

        .slideshow-container {
            width: 100%;
            max-width: 800px;
            position: relative;
            padding: 20px;
            padding-bottom: 60px;
        }

        .announcement {
            display: none;
            animation: fadeEffect 1s;
            padding: 20px;
            background-color: transparent;
            border-radius: 24px;
        }

        @keyframes fadeEffect {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .department-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: transparent;
            padding: 7px 10px;
            border-radius: 50px;
            width: fit-content;
            margin-bottom: 16px;
            border: 1px solid var(--accent-color);
        }

        .department-badge img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: var(--secondary-bg);
        }

        .announcement-content {
            background-color: var(--secondary-bg);
            padding: 20px;
            border-radius: 20px;
            margin: 20px 0;
            font-size: 16px;
            line-height: 1.6;
            border: 1px solid var(--border-color);
        }

        .announcement-title {
            font-size: 20px;
            font-weight: 600;
            margin: 16px 0;
            padding-left: 20px;
            color: var(--accent-color);
        }

        .meta-info {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 16px;
            margin-top: 16px;
        }

        .posted-date {
            color: var(--muted-text);
        }

        .priority-badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
        }

        html[data-theme="light"] .priority-high {
            background-color: #ffe4e4;
            color: #ff4444;
            border: 1px solid #ff4444;
        }

        html[data-theme="light"] .priority-medium {
            background-color: #fff3e0;
            color: #ff9800;
            border: 1px solid #ff9800;
        }

        html[data-theme="light"] .priority-low {
            background-color: #e4ffe4;
            color: #44aa44;
            border: 1px solid #44aa44;
        }

        html[data-theme="dark"] .priority-high {
            background-color: #2c1f1f;
            color: #ff6b6b;
            border: 1px solid #ff4444;
        }

        html[data-theme="dark"] .priority-medium {
            background-color: #2c261f;
            color: #ffd166;
            border: 1px solid #ff9800;
        }

        html[data-theme="dark"] .priority-low {
            background-color: #1f2c1f;
            color: #4CAF50;
            border: 1px solid #44aa44;
        }

        .media-container {
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .media-container img,
        .media-container video {
            width: 100%;
            height: auto;
            display: block;
        }

        .dots-container {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: transparent;
            padding: 10px 20px;
            border-radius: 50px;
            z-index: 1000;
        }

        .dot {
            height: 10px;
            width: 10px;
            margin: 0 5px;
            background-color: var(--border-color);
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dot.active {
            background-color: var(--accent-color);
        }

        /* Theme Toggle Switch */
        .theme-switch {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .theme-switch-button {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            padding: 8px 16px;
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .theme-switch-button:hover {
            background-color: var(--secondary-bg);
        }

        @media (max-height: 700px) {
            .dots-container {
                position: static;
                transform: none;
                margin-top: 20px;
            }
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
    </style>
</head>
<body>

@include('sidebar') 

    <div class="theme-switch">
        <button class="theme-switch-button" onclick="toggleTheme()">
            <span class="theme-icon">🌓</span>
        </button>
    </div>

    <div class="slideshow-container">
        <!-- Announcement 1 -->
        <div class="announcement">
            <div class="department-badge">
                <img src="img/images.jpg" alt="department icon">
                <span>Bachelor of Performing Arts</span>
            </div>

            <div class="announcement-title">End of Semester Exhibition</div>

            <div class="announcement-content">
                Join us for the end of semester exhibition showcasing student works from the Bachelor of Performing Arts program. The exhibition will feature performances, installations, and interactive displays.
                
                <div class="media-container">
                    <video autoplay muted loop playsinline>
                        <source src="img/0211 (1)(1).mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>

            <div class="meta-info">
                <span class="posted-date">Posted: Oct 23, 2024</span>
                <span class="priority-badge priority-high">High Priority</span>
            </div>
        </div>

        <!-- Announcement 2 -->
        <div class="announcement">
            <div class="department-badge">
                <img src="img/images.jpg" alt="department icon">
                <span>Bachelor of Performing Arts</span>
            </div>

            <div class="announcement-title">Library Hours Update</div>

            <div class="announcement-content">
                The library will have extended hours during the final examination period. New hours: Monday-Friday 7AM-11PM, Saturday-Sunday 9AM-9PM.
            </div>

            <div class="meta-info">
                <span class="posted-date">Posted: Oct 23, 2024</span>
                <span class="priority-badge priority-low">Low Priority</span>
            </div>
        </div>

        <!-- Announcement 3 -->
        <div class="announcement">
            <div class="department-badge">
                <img src="img/images.jpg" alt="department icon">
                <span>Bachelor of Performing Arts</span>
            </div>

            <div class="announcement-title">Guest Artist Workshop Series</div>

            <div class="announcement-content">
                Join us for the end of semester exhibition showcasing student works from the Bachelor of Performing Arts program. The exhibition will feature performances, installations, and interactive displays.
                
                <div class="media-container">
                    <video autoplay muted loop playsinline>
                        <source src="img/0709(1).mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>

            <div class="meta-info">
                <span class="posted-date">Posted: Oct 23, 2024</span>
                <span class="priority-badge priority-high">High Priority</span>
            </div>
        </div>

        <!-- Announcement 4 -->
        <div class="announcement">
            <div class="department-badge">
                <img src="img/images.jpg" alt="department icon">
                <span>Bachelor of Performing Arts</span>
            </div>

            <div class="announcement-title">Equipment Room Policy Update</div>

            <div class="announcement-content">
                Starting November 1st, all equipment borrowing must be done through our new online booking system. Please attend one of our training sessions to learn how to use the new system. Sessions will be held every Tuesday and Thursday at 2PM in Room 301.
            </div>

            <div class="meta-info">
                <span class="posted-date">Posted: Oct 23, 2024</span>
                <span class="priority-badge priority-medium">Medium Priority</span>
            </div>
        </div>

        <!-- Announcement 5 -->
        <div class="announcement">
            <div class="department-badge">
                <img src="img/images.jpg" alt="department icon">
                <span>Bachelor of Performing Arts</span>
            </div>

            <div class="announcement-title">Winter Showcase Auditions</div>

            <div class="announcement-content">
                Join us for the end of semester exhibition showcasing student works from the Bachelor of Performing Arts program. The exhibition will feature performances, installations, and interactive displays.
                
                <div class="media-container">
                    <video autoplay muted loop playsinline>
                        <source src="img/0626 (1).mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="meta-info">
                <span class="posted-date">Posted: Oct 23, 2024</span>
                <span class="priority-badge priority-high">High Priority</span>
            </div>
        </div>
    </div>

    <div class="dots-container">
        <span class="dot active" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
    </div>

    <script>
        // Sidebar functionality removed

        const slides = document.querySelectorAll('.announcement');
        let slideIndex = 1;
        showSlides(slideIndex);

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let slides = document.getElementsByClassName("announcement");
            let dots = document.getElementsByClassName("dot");

            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }

            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
                dots[i].className = dots[i].className.replace(" active", "");
            }

            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            const menuTrigger = document.getElementById('menuTrigger');
            const sidebar = document.querySelector('.sidebar');
            html.setAttribute('data-theme', newTheme);
            
            // Save theme preference
            localStorage.setItem('theme', newTheme);
        }

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme ');
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
        }

        setInterval(() => {
            slideIndex++;
            showSlides(slideIndex);
        }, 10000);

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
    </script>
</body>
</html>