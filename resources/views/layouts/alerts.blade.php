{{-- Các dạng hiển thị thông báo --}}
{{-- <style>
    .alert-overlay {
        position: fixed;
        top: 50px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050;
        min-width: 300px;
        max-width: 800px;
        padding: 0 20px;
    }
</style>
<div class="alert-overlay">
    @if (session('success'))
        <div class="alert alert-success show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger show text-center" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning show text-center" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info show text-center" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif --}}

    {{-- Hiển thị lỗi validate --}}
    {{-- @if ($errors->any())
        <div class="alert alert-danger show text-center" role="alert">
            <strong>Vui lòng kiểm tra lại:</strong>
            <ul class="mb-0 mt-1 p-0">
                @foreach ($errors->all() as $error)
                    <li class="list-unstyled">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div> --}}

{{-- Tự động ẩn thông báo sau 3 giây --}}
{{-- <script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) alert.classList.remove('show');
        if (alert) alert.classList.add('fade');
    }, 3000);
</script> --}}

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Success
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-success'
                },
                buttonsStyling: false
            });
        @endif

        // Error
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        @endif

        // Warning
        @if (session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Cảnh báo',
                text: '{{ session('warning') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-warning'
                },
                buttonsStyling: false
            });
        @endif

        // Info
        @if (session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Thông tin',
                text: '{{ session('info') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-info'
                },
                buttonsStyling: false
            });
        @endif

        // Validate errors
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Vui lòng kiểm tra lại:',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        @endif
    });
</script>
