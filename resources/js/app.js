import Dropzone from "dropzone";
import Swal from "sweetalert2";
import { EmojiButton } from "@joeattardi/emoji-button";

function initializeEmojiButton() {
    const buttons = document.querySelectorAll(".emoji-button");

    buttons.forEach((button) => {
        const picker = new EmojiButton();
        const commentInput = button
            .closest("form")
            .querySelector('input[name="comment"]');

        picker.on("emoji", (selection) => {
            const emoji = selection.emoji;
            const cursorPosition = commentInput.selectionStart;
            const commentValue = commentInput.value;

            const newCommentValue =
                commentValue.slice(0, cursorPosition) +
                emoji +
                commentValue.slice(cursorPosition);

            commentInput.value = newCommentValue;
            commentInput.dispatchEvent(new Event("input"));
            commentInput.focus();
            commentInput.setSelectionRange(
                cursorPosition + emoji.length,
                cursorPosition + emoji.length
            );
        });

        button.addEventListener("click", () => {
            if (picker.pickerVisible) {
                picker.hidePicker();
            } else {
                picker.showPicker(button);
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    initializeEmojiButton();
});

Livewire.hook("message.processed", () => {
    initializeEmojiButton();
});

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
        title: "¡Éxito!",
        text: "Comentario Realizado.",
        icon: "success",
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        position: "top-end",
    });
});

//funcion de busqueda y autocompletado

// despues de buscar a un post el autocomplete deja funcionar
// cosa que no pasa si busco a un usuario

// document.addEventListener("DOMContentLoaded", function () {
//     const searchInput = document.getElementById("searchInput");
//     const searchResult = document.getElementById("searchResult");

//     function closeSearchResults() {
//         searchResult.style.display = "none";
//     }

//     function search(query) {
//         if (query !== "") {
//             fetch(`/search/autocomplete?query=${query}`)
//                 .then((response) => {
//                     if (!response.ok) {
//                         throw new Error("Network response was not ok");
//                     }
//                     return response.text();
//                 })
//                 .then((data) => {
//                     searchResult.innerHTML = data;
//                     searchResult.style.display = "block";
//                 })
//                 .catch((error) => console.error("Error fetching data:", error));
//         } else {
//             closeSearchResults();
//         }
//     }

//     document.addEventListener("click", function (event) {
//         if (!searchResult.contains(event.target)) {
//             closeSearchResults();
//         }
//     });

//     document.addEventListener("click", function (event) {
//         if (event.target.tagName === "LI") {
//             const text = event.target.textContent.trim();
//             searchInput.value = text;
//             closeSearchResults();

//             if (
//                 event.target.classList.contains("user-item") ||
//                 event.target.classList.contains("post-item")
//             ) {
//                 event.target.closest("form").submit();
//             }
//         }
//     });

//     searchInput.addEventListener("keyup", function () {
//         const query = this.value.trim();
//         search(query);
//     });
// });
