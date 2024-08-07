let currentIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function updateSliderPosition() {
    const slider = document.querySelector('.slider');
    const newTransform = -currentIndex * (slides[0].offsetWidth + 10); // Adjust for margin
    slider.style.transform = `translateX(${newTransform}px)`;
}

function slideRight() {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSliderPosition();
}

function slideLeft() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    updateSliderPosition();
}

window.addEventListener('resize', updateSliderPosition);










// ...............FILTER CLEAR Function.apply................

function resetVal(){
    document.getElementById('input-keyword').value='';
    document.getElementById('location-val').value='';
    // document.getElementById('mySelect').value = 'AllSubCategory';
    $('#mySelect').val('AllSubCategory').trigger('change');

    const checkboxes = document.querySelectorAll('.toggleCheckbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

   }
