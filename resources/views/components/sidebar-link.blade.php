<!-- resources/views/components/sidebar-link.blade.php -->
@props(['route', 'label', 'active' => false, 'icon'])

<a href="{{ $route }}"
   class="flex items-center px-4 py-3 text-gray-200 hover:bg-indigo-700 hover:text-white rounded-xl transition-all duration-200 group
          {{ $active ? 'bg-indigo-700 text-white' : '' }}">
    <span class="material-icons text-indigo-300 group-hover:text-white transition-colors duration-200">{{ $icon }}</span>
    <span class="ml-3 sidebar-text font-medium">{{ $label }}</span>
</a>
