<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#searchInput').keyup(function() {
            var query = $(this).val();

            if (query != '') {
                $.ajax({
                    url: "{{ route('search.autocomplete') }}",
                    method: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#searchResult').html(data);
                        $('#searchResult').slideDown();
                    }
                });
            } else {
                $('#searchResult').slideUp();
            }
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#searchInput').length && !$(e.target).closest('#searchResult')
                .length) {
                $('#searchResult').slideUp();
            }
        });

        $(document).on('click', 'li', function() {
            var text = $(this).text().trim();
            $('#searchInput').val(text);
            $('#searchResult').slideUp();

            if ($(this).hasClass('user-item')) {
                $('#searchInput').closest('form').submit();
            } else if ($(this).hasClass('post-item')) {
                $('#searchInput').closest('form').submit();
            }
        });
    });
</script>
