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



document.addEventListener("DOMContentLoaded", function() {
    const carousell = document.querySelector(".carousell");
    const arrowBtns = document.querySelectorAll(".wrapper-slider i");
    const wrapperr = document.querySelector(".wrapper-slider");

    const firstCard = carousell.querySelector(".card");
    const firstCardWidth = firstCard.offsetWidth;

    let isDragging = false,
        startX,
        startScrollLeft,
        timeoutId;

    const dragStart = (e) => {
        isDragging = true;
        carousell.classList.add("dragging");
        startX = e.pageX;
        startScrollLeft = carousell.scrollLeft;
    };

    const dragging = (e) => {
        if (!isDragging) return;

        // Calculate the new scroll position
        const newScrollLeft = startScrollLeft - (e.pageX - startX);

        // Check if the new scroll position exceeds
        // the carousell boundaries
        if (newScrollLeft <= 0 || newScrollLeft >=
            carousell.scrollWidth - carousell.offsetWidth) {

            // If so, prevent further dragging
            isDragging = false;
            return;
        }

        // Otherwise, update the scroll position of the carousell
        carousell.scrollLeft = newScrollLeft;
    };

    const dragStop = () => {
        isDragging = false;
        carousell.classList.remove("dragging");
    };

    const autoPlay = () => {

        // Return if window is smaller than 800
        if (window.innerWidth < 800) return;

        // Calculate the total width of all cards
        const totalCardWidth = carousell.scrollWidth;

        // Calculate the maximum scroll position
        const maxScrollLeft = totalCardWidth - carousell.offsetWidth;

        // If the carousell is at the end, stop autoplay
        if (carousell.scrollLeft >= maxScrollLeft) return;

        // Autoplay the carousell after every 2500ms
        timeoutId = setTimeout(() =>
            carousell.scrollLeft += firstCardWidth, 2500);
    };

    carousell.addEventListener("mousedown", dragStart);
    carousell.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
    wrapperr.addEventListener("mouseenter", () =>
        clearTimeout(timeoutId));
    // wrapper.addEventListener("mouseleave", autoPlay);

    // Add event listeners for the arrow buttons to
    // scroll the carousell left and right
    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            carousell.scrollLeft += btn.id === "left" ?
                -firstCardWidth : firstCardWidth;
        });
    });
});










// ...............FILTER CLEAR Function.apply................

function resetVal(){
    // alert();
    document.getElementById('input-keyword').value='';
    document.getElementById('location-val').value='';
    document.getElementById('mySelect').value = 'AllSubCategory';
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
        const isChecked = allCategoriesCheckbox.checked; // Debug log
        categoryCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });
});


