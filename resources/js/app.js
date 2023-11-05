import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Drag and drop your files here or click to upload.',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,
    url: "{{ route('post.create') }}",  // Add the URL for file upload
    // Other options...
});


dropzone.on('sending', function(file, xhr, formData){
    console.log(file)
})