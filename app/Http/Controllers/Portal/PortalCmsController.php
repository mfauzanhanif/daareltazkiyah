<?php

declare(strict_types=1);

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\Cms\StoreCategoryRequest;
use App\Http\Requests\Portal\Cms\StoreGalleryRequest;
use App\Http\Requests\Portal\Cms\StorePostRequest;
use App\Http\Requests\Portal\Cms\StoreTeacherRequest;
use App\Http\Requests\Portal\Cms\UpdateCategoryRequest;
use App\Http\Requests\Portal\Cms\UpdateGalleryRequest;
use App\Http\Requests\Portal\Cms\UpdatePostRequest;
use App\Http\Requests\Portal\Cms\UpdateSettingsRequest;
use App\Http\Requests\Portal\Cms\UpdateTeacherRequest;
use App\Http\Requests\Portal\Cms\UploadGalleryPhotosRequest;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

final class PortalCmsController extends Controller
{
    public function dashboard(): View
    {
        $postsCount = Post::count();
        $galleriesCount = Gallery::count();
        $teachersCount = Teacher::count();
        $categoriesCount = Category::count();

        $recentPosts = Post::with('category')->latest()->take(5)->get();

        return view('portal.cms.dashboard', compact(
            'postsCount',
            'galleriesCount',
            'teachersCount',
            'categoriesCount',
            'recentPosts'
        ));
    }

    // --- Posts CRUD ---
    public function indexPosts(): View
    {
        $posts = Post::with(['category', 'author'])->latest()->paginate(15);

        return view('portal.cms.posts.index', compact('posts'));
    }

    public function createPost(): View
    {
        $categories = Category::all();

        return view('portal.cms.posts.create', compact('categories'));
    }

    public function storePost(StorePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['author_id'] = (string) $request->user()?->id;
        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')?->store('posts', 'public');
        }

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Post::create($validated);

        return redirect()->route('admin.cms.posts.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function editPost(string $id): View
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view('portal.cms.posts.edit', compact('post', 'categories'));
    }

    public function updatePost(UpdatePostRequest $request, string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        $validated = $request->validated();

        if (! empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')?->store('posts', 'public');
        }

        $post->update($validated);

        return back()->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroyPost(string $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    // --- Categories CRUD ---
    public function indexCategories(): View
    {
        $categories = Category::with('parent')->withCount('posts')->get();

        return view('portal.cms.categories.index', compact('categories'));
    }

    public function storeCategory(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        Category::create($validated);

        return back()->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function updateCategory(UpdateCategoryRequest $request, string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $validated = $request->validated();

        if (! empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $category->update($validated);

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyCategory(string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    // --- Galleries CRUD ---
    public function indexGalleries(): View
    {
        $galleries = Gallery::withCount('photos')->latest('event_date')->paginate(12);

        return view('portal.cms.galleries.index', compact('galleries'));
    }

    public function storeGallery(StoreGalleryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_published'] = (bool) ($request->input('is_published') ?? true);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')?->store('galleries', 'public');
        }

        Gallery::create($validated);

        return back()->with('success', 'Album galeri berhasil dibuat.');
    }

    public function showGallery(string $id): View
    {
        $gallery = Gallery::with('photos')->findOrFail($id);

        return view('portal.cms.galleries.show', compact('gallery'));
    }

    public function updateGallery(UpdateGalleryRequest $request, string $id): RedirectResponse
    {
        $gallery = Gallery::findOrFail($id);
        $validated = $request->validated();

        if (! empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }
        $validated['is_published'] = (bool) ($request->input('is_published') ?? false);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')?->store('galleries', 'public');
        }

        $gallery->update($validated);

        return back()->with('success', 'Album galeri berhasil diperbarui.');
    }

    public function destroyGallery(string $id): RedirectResponse
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return redirect()->route('admin.cms.galleries.index')->with('success', 'Album galeri berhasil dihapus.');
    }

    public function storeGalleryPhoto(UploadGalleryPhotosRequest $request, string $id): RedirectResponse
    {
        $gallery = Gallery::findOrFail($id);
        $photos = $request->file('photos', []);
        $caption = (string) $request->input('caption', '');

        $currentSort = (int) $gallery->photos()->max('sort_order');

        /** @var UploadedFile $photo */
        foreach ($photos as $photo) {
            $path = $photo->store('galleries/photos', 'public');
            $currentSort++;
            $gallery->photos()->create([
                'file_path' => $path,
                'caption' => $caption !== '' ? $caption : null,
                'sort_order' => $currentSort,
            ]);
        }

        return back()->with('success', 'Foto dokumentasi berhasil ditambahkan.');
    }

    public function destroyGalleryPhoto(string $id): RedirectResponse
    {
        $photo = GalleryPhoto::findOrFail($id);
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    // --- Teachers CRUD ---
    public function indexTeachers(): View
    {
        $teachers = Teacher::orderBy('sort_order')->paginate(20);

        return view('portal.cms.teachers.index', compact('teachers'));
    }

    public function storeTeacher(StoreTeacherRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = (bool) ($request->input('is_active') ?? true);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')?->store('teachers', 'public');
            unset($validated['photo']);
        }

        Teacher::create($validated);

        return back()->with('success', 'Data pengajar berhasil disimpan.');
    }

    public function updateTeacher(UpdateTeacherRequest $request, string $id): RedirectResponse
    {
        $teacher = Teacher::findOrFail($id);
        $validated = $request->validated();
        $validated['is_active'] = (bool) ($request->input('is_active') ?? false);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')?->store('teachers', 'public');
            unset($validated['photo']);
        }

        $teacher->update($validated);

        return back()->with('success', 'Data pengajar berhasil diperbarui.');
    }

    public function destroyTeacher(string $id): RedirectResponse
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return back()->with('success', 'Data pengajar berhasil dihapus.');
    }

    // --- Site Settings Update ---
    public function indexSettings(): View
    {
        $settings = SiteSetting::all()->keyBy('key');

        return view('portal.cms.settings.index', compact('settings'));
    }

    public function updateSettings(UpdateSettingsRequest $request): RedirectResponse
    {
        $settings = $request->validated();

        foreach ($settings as $key => $val) {
            if ($val !== null) {
                SiteSetting::set((string) $key, (string) $val);
            }
        }

        return back()->with('success', 'Pengaturan situs berhasil disimpan.');
    }
}
