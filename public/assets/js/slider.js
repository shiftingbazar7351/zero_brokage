// let currentIndex = 0;
// const slides = document.querySelectorAll('.slide');
// const totalSlides = slides.length;

// function updateSliderPosition() {
//     const slider = document.querySelector('.slider');
//     const newTransform = -currentIndex * (slides[0].offsetWidth + 10); // Adjust for margin
//     slider.style.transform = `translateX(${newTransform}px)`;
// }

// function slideRight() {
//     currentIndex = (currentIndex + 1) % totalSlides;
//     updateSliderPosition();
// }

// function slideLeft() {
//     currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
//     updateSliderPosition();
// }

// window.addEventListener('resize', updateSliderPosition);



let currentIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
let slideWidth = slides[0].offsetWidth + 10; // Adjust for margin

const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

function updateSliderPosition() {
    const slider = document.querySelector('.slider');
    const newTransform = -currentIndex * slideWidth;
    slider.style.transform = `translateX(${newTransform}px)`;
    updateButtonState();
}

function slideRight() {
    if (currentIndex < totalSlides - 1) {
        currentIndex++;
        updateSliderPosition();
    }
}

function slideLeft() {
    if (currentIndex > 0) {
        currentIndex--;
        updateSliderPosition();
    }
}

function updateButtonState() {
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const sliderWrapperWidth = sliderWrapper.offsetWidth;

    // Calculate the total width of all slides
    const totalWidth = totalSlides * slideWidth;

    // Check if the last slide is fully visible
    const lastSlideVisible = (currentIndex + 2) * slideWidth <= sliderWrapperWidth;
    // Check if the first slide is fully visible
    const firstSlideVisible = currentIndex === 0;

    prevButton.disabled = firstSlideVisible;
    nextButton.disabled = !lastSlideVisible;
}

window.addEventListener('resize', () => {
    slideWidth = slides[0].offsetWidth + 10; // Adjust for margin
    updateSliderPosition();
});

// Initialize button state and position
updateButtonState();
updateSliderPosition();









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


document.addEventListener('DOMContentLoaded', () => {
    const allCategoriesCheckbox = document.querySelector('#allCategories');
    const categoryCheckboxes = document.querySelectorAll('.categoryCheckbox');

    // Update all category checkboxes when "All Categories" is toggled
    allCategoriesCheckbox.addEventListener('change', () => {
        // const isChecked = allCategoriesCheckbox.checked;
        categoryCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    });

});


