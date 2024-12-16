<x-layout>

    <x-slot name="title">
        Manage Products
    </x-slot>


    <x-panel>
        <div>
            <x-heading>Manage Products</x-heading>
            <x-sub-heading>You can manage your products here</x-sub-heading>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            <!-- Add Export Button -->
            <x-button type="secondary" href="#" icon="upload">
                Export
            </x-button>

            <!-- Add Product Button -->
            <x-button type="primary" href="products.create" icon="add">
                Add Product
            </x-button>


        </div>
    </x-panel>



    <!-- Search and Filters -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-6">
        <!-- Search Box -->
        <div class="lg:col-span-5">
            <div class="relative">
                <input type="text" placeholder="Search products..."
                    class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Filters -->
        <div class="lg:col-span-7 flex flex-col sm:flex-row gap-3 items-start sm:items-center sm:justify-end">
            <select
                class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>All Categories</option>
                <option>Electronics</option>
                <option>Clothing</option>
                <option>Food</option>
            </select>

            <select
                class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>All Status</option>
                <option>Active</option>
                <option>Inactive</option>
                <option>Out of Stock</option>
            </select>

            <select
                class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option>Sort by</option>
                <option>Newest First</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
            </select>
        </div>
    </div>


    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                <div class="relative">
                    <div class="h-48 rounded-t-xl bg-gray-200"></div>
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 text-sm rounded-full
                                {{ $product->status == 'active' ? 'bg-green-100 text-green-800' :
            ($product->status == 'inactive' ? 'bg-red-100 text-red-800' :
                'bg-gray-100 text-gray-800') }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-2xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
                        <span class="text-sm text-gray-500">Stock: {{ $product->stock_quantity }}</span>
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="flex-1 px-4 py-2 text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors text-center">
                            Edit
                        </a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="w-10 h-10 flex items-center justify-center text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-10">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Edit Product
                                </a>
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    View Details
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        Delete Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    <!-- Pagination -->
    <x-pagination :items="$products" />
</x-layout>
