@extends('layouts.public', ['title' => 'Galeri Foto Kegiatan Santri - PPMTQ Daar El Tazkiyah Sumardi'])

@section('meta')
    <meta name="description"
        content="Potret dinamika kehidupan, pembelajaran Al-Qur'an, dan dokumentasi kegiatan harian santri PPMTQ Daar El Tazkiyah Sumardi di Serang, Banten.">
    <meta property="og:title" content="Galeri Foto Kegiatan - PPMTQ Daar El Tazkiyah Sumardi">
    <meta property="og:description"
        content="Dokumentasi visual kegiatan santri, tahfidz Al-Qur'an, dan pembelajaran di PPMTQ Daar El Tazkiyah.">
@endsection

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Potret Rutinitas & Dokumentasi Santri
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Dokumentasi visual kegiatan harian santri, halaqah Al-Qur'an, tasmi' akbar, ekstrakurikuler, dan lingkungan asri kampus PPMTQ Daar El Tazkiyah Sumardi di Serang, Banten.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Gallery Section with Pinterest Masonry & Lightbox -->
    <section class="py-10 md:py-16 bg-[#FAF8F5]" x-data="{
        activeFilter: 'semua',
        isOpen: false,
        photos: [],
        currentIndex: 0,
        touchStartX: 0,
        touchEndX: 0,
        openLightbox(items, index = 0) {
            if (!items || items.length === 0) return;
            this.photos = items;
            this.currentIndex = index;
            this.isOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeLightbox() {
            this.isOpen = false;
            document.body.classList.remove('overflow-hidden');
        },
        next() {
            if (this.photos.length <= 1) return;
            this.currentIndex = (this.currentIndex + 1) % this.photos.length;
        },
        prev() {
            if (this.photos.length <= 1) return;
            this.currentIndex = (this.currentIndex - 1 + this.photos.length) % this.photos.length;
        },
        handleTouchStart(e) {
            this.touchStartX = e.changedTouches[0].screenX;
        },
        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            if (this.touchStartX - this.touchEndX > 50) {
                this.next();
            } else if (this.touchEndX - this.touchStartX > 50) {
                this.prev();
            }
        }
    }" @keydown.escape.window="closeLightbox()"
        @keydown.arrow-right.window="if (isOpen) next()"
        @keydown.arrow-left.window="if (isOpen) prev()">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Interactive Category Filter Tabs -->
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-[#E5E0D8] pb-4">
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" @click="activeFilter = 'semua'"
                        class="px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition"
                        :class="activeFilter === 'semua' ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                        Semua Galeri
                    </button>
                    <button type="button" @click="activeFilter = 'tahfidz'"
                        class="px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition"
                        :class="activeFilter === 'tahfidz' ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                        Tahfidz & Tasmi'
                    </button>
                    <button type="button" @click="activeFilter = 'kegiatan'"
                        class="px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition"
                        :class="activeFilter === 'kegiatan' ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                        Kegiatan Santri
                    </button>
                    <button type="button" @click="activeFilter = 'prestasi'"
                        class="px-4 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition"
                        :class="activeFilter === 'prestasi' ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                        Prestasi & Lomba
                    </button>
                </div>

                <div class="text-xs font-mono text-[#4B6358]">
                    Format: <span class="text-[#059669] font-bold">Pinterest Masonry Grid</span>
                </div>
            </div>

            <!-- Pinterest Masonry Grid Container -->
            <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                @forelse($galleries as $gallery)
                    @php
                        $albumPhotos = [];
                        if ($gallery->photos->isNotEmpty()) {
                            foreach ($gallery->photos as $p) {
                                $albumPhotos[] = [
                                    'src' => asset('storage/' . $p->file_path),
                                    'caption' => $p->caption ?: $gallery->title,
                                    'alt' => $p->caption ?: $gallery->title,
                                    'time' => $p->created_at ? $p->created_at->format('d M Y') : null,
                                ];
                            }
                        } elseif ($gallery->cover_image) {
                            $albumPhotos[] = [
                                'src' => asset('storage/' . $gallery->cover_image),
                                'caption' => $gallery->title,
                                'alt' => $gallery->title,
                                'time' => $gallery->created_at ? $gallery->created_at->format('d M Y') : null,
                            ];
                        }
                        $photoCount = $gallery->photos->count();

                        $titleLower = strtolower($gallery->title . ' ' . $gallery->description);
                        $tag = 'kegiatan';
                        if (str_contains($titleLower, 'tahfidz') || str_contains($titleLower, 'tasmi') || str_contains($titleLower, 'qur')) {
                            $tag = 'tahfidz';
                        } elseif (str_contains($titleLower, 'prestasi') || str_contains($titleLower, 'juara') || str_contains($titleLower, 'lomba')) {
                            $tag = 'prestasi';
                        }
                    @endphp

                    <!-- Pinterest Pin Card -->
                    <div class="break-inside-avoid bg-white border border-[#E5E0D8] rounded-md overflow-hidden hover:border-[#0D3B2E] hover:shadow-lg transition duration-300 group flex flex-col justify-between"
                        x-show="activeFilter === 'semua' || activeFilter === '{{ $tag }}'">

                        <div>
                            <!-- Image Pin (Clickable to Lightbox index 0) -->
                            <div class="relative overflow-hidden bg-gray-100 cursor-pointer"
                                @click="openLightbox({{ Js::from($albumPhotos) }}, 0)">
                                @if ($gallery->cover_image)
                                    <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}"
                                        loading="lazy"
                                        class="w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                                @elseif ($gallery->photos->isNotEmpty())
                                    <img src="{{ asset('storage/' . $gallery->photos->first()->file_path) }}" alt="{{ $gallery->title }}"
                                        loading="lazy"
                                        class="w-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                                @else
                                    <x-public.image-placeholder :title="$gallery->title" aspect="aspect-4/3" />
                                @endif

                                <!-- Photo Count Marker (Top-Right) -->
                                <span class="absolute top-2 right-2 px-2 py-0.5 bg-black/70 text-white text-[10px] font-mono rounded">
                                    {{ $photoCount > 0 ? $photoCount : 1 }} Foto
                                </span>

                                @if ($gallery->event_date)
                                    <span class="absolute top-2 left-2 px-2 py-0.5 bg-[#0D3B2E] text-white text-[10px] font-mono rounded">
                                        {{ \Carbon\Carbon::parse($gallery->event_date)->translatedFormat('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Pin Details -->
                            <div class="p-4 space-y-1.5">
                                <div class="flex items-center justify-between text-[10px] font-mono text-[#B89758] uppercase">
                                    <span>{{ $tag === 'tahfidz' ? 'Tahfidz & Tasmi' : ($tag === 'prestasi' ? 'Prestasi Santri' : 'Dinamika Santri') }}</span>
                                </div>
                                <h3 class="font-sans font-bold text-sm text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug cursor-pointer"
                                    @click="openLightbox({{ Js::from($albumPhotos) }}, 0)">
                                    {{ $gallery->title }}
                                </h3>
                                @if ($gallery->description)
                                    <p class="text-xs text-[#4B6358] line-clamp-2 leading-relaxed">
                                        {{ $gallery->description }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Mini Thumbnails Carousel Strip -->
                        @if ($gallery->photos->isNotEmpty())
                            <div class="p-4 pt-0 border-t border-[#E5E0D8]/60 mt-2">
                                <div class="text-[10px] font-mono uppercase text-[#4B6358] mb-1.5 flex items-center justify-between">
                                    <span>Koleksi Foto:</span>
                                    <span class="text-[#059669]">Klik Perbesar</span>
                                </div>
                                <div class="flex items-center gap-1.5 overflow-x-auto pb-1 scrollbar-thin">
                                    @foreach ($gallery->photos as $photoIndex => $photo)
                                        <button type="button"
                                            @click="openLightbox({{ Js::from($albumPhotos) }}, {{ $photoIndex }})"
                                            class="w-10 h-10 shrink-0 rounded border border-[#E5E0D8] hover:border-[#0D3B2E] transition cursor-pointer overflow-hidden"
                                            title="{{ $photo->caption ?? 'Perbesar Foto' }}">
                                            <img src="{{ asset('storage/' . $photo->file_path) }}"
                                                alt="{{ $photo->caption ?? 'Foto' }}" loading="lazy"
                                                class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 px-4 bg-white border border-[#E5E0D8] rounded-md space-y-3">
                        <span class="editorial-label text-[#B89758]">DOKUMENTASI BELUM TERSEDIA</span>
                        <h3 class="font-sans font-bold text-lg text-[#084C27]">Belum ada album galeri.</h3>
                        <p class="text-[#4B6358] text-sm max-w-md mx-auto">Dokumentasi kegiatan harian, tahfidz, dan prestasi santri akan segera dipublikasikan di sini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Lightbox Modal -->
            <div x-show="isOpen" x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                role="dialog" aria-modal="true" aria-label="Penampil Foto Galeri"
                @touchstart="handleTouchStart($event)"
                @touchend="handleTouchEnd($event)"
                class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md flex items-center justify-center p-4 sm:p-6 md:p-8 select-none">

                <!-- Top Action Bar -->
                <div class="absolute top-4 inset-x-4 md:inset-x-8 flex items-center justify-between text-white z-10 border-b border-white/20 pb-3">
                    <div class="font-mono text-xs text-amber-200">
                        Foto <span x-text="currentIndex + 1"></span> dari <span x-text="photos.length"></span>
                    </div>
                    <button type="button" @click="closeLightbox()"
                        class="p-2 border border-white/30 rounded-md text-white hover:bg-white/10 transition cursor-pointer"
                        aria-label="Tutup Galeri">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Previous Navigation Button -->
                <button type="button" x-show="photos.length > 1" @click="prev()"
                    class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 p-3 border border-white/30 rounded-md bg-[#0D3B2E]/80 hover:bg-white/20 text-white transition z-10 cursor-pointer"
                    aria-label="Foto Sebelumnya">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Main Image & Caption Container -->
                <div class="max-w-5xl max-h-[85vh] flex flex-col items-center justify-center" @click.outside="closeLightbox()">
                    <div class="relative overflow-hidden border border-white/20 rounded-md flex items-center justify-center bg-black/40">
                        <template x-if="photos.length > 0 && photos[currentIndex]">
                            <img :src="photos[currentIndex].src" :alt="photos[currentIndex].alt"
                                class="max-w-full max-h-[75vh] object-contain">
                        </template>
                    </div>
                    <template x-if="photos.length > 0 && photos[currentIndex] && photos[currentIndex].caption">
                        <div class="mt-3 px-4 py-2 bg-black/60 border border-white/15 rounded-md max-w-2xl text-center">
                            <p x-text="photos[currentIndex].caption" class="text-white text-xs font-sans leading-relaxed"></p>
                        </div>
                    </template>
                </div>

                <!-- Next Navigation Button -->
                <button type="button" x-show="photos.length > 1" @click="next()"
                    class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 p-3 border border-white/30 rounded-md bg-[#0D3B2E]/80 hover:bg-white/20 text-white transition z-10 cursor-pointer"
                    aria-label="Foto Berikutnya">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $galleries->links() }}
            </div>

        </div>
    </section>
@endsection
