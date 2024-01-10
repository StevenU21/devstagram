@switch(true)
    @case(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        </script>
    @break

    @case(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops... Algo Salio Mal',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
        </script>
    @break

    @case(session('deleted'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Eliminado',
                text: '{{ session('deleted') }}',
                showConfirmButton: true,
            });
        </script>
    @break
@endswitch
