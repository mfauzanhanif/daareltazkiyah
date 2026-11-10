@props([
    'activeWave' => null,
    'featuredPost' => null,
    'feeMts' => '100.000',
    'feeMdta' => '25.000',
])

<section class="relative bg-[#FAF8F5] flex flex-col justify-between py-4 sm:py-5 lg:py-6 overflow-hidden"
    x-data="{
        currentSlide: 1,
        trackIndex: 1,
        totalSlides: 3,
        enableTransition: true,
        isTransitioning: false,
        autoplayTimer: null,
        isPaused: false,
        touchStartX: 0,
        touchEndX: 0,
        next() {
            if (this.isTransitioning) return;
            this.isTransitioning = true;
            this.enableTransition = true;
            this.trackIndex++;
            if (this.trackIndex === 4) {
                this.currentSlide = 1;
            } else {
                this.currentSlide = this.trackIndex;
            }
            setTimeout(() => {
                if (this.isTransitioning) {
                    this.handleTransitionEnd();
                }
            }, 550);
        },
        prev() {
            if (this.isTransitioning) return;
            this.isTransitioning = true;
            this.enableTransition = true;
            this.trackIndex--;
            if (this.trackIndex === 0) {
                this.currentSlide = 3;
            } else {
                this.currentSlide = this.trackIndex;
            }
            setTimeout(() => {
                if (this.isTransitioning) {
                    this.handleTransitionEnd();
                }
            }, 550);
        },
        handleTransitionEnd() {
            this.isTransitioning = false;
            if (this.trackIndex === 4) {
                this.enableTransition = false;
                this.trackIndex = 1;
                setTimeout(() => {
                    this.enableTransition = true;
                }, 50);
            } else if (this.trackIndex === 0) {
                this.enableTransition = false;
                this.trackIndex = 3;
                setTimeout(() => {
                    this.enableTransition = true;
                }, 50);
            }
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

        <!-- Smooth Sliding Viewport & Seamless Infinite Track -->
        <div class="overflow-hidden w-full grow flex flex-col justify-center my-auto py-2">
            <div class="flex items-center"
                 :class="enableTransition ? 'transition-transform duration-500 ease-out' : 'transition-none'"
                 :style="'transform: translateX(-' + (trackIndex * 100) + '%);' + (enableTransition ? '' : ' transition: none !important;')"
                 @transitionend="handleTransitionEnd()">

                <!-- Slide 0: Clone of Slide 3 (News) for seamless prev loop -->
                <x-public.hero.slide-news
                    :featuredPost="$featuredPost"
                    :isClone="true"
                />

                <!-- Slide 1: Profil Pesantren & Identitas (Primary Real Slide with H1) -->
                <x-public.hero.slide-profile :isClone="false" />

                <!-- Slide 2: Informasi PSB 2027/2028 (Real Slide with Foto Santri Background) -->
                <x-public.hero.slide-psb
                    :activeWave="$activeWave"
                    :feeMts="$feeMts"
                    :feeMdta="$feeMdta"
                    :isClone="false"
                />

                <!-- Slide 3: Latest Berita (Real Slide with Full News Image Background) -->
                <x-public.hero.slide-news
                    :featuredPost="$featuredPost"
                    :isClone="false"
                />

                <!-- Slide 4: Clone of Slide 1 (Profile) for seamless next loop (without duplicate H1) -->
                <x-public.hero.slide-profile :isClone="true" />

            </div>
        </div>

        <!-- Carousel Bottom Navigation & Persistent Action Buttons (Dots Removed) -->
        <x-public.hero.navigation />

    </div>
</section>
