<?php

use Livewire\Volt\Component;
use \App\Models\SubCategory;
use \App\Models\Category;

new class extends Component {
    public $sub_categories;
    public $category;

    public function booted() {
        $this->sub_categories = Cache::remember('all-sub-categories-for-category:' . $this->category->slug, 3600, fn () => SubCategory::where('category_slug', $this->category->slug)->get());
    }

    public function mount($category)
    {
        $category = Cache::remember('category:' .$category, 3600, fn () => Category::where('slug', $category)->get(['name', 'slug'])->first());
        if (!$category) {
            abort(404);
        }
        $this->category = $category;
    }
}; ?>

<div class="flex flex-col gap-5">
    <h1 class="text-xl lg:text-4xl md:text-2xl">{{ $category->name }}</h1>

    <div class="flex flex-wrap gap-5">
        @foreach ($sub_categories as $sub_category)
            <a class="group flex min-h-[130px] w-full flex-row border px-4 py-2 hover:bg-gray-100 sm:w-[250px]" wire:navigate  href="{{ route('sub_category', compact('category', 'sub_category'))}}">
                <div class="min-w-[40px] pt-1">
                    <img src="{{$sub_category->image}}" width="40px" role="presentation" loading="lazy" decoding="async" fetchpriority="low" />
                </div>
                <div class="px-1"></div>
                <div class="flex flex-col gap-1">
                    <p class="font-medum">{{ $sub_category->name }}</p>
                    <p class="text-sm text-gray-500 line-clamp-3">{{ $sub_category->description }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
