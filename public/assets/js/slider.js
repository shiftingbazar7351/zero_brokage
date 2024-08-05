let currentIndex = 0;

function slideLeft() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    currentIndex--;
    if (currentIndex < 0) {
        currentIndex = slides.length - 1;
    }
    updateSliderPosition(slider, slides.length);
}

function slideRight() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    currentIndex++;
    if (currentIndex >= slides.length) {
        currentIndex = 0;
    }
    updateSliderPosition(slider, slides.length);
}

function updateSliderPosition(slider, totalSlides) {
    slider.style.transform = `translateX(${-currentIndex * 110}px)`;
}



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