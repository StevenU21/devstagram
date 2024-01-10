import Dropzone from "dropzone";
import Swal from "sweetalert2";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const deliveredImage = {};
            deliveredImage.size = 123;
            deliveredImage.name =
                document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this, deliveredImage);
            this.options.thumbnail.call(
                this,
                deliveredImage,
                `/uploads/${deliveredImage.name}`
            );
            deliveredImage.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

dropzone.on("success", function (file, response) {
    console.log(response.image);
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.removeFile("removedFile"),
    function () {
        document.querySelector('[name="image"]').value = "";
    };

window.addEventListener("commented", (event) => {
    Swal.fire({
        title: '¡Éxito!',
        text: 'Comentario Realizado.',
        icon: 'success',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
});
