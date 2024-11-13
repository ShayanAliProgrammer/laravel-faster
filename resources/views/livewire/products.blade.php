<?php

use Livewire\Volt\Component;
use \App\Models\SubCategory;
use \App\Models\NestedSubCategory;
use \App\Models\Category;
use \App\Models\Product;

new class extends Component {
    public $products;
    public $nested_sub_category;
    public $category;
    public $sub_category;

    public function booted() {
        $this->products = Cache::remember('all-products-for-nested-sub-category:' . $this->nested_sub_category, 3600, fn () => Product::where('nested_sub_category_slug', $this->nested_sub_category->slug)->get(['name', 'slug', 'image', 'description']));
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
    </h1>

    <h2 class="text-xl lg:text-4xl md:text-2xl">{{ $nested_sub_category->name }}</h2>

    <div class="flex flex-wrap gap-5">
        @foreach ($products as $product)
            <a class="group flex min-h-[130px] w-full flex-row border px-4 py-2 hover:bg-gray-100 sm:w-[250px]" wire:navigate  href="{{ route('product', compact('category', 'sub_category', 'nested_sub_category', 'product')) }}">
                <div class="min-w-[40px] pt-1">
                    <img src="{{$product->image}}" width="40px" role="presentation" loading="lazy" decoding="async" fetchpriority="low" />
                </div>
                <div class="px-1"></div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium">{{ $product->name }}</p>
                    <p class="text-sm text-gray-500 line-clamp-3">{{ $product->description }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
