const images = [
    'image/Custom Face Human.jpg',
    'image/Custom tentara.jpg',
    'image/Kartun.jpg'
  ];
  
  let currentIndex = 0;
  const imgElement = document.getElementById('slider-image');
  
  function showImage(index) {
    imgElement.src = images[index];
  }
  
  function nextSlide() {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
  }
  
  function prevSlide() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage(currentIndex);
  }
  