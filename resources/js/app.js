// resources/js/app.js

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.data('heroSlider', (slidesFromBlade = [], intervalTime = 5000) => ({
    slides: slidesFromBlade,
    currentSlide: 0,
    interval: intervalTime,
    autoplayTimer: null,
    locale: document.documentElement.lang || 'uz',

    init() {
        this.startAutoplay();

        // Touch/swipe support for mobile
        this.initTouchEvents();

        // Pause autoplay on hover (desktop only)
        // if (window.innerWidth >= 768) {
        //     this.$el.addEventListener('mouseenter', () => this.pauseAutoplay());
        //     this.$el.addEventListener('mouseleave', () => this.startAutoplay());
        // }
    },

    initTouchEvents() {
        let startX = 0;
        let startY = 0;
        let endX = 0;
        let endY = 0;

        this.$el.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });

        this.$el.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            endY = e.changedTouches[0].clientY;
            this.handleSwipe(startX, startY, endX, endY);
        });
    },

    handleSwipe(startX, startY, endX, endY) {
        const deltaX = endX - startX;
        const deltaY = endY - startY;
        const minSwipeDistance = 50;

        // Only handle horizontal swipes
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > minSwipeDistance) {
            if (deltaX > 0) {
                this.previousSlide();
            } else {
                this.nextSlide();
            }
        }
    },

    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        this.resetAutoplay();
    },

    previousSlide() {
        this.currentSlide = this.currentSlide === 0 ? this.slides.length - 1 : this.currentSlide - 1;
        this.resetAutoplay();
    },

    goToSlide(index) {
        this.currentSlide = index;
        this.resetAutoplay();
    },

    startAutoplay() {
        this.autoplayTimer = setInterval(() => {
            this.nextSlide();
        }, this.interval);
    },

    pauseAutoplay() {
        if (this.autoplayTimer) {
            clearInterval(this.autoplayTimer);
            this.autoplayTimer = null;
        }
    },

    resetAutoplay() {
        this.pauseAutoplay();
        this.startAutoplay();
    }
}));


Alpine.start()
