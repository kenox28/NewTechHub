<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 flex-shrink-0 hidden md:block shadow-lg">
            <div class="p-4 text-2xl font-bold text-center border-b border-gray-700">
                Admin Panel
            </div>
            <nav class="mt-4">
                <button onclick="homepage()" class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
                    <i class="fas fa-home mr-3"></i>
                    <span>Home</span>
                </button>
                <button onclick="users()" class="flex items-center w-full px-4 py-3 bg-gray-700 transition-colors">
                    <i class="fas fa-users mr-3"></i>
                    <span>Users</span>
                </button>
                <button onclick="reports()" class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
                    <i class="fas fa-chart-bar mr-3"></i>
                    <span>Reports</span>
                </button>
                <button class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
                    <i class="fas fa-trophy mr-3"></i>
                    <span>LeaderBoards</span>
                </button>

                <button class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
                    <i class="fas fa-comment mr-3"></i>
                    <span>Feedbacks</span>
                </button>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="max-w-full mx-auto px-4 py-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <button class="md:hidden mr-4 text-gray-600">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold">User Management</h1>
                    </div>
                    <a href="#" class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded text-sm transition-colors">
                        Logout
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4">
                <!-- User Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-green-500">
                        <p class="text-gray-500 text-sm">Beginner Users</p>
                        <h1 id="beginner" class="text-3xl font-bold">0</h1>
                        <p class="text-green-500 text-xs mt-1"><i class="fas fa-user"></i> New users</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-500">
                        <p class="text-gray-500 text-sm">Intermediate Users</p>
                        <h1 id="intermediate" class="text-3xl font-bold">0</h1>
                        <p class="text-blue-500 text-xs mt-1"><i class="fas fa-user-check"></i> Active learners</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-purple-500">
                        <p class="text-gray-500 text-sm">Advanced Users</p>
                        <h1 id="advanced" class="text-3xl font-bold">0</h1>
                        <p class="text-purple-500 text-xs mt-1"><i class="fas fa-user-tie"></i> Dedicated users</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-yellow-500">
                        <p class="text-gray-500 text-sm">Expert Users</p>
                        <h1 id="expert" class="text-3xl font-bold">0</h1>
                        <p class="text-yellow-500 text-xs mt-1"><i class="fas fa-crown"></i> Platform masters</p>
                    </div>
                </div>

                <!-- User Search and Filter -->
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h2 class="text-lg font-semibold">User Management</h2>
                            <p class="text-sm text-gray-500">Manage all registered users</p>
                        </div>
                        <div class="flex flex-col md:flex-row gap-3">
                            <div class="relative">
                                <input type="text" id="searchUser" placeholder="Search users..." class="w-full md:w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <div class="absolute left-3 top-2.5 text-gray-400">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                            <button id="addUserBtn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                                <i class="fas fa-plus mr-2"></i> Add User
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Loading users...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Showing <span id="startCount">1</span> to <span id="endCount">10</span> of <span id="totalUsers">0</span> users
                    </div>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 bg-white border border-gray-300 rounded-md text-sm disabled:opacity-50">
                            Previous
                        </button>
                        <button class="px-3 py-1 bg-blue-600 text-white border border-blue-600 rounded-md text-sm">
                            1
                        </button>
                        <button class="px-3 py-1 bg-white border border-gray-300 rounded-md text-sm">
                            2
                        </button>
                        <button class="px-3 py-1 bg-white border border-gray-300 rounded-md text-sm">
                            3
                        </button>
                        <button class="px-3 py-1 bg-white border border-gray-300 rounded-md text-sm">
                            Next
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Add New User</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addUserForm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstName">
                        First Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstName" type="text" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastName">
                        Last Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastName" type="text" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" required>
                </div>
                <div class="flex items-center justify-end">
                    <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2" type="button" onclick="closeModal()">
                        Cancel
                    </button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Add User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/users.js"></script>
</body>
</html>