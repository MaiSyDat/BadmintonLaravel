@if (isset($config['js']) && is_array($config['js']))
    @foreach ($config['js'] as $value)
        <script src="{{ asset($value) }}"></script>
    @endforeach
@endif

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.new-content').summernote({
            height: 200,
            placeholder: 'Nhập nội dung chi tiết sản phẩm...',
            tabsize: 2
        });
    });
</script>
