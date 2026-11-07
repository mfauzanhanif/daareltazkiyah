@extends('layouts.public')

@section('title', 'Galeri Foto Kegiatan Pondok')

@section('meta')
    <meta name="description"
        content="Potret dinamika kehidupan, pembelajaran Al-Qur'an, dan dokumentasi kegiatan harian santri PPMTQ Daar El Tazkiyah Sumardi.">
    <meta property="og:title" content="Galeri Foto Kegiatan - PPMTQ Daar El Tazkiyah Sumardi">
    <meta property="og:description"
        content="Dokumentasi visual kegiatan santri, tahfidz Al-Qur'an, dan pembelajaran di PPMTQ Daar El Tazkiyah.">
@endsection

@section('content')
    <section class="py-12 md:py-20 bg-[#FDFBF7]" x-data="{
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
        @keydown.arrow-right.window="if (isOpen) next()" @keydown.arrow-left.window="if (isOpen) prev()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Header Section -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Dokumentasi
                    Visual</span>
                <h1 class="font-serif text-3xl md:text-5xl font-bold text-[#084C27]">Galeri Foto Kegiatan Pondok</h1>
                <p class="text-sm md:text-base text-[#4B6358]">Potret dinamika kehidupan, pembelajaran Al-Qur'an, dan
                    kegiatan harian santri PPMTQ Daar El Tazkiyah Sumardi.</p>
                <div class="w-16 h-1 bg-[#D97706] mx-auto rounded-full"></div>
            </div>

            <!-- Albums Grid (Responsive 1/2/3/4 cols) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($galleries as $gallery)
                    @php
                        $albumPhotos = [];
                        if ($gallery->photos->isNotEmpty()) {
                            foreach ($gallery->photos as $p) {
                                $albumPhotos[] = [
                                    'src' => asset('storage/' . $p->file_path),
                                    'caption' => $p->caption ?: $gallery->title,
                                    'alt' => $p->caption ?: $gallery->title,
                                ];
                            }
                        } elseif ($gallery->cover_image) {
                            $albumPhotos[] = [
                                'src' => asset('storage/' . $gallery->cover_image),
                                'caption' => $gallery->title,
                                'alt' => $gallery->title,
                            ];
                        }
                        $photoCount = $gallery->photos->count();
                    @endphp

                    <div
                        class="bg-white rounded-3xl overflow-hidden border border-[#084C27]/10 shadow-xs hover:shadow-card transition flex flex-col justify-between group">
                        <div>
                            <!-- Album Cover (Clickable to open lightbox) -->
                            <div class="aspect-4/3 bg-gray-100 relative overflow-hidden cursor-pointer"
                                @click="openLightbox({{ Js::from($albumPhotos) }}, 0)">
                                @if ($gallery->cover_image)
                                    <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-[#084C27] to-[#059669] flex items-center justify-center text-white/40 font-serif text-3xl font-bold">
                                        DT
                                    </div>
                                @endif

                                <!-- Event Date Badge (Top-Left) -->
                                @if ($gallery->event_date)
                                    <span
                                        class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-xs text-white text-[11px] font-medium flex items-center gap-1.5 shadow-xs">
                                        <svg class="w-3 h-3 text-emerald-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($gallery->event_date)->translatedFormat('d M Y') }}</span>
                                    </span>
                                @endif

                                <!-- Photo Count Badge (Top-Right) -->
                                <span
                                    class="absolute top-3 right-3 px-2.5 py-1 rounded-full bg-[#084C27]/85 backdrop-blur-xs text-white text-[11px] font-semibold flex items-center gap-1 shadow-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $photoCount > 0 ? $photoCount : 1 }} Foto</span>
                                </span>
                            </div>

                            <!-- Album Details -->
                            <div class="p-5 md:p-6 space-y-2">
                                <h3 class="font-serif font-bold text-lg md:text-xl text-[#084C27] leading-snug group-hover:text-[#059669] transition cursor-pointer"
                                    @click="openLightbox({{ Js::from($albumPhotos) }}, 0)">
                                    {{ $gallery->title }}
                                </h3>
                                @if ($gallery->description)
                                    <p class="text-xs text-[#4B6358] line-clamp-2 leading-relaxed">
                                        {{ $gallery->description }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Mini Thumbnails Carousel -->
                        @if ($gallery->photos->isNotEmpty())
                            <div class="p-5 md:p-6 pt-0 border-t border-gray-100 mt-2">
                                <div
                                    class="text-[11px] font-semibold text-[#4B6358] mb-2 flex items-center justify-between">
                                    <span>Foto Dokumentasi ({{ $photoCount }}):</span>
                                    <span class="text-[10px] text-[#059669]">Klik untuk perbesar</span>
                                </div>
                                <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-thin">
                                    @foreach ($gallery->photos as $photoIndex => $photo)
                                        <button type="button"
                                            @click="openLightbox({{ Js::from($albumPhotos) }}, {{ $photoIndex }})"
                                            class="w-12 h-12 md:w-14 md:h-14 rounded-xl overflow-hidden shrink-0 border border-gray-200 hover:border-[#059669] hover:scale-105 focus:ring-2 focus:ring-[#059669] transition duration-200 cursor-pointer"
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
                    <!-- Empty State (Complies with DESIGN.md §12.2 token) -->
                    <div
                        class="col-span-full text-center py-16 px-4 bg-white rounded-3xl border border-dashed border-[#084C27]/20 space-y-3">
                        <div
                            class="w-16 h-16 rounded-2xl bg-[#084C27]/5 text-[#084C27] flex items-center justify-center mx-auto">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-[#084C27]">Belum ada album galeri.</h3>
                        <p class="text-[#4B6358] text-sm max-w-md mx-auto">Dokumentasi kegiatan harian, tahfidz, dan
                            prestasi santri akan segera dipublikasikan di sini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Lightbox Fullscreen Modal with Frosted Backdrop & Swipe / Arrow Keys -->
            <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" role="dialog" aria-modal="true" aria-label="Penampil Foto Galeri"
                @touchstart="handleTouchStart($event)" @touchend="handleTouchEnd($event)"
                class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md flex items-center justify-center p-4 sm:p-6 md:p-8 select-none">

                <!-- Top Action Bar (Counter & Close) -->
                <div class="absolute top-4 inset-x-4 md:inset-x-8 flex items-center justify-between text-white z-10">
                    <div class="px-3 py-1.5 rounded-full bg-black/40 backdrop-blur-xs text-xs md:text-sm font-medium">
                        Foto <span x-text="currentIndex + 1"></span> dari <span x-text="photos.length"></span>
                    </div>
                    <button type="button" @click="closeLightbox()"
                        class="p-2 rounded-full bg-black/40 hover:bg-white/20 text-white/90 hover:text-white transition focus:outline-hidden focus:ring-2 focus:ring-white cursor-pointer"
                        aria-label="Tutup Galeri">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Previous Navigation Button -->
                <button type="button" x-show="photos.length > 1" @click="prev()"
                    class="absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 p-3 rounded-full bg-black/40 hover:bg-white/20 text-white transition focus:outline-hidden focus:ring-2 focus:ring-white z-10 cursor-pointer"
                    aria-label="Foto Sebelumnya">
                    <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Main Image & Caption Container -->
                <div class="max-w-5xl max-h-[90vh] flex flex-col items-center justify-center"
                    @click.outside="closeLightbox()">
                    <div class="relative overflow-hidden rounded-2xl shadow-2xl flex items-center justify-center">
                        <template x-if="photos.length > 0 && photos[currentIndex]">
                            <img :src="photos[currentIndex].src" :alt="photos[currentIndex].alt"
                                class="max-w-full max-h-[75vh] md:max-h-[80vh] object-contain rounded-2xl shadow-2xl">
                        </template>
                    </div>
                    <template x-if="photos.length > 0 && photos[currentIndex] && photos[currentIndex].caption">
                        <div class="mt-3 px-4 py-2 rounded-xl bg-black/50 backdrop-blur-xs max-w-2xl text-center">
                            <p x-text="photos[currentIndex].caption"
                                class="text-white text-xs md:text-sm font-sans leading-relaxed"></p>
                        </div>
                    </template>
                </div>

                <!-- Next Navigation Button -->
                <button type="button" x-show="photos.length > 1" @click="next()"
                    class="absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 p-3 rounded-full bg-black/40 hover:bg-white/20 text-white transition focus:outline-hidden focus:ring-2 focus:ring-white z-10 cursor-pointer"
                    aria-label="Foto Berikutnya">
                    <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
