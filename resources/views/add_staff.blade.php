<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .modal-backdrop, .modal-content {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .modal-backdrop.show {
            opacity: 1;
        }
        .modal-content.show {
            transform: scale(1);
            opacity: 1;
        }
        .modal-content.hidden {
            transform: scale(0.9);
            opacity: 0;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen p-6">
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
                    <p class="text-sm text-gray-500">Manage and monitor user accounts</p>
                </div>
                <button onclick="openModal('addUserModal')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>Add New User
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center flex-wrap gap-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Search users..." 
                           oninput="handleSearch(event)"
                           class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div class="flex gap-2">
                    <select class="border rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>All Roles</option>
                        <option>Administrator</option>
                        <option>Author</option>
                    </select>
                    <select class="border rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Sort By</option>
                        <option>Name</option>
                        <option>Date Created</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left bg-gray-50">
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">College(s)</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date Created</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-medium">A</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">Admin</div>
                                        <div class="text-sm text-gray-500">Admin@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">CAS</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800"></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Administrator</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">Sep 28, 2022</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="openModal('editUserModal')" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openModal('deleteUserModal')" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div id="addUserModal" class="modal hidden">
        <div class="modal-backdrop fixed inset-0 bg-gray-600 bg-opacity-50 hidden"></div>
        <div class="modal-content bg-white rounded-lg p-6 mx-auto mt-20 shadow-md hidden">
            <h2 class="text-lg font-semibold mb-4">Add New User</h2>
            <!-- Form fields here -->
            <button onclick="closeModal('addUserModal')" class="mt-4 bg-gray-300 px-4 py-2 rounded">Close</button>
        </div>
    </div>

    <div id="editUserModal" class="modal hidden">
        <div class="modal-backdrop fixed inset-0 bg-gray-600 bg-opacity-50 hidden"></div>
        <div class="modal-content bg-white rounded-lg p-6 mx-auto mt-20 shadow-md hidden">
            <h2 class="text-lg font-semibold mb-4">Edit User</h2>
            <!-- Form fields here -->
            <button onclick="closeModal('editUserModal')" class="mt-4 bg-gray-300 px-4 py-2 rounded">Close</button>
        </div>
    </div>

    <div id="deleteUserModal" class="modal hidden">
        <div class="modal-backdrop fixed inset-0 bg-gray-600 bg-opacity-50 hidden"></div>
        <div class="modal-content bg-white rounded-lg p-6 mx-auto mt-20 shadow-md hidden">
            <h2 class="text-lg font-semibold mb-4">Delete User</h2>
            <p>Are you sure you want to delete this user? This action cannot be undone.</p>
            <button onclick="closeModal('deleteUserModal')" class="mt-4 bg-gray-300 px-4 py-2 rounded">Cancel</button>
            <button class="mt-4 bg-red-600 text-white px-4 py-2 rounded">Delete</button>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const backdrop = modal.querySelector('.modal-backdrop');
            const content = modal.querySelector('.modal-content');

            backdrop.classList.remove('hidden');
            content.classList.remove('hidden', 'hidden');
            backdrop.classList.add('show');
            content.classList.add('show');
            modal.classList.remove('hidden');

            document.addEventListener('click', (e) => {
                if (e.target === backdrop) closeModal(modalId);
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal(modalId);
            });
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const backdrop = modal.querySelector('.modal-backdrop');
            const content = modal.querySelector('.modal-content');

            backdrop.classList.remove('show');
            content.classList.remove('show');
            setTimeout(() => {
                backdrop.classList.add('hidden');
                content.classList.add('hidden');
                modal.classList.add('hidden');
            }, 300);  // Timeout matches the transition duration for smooth exit
        }

        function handleSearch(event) {
            const query = event.target.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            
            rows.forEach(row => {
                const name = row.querySelector('td:first-child').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                
                if (name.includes(query) || email.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>