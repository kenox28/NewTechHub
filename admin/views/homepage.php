<?php
session_start();
// if wala naka login para no error mo balik sa loginpage
if (!isset($_SESSION['userid'])) {
    header("location:/newDesignTechbook/login.php");
    exit();
}
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <button onclick="homepage()" class="flex items-center w-full px-4 py-3 bg-gray-700 transition-colors">
                    <i class="fas fa-home mr-3"></i>
                    <span>Home</span>
                </button>
                <button onclick="users()" class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
                    <i class="fas fa-users mr-3"></i>
                    <span>Users</span>
                </button>
                <button onclick="reports()" class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
                    <i class="fas fa-chart-bar mr-3"></i>
                    <span>Reports</span>
                </button>
                <button onclick="leaderboards()" class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
                    <i class="fas fa-trophy mr-3"></i>
                    <span>LeaderBoards</span>
                </button>

                <button onclick="feedback()" class="flex items-center w-full px-4 py-3 hover:bg-gray-700 transition-colors">
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
                        <h1 class="text-xl font-semibold">Admin Dashboard</h1>
                    </div>
                    <a href="#" id="logoutBtn" class="bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded text-sm transition-colors">
                        Logout
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4">
                <!-- Homepage Section -->


                <!-- Posts Section -->
                <section id="POST" class="space-y-4 hidden">
                    <!-- Content will be loaded here dynamically -->
                </section>

                <!-- Users Section -->
                <div id="users" class="hidden">
                    <!-- Stats Cards -->
                    <div id="alldiv" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="divact bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-500">
                            <p class="text-gray-500 text-sm">Beginner Users</p>
                            <h1 id="beginner" class="text-3xl font-bold"></h1>
                        </div>
                        <div class="divact bg-white p-4 rounded-lg shadow-md border-l-4 border-green-500">
                            <p class="text-gray-500 text-sm">Intermediate Users</p>
                            <h1 id="intermediate" class="text-3xl font-bold"></h1>
                        </div>
                        <div class="divact bg-white p-4 rounded-lg shadow-md border-l-4 border-yellow-500">
                            <p class="text-gray-500 text-sm">Advanced Users</p>
                            <h1 id="advanced" class="text-3xl font-bold"></h1>
                        </div>
                        <div class="divact bg-white p-4 rounded-lg shadow-md border-l-4 border-purple-500">
                            <p class="text-gray-500 text-sm">Expert Users</p>
                            <h1 id="expert" class="text-3xl font-bold"></h1>
                        </div>
                    </div>
                    
                    <!-- Users Table -->
                    <div id="divtable" class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold">User Management</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Firstname</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lastname</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                                    <!-- User data will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<script src="../js/Adminhome.js"></script>
</html>