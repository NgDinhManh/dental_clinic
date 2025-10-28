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
    #image-upload-input {
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
    const input = document.getElementById('image-upload-input');
    const preview = document.getElementById('image-upload-preview');

    input.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result; // đổi ảnh hiển thị
            };
            reader.readAsDataURL(file);
        }
    });
</script>
