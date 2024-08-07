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

let currentIndex = 1; // Start with the first real slide
const slideWidth = 300; // Adjust this to match the width of your slides
const totalSlides = document.querySelectorAll('.slide').length;

function updateSliderPosition() {
    const slider = document.querySelector('.slider');

    currentIndex--;
    if (currentIndex < 0) {
        slider.style.transition = 'none'; // Disable transition for immediate jump
        currentIndex = totalSlides - 2; // Jump to the last real slide
        slider.style.transform = `translateX(${-currentIndex * slideWidth}px)`;
        setTimeout(() => {
            slider.style.transition = 'transform 0.5s ease-in-out'; // Re-enable transition
            currentIndex--; // Prepare for next left move
            updateSliderPosition();
        }, 20); // Short delay for immediate style change
    } else {
        updateSliderPosition();
    }
}

function slideRight() {
    const slider = document.querySelector('.slider');

    currentIndex++;
    if (currentIndex >= totalSlides - 1) {
        slider.style.transition = 'none'; // Disable transition for immediate jump
        currentIndex = 1; // Jump to the first real slide
        slider.style.transform = `translateX(${-currentIndex * slideWidth}px)`;
        setTimeout(() => {
            slider.style.transition = 'transform 0.5s ease-in-out'; // Re-enable transition
            currentIndex++; // Prepare for next right move
            updateSliderPosition();
        }, 20); // Short delay for immediate style change
    } else {
        updateSliderPosition();
    }
}

function updateSliderPosition() {
    const slider = document.querySelector('.slider');
    slider.style.transform = `translateX(${-currentIndex * slideWidth}px)`;
}

// Initialize position
document.querySelector('.slider').style.transform = `translateX(${-currentIndex * slideWidth}px)`;



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
