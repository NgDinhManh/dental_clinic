<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function handleMessage(Request $request)
    {
        $userMessage = $request->input('message');

        if (trim($userMessage) === '') {
            return response()->json([
                'reply' => 'Bạn chưa nhập câu hỏi!'
            ]);
        }

        // --- Đây là "bộ não" của bot (Yêu cầu 1) ---
        $systemPrompt = "Bạn là một trợ lý ảo thông minh của phòng khám nha khoa.
        Nhiệm vụ của bạn là chỉ trả lời các câu hỏi liên quan đến lĩnh vực y tế,
        sức khỏe, và nha khoa.

        Nếu người dùng hỏi về bất kỳ chủ đề nào khác (ví dụ: chính trị, thể thao,
        giải trí, lập trình, thời tiết...), bạn PHẢI lịch sự từ chối và hướng
        người dùng quay lại chủ đề chính là nha khoa.

        Ví dụ từ chối: 'Xin lỗi, tôi chỉ là trợ lý nha khoa và không thể
        trả lời các câu hỏi ngoài lĩnh vực y tế. Bạn có câu hỏi nào về
        răng miệng cần tôi hỗ trợ không?'";
        // -------------------------------------------------

        try {
            // --- PHẦN GỌI API THỦ CÔNG BẰNG LARAVEL HTTP (GUZZLE) ---

            // 1. Lấy API Key từ file .env
            $apiKey = env('GEMINI_API_KEY');
            if (empty($apiKey)) {
                Log::error('LỖI: GEMINI_API_KEY chưa được cài đặt trong file .env');
                throw new \Exception('API Key không được cấu hình');
            }

            // 2. Đây là API endpoint cho model gemini-pro
            $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-pro:generateContent?key=' . $apiKey;

            // 3. Xây dựng payload (dữ liệu gửi đi) theo đúng chuẩn API của Google
            $payload = [
                // "contents" là tin nhắn của người dùng
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $userMessage]
                        ]
                    ]
                ],
                // "systemInstruction" là chỉ thị hệ thống của bạn
                'systemInstruction' => [
                    'parts' => [
                        ['text' => $systemPrompt]
                    ]
                ]
            ];

            // 4. Gửi yêu cầu POST
            $response = Http::post($url, $payload);

            // 5. Kiểm tra nếu yêu cầu thất bại (lỗi 4xx, 5xx)
            if (!$response->successful()) {
                // Ghi lại lỗi chi tiết từ Google
                Log::error('Lỗi gọi API Gemini: ' . $response->body());
                throw new \Exception('API trả về lỗi: ' . $response->status());
            }

            // 6. Lấy câu trả lời
            // Cú pháp của Google là: body -> candidates -> 0 -> content -> parts -> 0 -> text
            $botReply = $response->json('candidates.0.content.parts.0.text');

            // 7. Xử lý trường hợp bị chặn (ví dụ: safety settings)
            if (empty($botReply)) {
                $finishReason = $response->json('candidates.0.finishReason');
                Log::warning('Gemini trả về trống, lý do: ' . $finishReason);
                $botReply = "Xin lỗi, tôi không thể trả lời câu hỏi này (có thể do bộ lọc an toàn).";
            }

        } catch (\Exception $e) {
            // Xử lý khi có bất kỳ lỗi nào xảy ra (API key sai, lỗi mạng, ...)
            Log::error('Lỗi khi gọi Gemini API (Guzzle/Http): ' . $e->getMessage());
            $botReply = "Xin lỗi, tôi đang gặp sự cố kỹ thuật. Vui lòng thử lại sau ít phút.";
        }

        // Trả về JSON cho frontend
        return response()->json([
            'reply' => $botReply
        ]);
    }
}
