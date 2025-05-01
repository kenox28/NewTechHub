<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Reports</title>
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
                <button onclick="users()" class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
                    <i class="fas fa-users mr-3"></i>
                    <span>Users</span>
                </button>
                <button onclick="reports()" class="flex items-center w-full px-4 py-3 bg-gray-700 transition-colors">
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
                        <h1 class="text-xl font-semibold">Reports Dashboard</h1>
                    </div>
                    <a href="#" class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded text-sm transition-colors">
                        Logout
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4">
                <!-- Posts Section - Hidden -->
                <section id="POST" class="space-y-4 hidden">
                    <!-- Content will be loaded here dynamically -->
                </section>

                <!-- Users Section - Hidden -->
                <div id="users" class="hidden">
                    <!-- Users content hidden -->
                </div>

                <!-- Reports Section -->
                <div id="reports" class="block">
                    <!-- Date Filter -->
                    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                        <h2 class="text-lg font-semibold mb-3">Filter Reports</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                                <input type="date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                                <input type="date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            </div>
                            <div class="flex items-end">
                                <button onclick="generateReport()" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors">
                                    <i class="fas fa-sync-alt mr-2"></i>Generate Report
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-500">
                            <p class="text-gray-500 text-sm">Total Users</p>
                            <h1 id="totalUsers" class="text-3xl font-bold">248</h1>
                            <p class="text-green-500 text-xs mt-1"><i class="fas fa-arrow-up"></i> 12% from last month</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-green-500">
                            <p class="text-gray-500 text-sm">New Posts</p>
                            <h1 id="newPosts" class="text-3xl font-bold">128</h1>
                            <p class="text-green-500 text-xs mt-1"><i class="fas fa-arrow-up"></i> 8% from last month</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-yellow-500">
                            <p class="text-gray-500 text-sm">User Engagement</p>
                            <h1 id="userEngagement" class="text-3xl font-bold">67%</h1>
                            <p class="text-red-500 text-xs mt-1"><i class="fas fa-arrow-down"></i> 3% from last month</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-purple-500">
                            <p class="text-gray-500 text-sm">Total Interactions</p>
                            <h1 id="totalInteractions" class="text-3xl font-bold">1.2k</h1>
                            <p class="text-green-500 text-xs mt-1"><i class="fas fa-arrow-up"></i> 18% from last month</p>
                        </div>
                    </div>
                    
                    <!-- User Growth Chart -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <h2 class="text-lg font-semibold mb-4">User Growth</h2>
                            <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
                                <!-- Placeholder for chart -->
                                <div class="text-center text-gray-500">
                                    <i class="fas fa-chart-line text-4xl mb-3"></i>
                                    <p>User growth chart will appear here</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Post Activity Chart -->
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <h2 class="text-lg font-semibold mb-4">Post Activity</h2>
                            <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
                                <!-- Placeholder for chart -->
                                <div class="text-center text-gray-500">
                                    <i class="fas fa-chart-bar text-4xl mb-3"></i>
                                    <p>Post activity chart will appear here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Reports Table -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-lg font-semibold">Recent Reports</h2>
                            <button class="text-blue-600 hover:text-blue-800 text-sm">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Report ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reporter</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="reportsTableBody" class="bg-white divide-y divide-gray-200">
                                    <!-- Sample report data -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#RP-2301</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Post</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Inappropriate content</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2025-04-28</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">Review</button>
                                            <button class="text-red-600 hover:text-red-900">Delete</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#RP-2302</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">User</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Harassment</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jane Smith</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2025-04-29</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Resolved</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">Review</button>
                                            <button class="text-red-600 hover:text-red-900">Delete</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#RP-2303</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Comment</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Spam</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Mike Johnson</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2025-04-30</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Rejected</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">Review</button>
                                            <button class="text-red-600 hover:text-red-900">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="/admin/js/report.js?v=1.0.1"></script>
</body>
</html>