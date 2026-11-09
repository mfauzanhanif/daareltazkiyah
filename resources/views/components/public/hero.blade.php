@props([
    'activeWave' => null,
    'featuredPost' => null,
    'feeMts' => '100.000',
    'feeMdta' => '25.000',
])

<section class="relative bg-[#FAF8F5] min-h-[50vh] lg:min-h-[50vh] flex flex-col justify-between py-4 sm:py-5 lg:py-6 border-b border-[#E5E0D8] overflow-hidden"
    x-data="{
        currentSlide: 1,
        totalSlides: 3,
        autoplayTimer: null,
        isPaused: false,
        touchStartX: 0,
        touchEndX: 0,
        next() {
            this.currentSlide = this.currentSlide === this.totalSlides ? 1 : this.currentSlide + 1;
        },
        prev() {
            this.currentSlide = this.currentSlide === 1 ? this.totalSlides : this.currentSlide - 1;
        },
        goTo(slide) {
            this.currentSlide = slide;
            this.resetAutoplay();
        },
        startAutoplay() {
            this.autoplayTimer = setInterval(() => {
                if (!this.isPaused) {
                    this.next();
                }
            }, 7000);
        },
        stopAutoplay() {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
                this.autoplayTimer = null;
            }
        },
        resetAutoplay() {
            this.stopAutoplay();
            this.startAutoplay();
        },
        handleTouchStart(e) {
            this.touchStartX = e.changedTouches[0].screenX;
        },
        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            if (this.touchStartX - this.touchEndX > 50) {
                this.next();
                this.resetAutoplay();
            } else if (this.touchEndX - this.touchStartX > 50) {
                this.prev();
                this.resetAutoplay();
            }
        }
    }"
    x-init="startAutoplay()"
    @mouseenter="isPaused = true"
    @mouseleave="isPaused = false"
    @touchstart.passive="handleTouchStart($event)"
    @touchend.passive="handleTouchEnd($event)"
    @keydown.arrow-right.window="next()"
    @keydown.arrow-left.window="prev()">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full grow flex flex-col justify-between relative z-10">

        <!-- Smooth Sliding Viewport & Track -->
        <div class="overflow-hidden w-full grow flex flex-col justify-center my-auto py-2">
            <div class="flex transition-transform duration-500 ease-out items-center"
                 :style="'transform: translateX(-' + ((currentSlide - 1) * 100) + '%)'">

                <!-- Slide 1: Profil Pesantren & Identitas -->
                <x-public.hero.slide-profile />

                <!-- Slide 2: Informasi PSB 2027/2028 -->
                <x-public.hero.slide-psb
                    :activeWave="$activeWave"
                    :feeMts="$feeMts"
                    :feeMdta="$feeMdta"
                />

                <!-- Slide 3: Latest Berita (Warta Terkini) -->
                <x-public.hero.slide-news
                    :featuredPost="$featuredPost"
                />

            </div>
        </div>

        <!-- Carousel Bottom Navigation & Indicators (No Numbers!) -->
        <x-public.hero.navigation />

    </div>
</section>
