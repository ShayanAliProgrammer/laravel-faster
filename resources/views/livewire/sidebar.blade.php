<?php

use Livewire\Volt\Component;
use \App\Models\Category;
use Illuminate\Support\Facades\Cache;

new class extends Component {
    public $categories;

    public function booted() {
        $this->categories = Cache::remember('all-categories-name-and-slug', 3600, fn () => Category::all(['name', 'slug']));
    }

    public function placeholder() {
        return view('livewire.sidebar-placeholder');
    }
}; ?>

<aside class="w-full max-w-xs lg:p-3 flex flex-col border-r lg:min-h-[70vh] h-max" x-data="{ open: false }">
    <button class="px-4 py-2 border-0 border-b lg:border hover:bg-gray-100" x-on:click="open=!open">
        Toggle Links
    </button>

    <div class="flex flex-col items-center p-3" x-bind:class="{ 'hidden': open }">
        <div class="flex flex-col">
            <p class="mb-4 font-medium">Categories</p>

            @foreach ($categories as $category)
                <a class="p-1.5 border-b hover:underline hover:bg-gray-100" href="{{ route('category', $category->slug) }}" wire:navigate  wire:key="category-{{ $category->slug }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</aside>
