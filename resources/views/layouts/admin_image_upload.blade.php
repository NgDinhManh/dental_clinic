<style>
    .image-upload-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .image-upload {
        width: 200px;
        height: 200px;
        object-fit: cover;
        transition: 0.3s;
    }

    .image-upload:hover {
        opacity: 0.8;
    }

    /* Ẩn input file thật */
    .image-upload-input {
        display: none;
    }

    /* Icon máy ảnh hiển thị khi hover */
    .image-upload-wrapper::after {
        content: "📷";
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 5px;
        border-radius: 50%;
        font-size: 18px;
        display: none;
    }

    .image-upload-wrapper:hover::after {
        display: block;
    }
</style>

<script>
    document.addEventListener("change", function(e) {
        if (e.target.matches('.image-upload-input')) {
            const file = e.target.files[0];
            const preview = e.target.closest('.form-group').querySelector('[data-preview]');

            if (file && preview) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>
