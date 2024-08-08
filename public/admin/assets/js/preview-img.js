document.addEventListener("DOMContentLoaded", function () {
    function handleImagePreview(inputId, previewId) {
        document
            .getElementById(inputId)
            .addEventListener("change", function (event) {
                const file = event.target.files[0];
                const preview = document.getElementById(previewId);

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.add("preview-img");
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src =
                        "{{ asset('admin/assets/img/icons/upload.svg') }}";
                    preview.classList.remove("preview-img");
                }
            });
    }
    handleImagePreview("image-input-icon", "image-preview-icon");
    handleImagePreview("image-input-bg", "image-preview-bg");
});

document.addEventListener("DOMContentLoaded", function () {
    function previewImage(inputId, previewId) {
        const inputElement = document.getElementById(inputId);
        const previewElement = document.getElementById(previewId);

        inputElement.addEventListener("change", function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewElement.src = e.target.result;
                    previewElement.classList.add("preview-img");
                };
                reader.readAsDataURL(file);
            } else {
                previewElement.src =
                    "{{ asset('admin/assets/img/icons/upload.svg') }}";
                previewElement.classList.remove("preview-img");
            }
        });
    }

    previewImage("editIcon", "icon-preview");
    previewImage("editImage", "background-preview");
});
