<?php

namespace App\Livewire\Store;

use App\Models\Book;
use Illuminate\View\View;
use Livewire\Component;

class FeaturedBooks extends Component
{
    /**
     * The maximum number of featured books to display.
     */
    public int $limit = 10;

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('livewire.store.featured-books', [
            'featuredBooks' => $this->getFeaturedBooks(),
        ]);
    }

    /**
     * Get featured books from the database.
     */
    protected function getFeaturedBooks()
    {
        return Book::featured()
            ->published()
            ->with('category')
            ->latest()
            ->limit($this->limit)
            ->get();
    }
}