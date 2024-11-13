<?php

use Livewire\Volt\Component;
use \App\Models\SubCategory;
use \App\Models\NestedSubCategory;
use \App\Models\Category;

new class extends Component {
    public $nested_sub_categories;
    public $category;
    public $sub_category;

    public function booted() {
        $this->nested_sub_categories = Cache::remember('all-nested-sub-categories-for-sub-category:' . $this->sub_category->slug, 3600, fn () => NestedSubCategory::where('sub_category_slug', $this->sub_category->slug)->get());
    }

    public function mount($category, $sub_category)
    {
        $category = Cache::remember('category:' .$category, 3600, fn () => Category::where('slug', $category)->get(['name', 'slug'])->first());
        if (!$category) {
            abort(404);
        }
        $sub_category = Cache::remember('sub-category:' .$sub_category, 3600, fn () => SubCategory::where('slug', $sub_category)->get(['name', 'slug'])->first());
        if (!$sub_category) {
            abort(404);
        }
        $this->category = $category;
        $this->sub_category = $sub_category;
    }
}; ?>

<div class="flex flex-col gap-5">
    <h1 class="flex items-center gap-2 text-base">
        <a href="{{ route('category', compact('category')) }}" wire:navigate  class="font-medium">
            {{ $category->name }}
        </a>
    </h1>

    <h2 class="text-xl lg:text-4xl md:text-2xl">{{ $sub_category->name }}</h2>

    <div class="flex flex-wrap gap-5">
        @foreach ($nested_sub_categories as $nested_sub_category)
            <a class="group flex min-h-[80px] w-full flex-row border px-4 py-2 hover:bg-gray-100 sm:w-[250px]" wire:navigate  href="{{ route('nested_sub_category', compact('category', 'sub_category', 'nested_sub_category')) }}">
                <div class="min-w-[40px] pt-1">
                    <img src="{{$nested_sub_category->image}}" width="40px" role="presentation" loading="lazy" decoding="async" fetchpriority="low" />
                </div>
                <div class="px-1"></div>
                <div class="flex flex-col gap-1">
                    <p class="font-medium">{{ $nested_sub_category->name }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
