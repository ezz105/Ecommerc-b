<x-layout>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <x-small-card />
        <x-small-card />
        <x-small-card />
        <x-small-card />

    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Revenue Overview - Line Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Revenue Overview</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">This Year</span>
                    <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                    <span class="text-sm text-gray-500">Last Year</span>
                    <div class="w-3 h-3 bg-blue-300 rounded-full"></div>
                </div>
            </div>
            <div class="relative h-[300px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Customer Growth - Bar Chart -->

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Customer Growth</h3>
                <select class="text-sm border-gray-200 rounded-lg focus:ring-indigo-500">
                    <option>Last 6 Months</option>
                    <option>Last 12 Months</option>
                </select>
            </div>
            <div class="relative h-[300px]">
                <canvas id="customerChart"></canvas>
            </div>
        </div>



        <!-- Transactions Growth - Area Chart -->

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Transactions Growth</h3>
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <span>Total: </span>
                    <span class="font-semibold text-indigo-600">23,542</span>
                </div>
            </div>
            <div class="relative h-[300px]">
                <canvas id="transactionChart"></canvas>
            </div>
        </div>



        <!-- Product Sales - Doughnut Chart -->

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Product Sales</h3>
                <div class="flex items-center space-x-2 text-sm">
                    <span class="text-gray-500">Total Sales:</span>
                    <span class="font-semibold text-indigo-600">$847,321</span>
                </div>
            </div>
            <div class="relative h-[300px]">
                <canvas id="productChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>
        <!-- Add activity list here -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</x-layout>
