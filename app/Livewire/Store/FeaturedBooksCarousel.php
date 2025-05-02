<?php

namespace App\Livewire\Store;

use App\Models\Book;
use Livewire\Component;

class FeaturedBooksCarousel extends Component
{
    public $featuredBooks;
    public $activeIndex = 0;
    public $autoSlide = true;
    public $slideInterval = 5000; // 5 seconds

    public function mount()
    {
        $this->loadFeaturedBooks();
    }

    public function loadFeaturedBooks()
    {
        $this->featuredBooks = Book::featured()->published()->latest()->limit(5)->get();
    }

    public function nextSlide()
    {
        if (count($this->featuredBooks) > 0) {
            $this->activeIndex = ($this->activeIndex + 1) % count($this->featuredBooks);
        }
    }

    public function previousSlide()
    {
        if (count($this->featuredBooks) > 0) {
            $this->activeIndex = ($this->activeIndex - 1 + count($this->featuredBooks)) % count($this->featuredBooks);
        }
    }

    public function setActiveSlide($index)
    {
        $this->activeIndex = $index;
    }

    public function render()
    {
        return view('livewire.store.featured-books-carousel');
    }
}
