<?php

declare(strict_types=1);

namespace App\Livewire\Public;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class NewsList extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    #[Url(history: true)]
    public string $category = '';

    public function mount(string $category = '', string $search = ''): void
    {
        if (! empty($category)) {
            $this->category = $category;
        }

        if (! empty($search)) {
            $this->search = $search;
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function setCategory(string $slug): void
    {
        $this->category = ($this->category === $slug) ? '' : $slug;
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'category']);
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Post::query()
            ->published()
            ->with(['category', 'author', 'views'])
            ->latest('published_at');

        if (! empty($this->category)) {
            $query->byCategory($this->category);
        }

        if (! empty($this->search)) {
            $search = $this->search;
            $query->where(function (Builder $q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9);

        $categories = Category::query()
            ->withCount(['posts' => fn (Builder $q) => $q->where('status', PostStatus::Published->value)->whereNotNull('published_at')->where('published_at', '<=', now())])
            ->get();

        return view('livewire.public.news-list', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
