import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: '',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,
});


dropzone.on('sending', function(file, xhr, formData){
    console.log(file)
})