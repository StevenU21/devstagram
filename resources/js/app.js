import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Drag and drop.',
    acceptedFiles: '.png, .jpg, jpeg, .gif',
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple:false
})