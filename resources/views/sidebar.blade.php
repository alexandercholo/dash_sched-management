<!-- resources/views/sidebar.blade.php -->
<div class="sidebar-overlay" id="sidebarOverlay">
    <aside class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-chart-line"></i>
            <span class="logo-text">Dashboard</span>
        </div>
        <nav>
            <a href="{{ route('dashboard') }}" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="announcement_request.html" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
            <a href="{{ route('schedule-list') }}" class="menu-item">
                <i class="fas fa-list"></i>
                <span>Schedule List</span>
            </a>
            <a href="{{ route('calendar') }}" class="menu-item">
                <i class="fas fa-calendar"></i>
                <span>Schedule Viewer</span>
            </a>
            <a href="#" class="menu-item" id="createRequestBtn">
                <i class="fas fa-edit"></i>
                <span>Create Request</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-bullhorn"></i>
                <span>Announcements List</span>
            </a>
            <a href="{{ route('announcements.view') }}" class="menu-item">
                <i class="fas fa-eye"></i>
                <span>Announcements View</span>
            </a>
            <a href="announcement_request.html" class="menu-item">
                <i class="fas fa-edit"></i>
                <span>Create Announcement</span>
            </a>
            <a href="{{ route('staff.add') }}" class="menu-item">
    <i class="fas fa-user-tie"></i> <!-- Represents business or staff -->
    <span>Staff</span>
</a>

        </nav>
    </aside>
</div>