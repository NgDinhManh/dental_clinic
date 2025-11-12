<meta name="csrf-token" content="{{ csrf_token() }}">

<button class="btn btn-primary btn-lg rounded-circle" id="chat-toggle-button"
    style="position: fixed; bottom: 20px; right: 60px; z-index: 1050; height: 53px;">
    <i class="bi bi-chat-dots-fill"></i>
</button>

<div class="card shadow d-none" id="chat-widget"
    style="position: fixed; bottom: 80px; right: 20px; width: 350px; max-width: 90%; z-index: 1050;">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center p-2">
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/img/chatbot.jpg') }}" alt="Bot" class="rounded-circle me-2"
                style="width: 40px; height: 40px;">
            <div>
                <strong class="mb-0">Trợ lý Nha khoa</strong>
                <small class="d-block">Đang hoạt động</small>
            </div>
        </div>
        <button class="btn-close btn-close-white" id="chat-close-button" aria-label="Close"></button>
    </div>

    <div class="card-body p-3" id="chat-body" style="height: 400px; overflow-y: auto;">

        <div class="d-flex mb-3" id="bot-message-template">
            <img src="{{ asset('assets/img/chatbot.jpg') }}" alt="Bot" class="rounded-circle me-2"
                style="width: 30px; height: 30px; align-self: flex-start;">
            <div class="p-2" style="background-color: #f1f0f0; border-radius: 15px; max-width: 85%;">
                Chào bạn! Tôi có thể giúp gì về các dịch vụ nha khoa?
            </div>
        </div>

    </div>

    <div class="card-footer p-2">
        <div class="input-group">
            <input type="text" id="chat-input" class="form-control" placeholder="Nhập tin nhắn..."
                aria-label="Nhập tin nhắn">
            <button class="btn btn-primary" type="button" id="chat-send-button">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
    </div>
</div>

<script>
    // Chờ cho toàn bộ trang được tải
    document.addEventListener('DOMContentLoaded', function() {

        // --- 1. Lấy các phần tử ---
        const chatToggleButton = document.getElementById('chat-toggle-button');
        const chatWidget = document.getElementById('chat-widget');
        const chatCloseButton = document.getElementById('chat-close-button');
        const chatBody = document.getElementById('chat-body');
        const chatInput = document.getElementById('chat-input');
        const chatSendButton = document.getElementById('chat-send-button');

        // (Giả sử bạn có file ảnh avatar của bot ở /images/bot-avatar.png)
        const botAvatarSrc = '{{ asset('assets/img/chatbot.jpg') }}';

        // --- 2. Logic Ẩn/Hiện Khung Chat ---
        chatToggleButton.addEventListener('click', () => {
            chatWidget.classList.toggle('d-none');
        });

        chatCloseButton.addEventListener('click', () => {
            chatWidget.classList.add('d-none');
        });

        // --- 3. Logic Gửi Tin Nhắn ---

        // Gán sự kiện cho cả nút Gửi và phím Enter
        chatSendButton.addEventListener('click', handleSendMessage);
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                handleSendMessage();
            }
        });

        /**
         * Hàm xử lý chính khi người dùng gửi tin
         */
        function handleSendMessage() {
            const messageText = chatInput.value.trim();

            if (messageText === '') return; // Không gửi tin nhắn rỗng

            // 1. Hiển thị tin nhắn của User lên giao diện NGAY LẬP TỨC
            addMessageToChat('user', messageText);

            // 2. Xóa ô input
            chatInput.value = '';

            // 3. Hiển thị "Bot đang gõ..." (Tùy chọn nhưng nên có)
            showTypingIndicator();

            // 4. Gửi tin nhắn đến Backend và chờ phản hồi
            // Đây chính là nơi tích hợp backend
            getBotResponse(messageText);
        }

        /**
         * HÀM QUAN TRỌNG: Thêm tin nhắn vào chat-body
         * @param {string} sender - Người gửi ('user' hoặc 'bot')
         * @param {string} message - Nội dung tin nhắn
         */
        function addMessageToChat(sender, message) {
            // Xóa "đang gõ..." nếu có
            hideTypingIndicator();

            const messageElement = document.createElement('div');
            let html = '';

            if (sender === 'user') {
                messageElement.className = 'd-flex justify-content-end mb-3';
                html = `
                <div class="p-2 text-white" style="background-color: #007bff; border-radius: 15px; max-width: 85%;">
                    ${message}
                </div>
            `;
            } else { // sender === 'bot'
                messageElement.className = 'd-flex mb-3';
                html = `
                <img src="${botAvatarSrc}" alt="Bot" class="rounded-circle me-2" style="width: 30px; height: 30px; align-self: flex-start;">
                <div class="p-2" style="background-color: #f1f0f0; border-radius: 15px; max-width: 85%;">
                    ${message}
                </div>
            `;
            }

            messageElement.innerHTML = html;
            chatBody.appendChild(messageElement);

            // Tự động cuộn xuống tin nhắn mới nhất
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        /**
         * Hiển thị chỉ báo "Bot đang gõ..."
         */
        function showTypingIndicator() {
            // Đảm bảo không có chỉ báo nào đang tồn tại
            hideTypingIndicator();

            const typingElement = document.createElement('div');
            typingElement.id = 'typing-indicator'; // Gán ID để dễ dàng xóa
            typingElement.className = 'd-flex mb-3';
            typingElement.innerHTML = `
            <img src="${botAvatarSrc}" alt="Bot" class="rounded-circle me-2" style="width: 30px; height: 30px; align-self: flex-start;">
            <div class="p-2" style="background-color: #f1f0f0; border-radius: 15px;">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
            chatBody.appendChild(typingElement);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        /**
         * Ẩn chỉ báo "Bot đang gõ..."
         */
        function hideTypingIndicator() {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) {
                chatBody.removeChild(typingIndicator);
            }
        }

        function getBotResponse(userMessage) {

            // ---- CODE (Khi tích hợp Laravel) ----

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/chat-message', { // Đây là API endpoint của Laravel
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken // Gửi token để Laravel xác thực
                    },
                    body: JSON.stringify({
                        message: userMessage
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        // Xử lý nếu server trả về lỗi (ví dụ: 500, 404)
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // "data.reply" chính là câu trả lời từ controller
                    addMessageToChat('bot', data.reply);
                })
                .catch(error => {
                    console.error('Lỗi khi gọi API:', error);
                    addMessageToChat('bot', 'Xin lỗi, tôi đang gặp lỗi. Vui lòng thử lại sau.');
                });

        }
    });
</script>

