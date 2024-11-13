<?php

use Livewire\Volt\Component;
use \App\Models\SubCategory;
use \App\Models\NestedSubCategory;
use \App\Models\Category;
use \App\Models\Product;

new class extends Component {
    public $product;
    public $nested_sub_category;
    public $category;
    public $sub_category;

    public function booted() {
        $this->product = Cache::remember('product:' . $this->product, 3600, fn () => Product::where('slug', $this->product)->first());
    }

    public function mount($category, $sub_category, $nested_sub_category)
    {
        $category = Cache::remember('category:' .$category, 3600, fn () => Category::where('slug', $category)->get(['name', 'slug'])->first());
        if (!$category) {
            abort(404);
        }
        $sub_category = Cache::remember('sub-category:' .$sub_category, 3600, fn () => SubCategory::where('slug', $sub_category)->get(['name', 'slug'])->first());
        if (!$sub_category) {
            abort(404);
        }
        $nested_sub_category = Cache::remember('nested-sub-category:' .$nested_sub_category, 3600, fn () => NestedSubCategory::where('slug', $nested_sub_category)->get(['name', 'slug'])->first());
        if (!$nested_sub_category) {
            abort(404);
        }
        $this->category = $category;
        $this->sub_category = $sub_category;
        $this->nested_sub_category = $nested_sub_category;
    }
}; ?>

<div class="flex flex-col gap-5">
    <h1 class="flex items-center gap-2 text-base">
        <a href="{{ route('category', compact('category')) }}" wire:navigate  class="font-medium">
            {{ $category->name }}
        </a>

        <x-icon.chevrons-right class="text-gray-400 size-4" />

        <a href="{{ route('sub_category', compact('category', 'sub_category')) }}" wire:navigate  class="font-medium">
            {{ $sub_category->name }}
        </a>


        <x-icon.chevrons-right class="text-gray-400 size-4" />

        <a href="{{ route('nested_sub_category', compact('category', 'sub_category', 'nested_sub_category')) }}" wire:navigate  class="font-medium">
            {{ $nested_sub_category->name }}
        </a>
    </h1>

    <div class="grid max-w-4xl grid-cols-1 gap-5 lg:grid-cols-2">
        <img src="{{ $product->image }}" alt="{{ $product->image }}" fetchpriority="low" loading="lazy" decoding="async">

        <div class="flex flex-col gap-2">
            <h2 class="text-xl lg:text-4xl md:text-2xl">{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
        </div>
    </div>
</div>