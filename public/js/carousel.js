document.addEventListener('DOMContentLoaded', function () {
    const gambarCarousel = [
        '/image/sakupaleza-1.jpg',
        '/image/sakupaleza-2.jpg',
        '/image/sakupaleza-3.jpg'
    ];

    let index = 0;

    function gantiGambar(arah) {
        index += arah;
        if (index < 0) index = gambarCarousel.length - 1;
        if (index >= gambarCarousel.length) index = 0;

        const carouselImage = document.getElementById('carousel-image');
        if (carouselImage) {
            carouselImage.src = gambarCarousel[index];
        }
    }

    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => gantiGambar(-1));
        nextBtn.addEventListener('click', () => gantiGambar(1));
    }

        // ⏱️ Autoplay setiap 5 detik
    setInterval(() => {
        gantiGambar(1);
    }, 5000); // 5000 milidetik = 5 detik
});
