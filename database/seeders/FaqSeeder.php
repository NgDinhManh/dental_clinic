<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'question' => 'Bao lâu nên khám và kiểm tra răng định kỳ?',
                'answer' => 'Mỗi 06 tháng nên đi khám và kiểm tra 1 lần: để vệ sinh răng miệng, phát hiện sâu răng giai đoạn sớm cũng như các tổn thương vùng miệng giai đoạn đầu.',
                'is_active' => 1,
                'faq_order' => 1,
            ],
            [
                'question' => 'Nhổ răng có đau không? Sau bao lâu có thể làm răng giả?',
                'answer' => 'Nhổ răng là thủ thuật nha khoa khá đơn giản , được thực hiện nhanh. Thông thường chỉ mất khoảng 20-30 phút, răng khôn có thể lâu hơn một chút. Trước khi thực hiện nhổ răng, Bác sĩ sẽ thoa tê bề mặt, sau đó gây tê giúp bệnh nhân hoàn toàn không đau trong quá trình nhổ răng.Tại nha khoa Dr Hùng với sự hỗ trợ của CT Cone Beam chúng tôi có thể phục hồi răng tức thì sau khi nhổ răng ( rút ngắn thời gian phục hồi răng cũng như chỉ phải dùng thuốc một đợt) bằng kỹ thuật đặt Implant tức thì.',
                'is_active' => 1,
                'faq_order' => 2,
            ],
            [
                'question' => 'Việc cấy ghép Implant có đau không và mất bao lâu?',
                'answer' => 'Hầu như là không đau vì việc cấy ghép thường được thực hiên dưới gây tê tại chỗ, sau khi hết thuốc tê bác sĩ có kê thêm đơn thuốc hỗ trợ quá trình lành thương ( trong đó có thuốc giảm đau).Thời gian cấy ghép Implant mất khoảng 15 phút trên mỗi trụ Implant.',
                'is_active' => 1,
                'faq_order' => 3,
            ],
            [
                'question' => 'Sau bao lâu có thể làm răng trên Implant?',
                'answer' => 'Có thể làm răng trên Implant tức thì nếu tình trạng xương tốt. Tuy nhiên, nếu chất lượng xương không tốt hoặc phải ghép xương thời gian đợi làm răng từ 6-8 tháng sau khi cắm Implant.',
                'is_active' => 1,
                'faq_order' => 4,
            ],
            [
                'question' => 'Làm cầu răng, mão răng mất bao nhiêu lần hẹn?',
                'answer' => 'Chỉ mất hai lần hẹn cho việc thực hiện răng giả cố định. Lần 1: khám , chụp phim, sửa soạn răng,  lấy dấu. Sau đó labo răng giả sẽ chế tạo răng của bạn. Lần 2: gắn kết thúc. Tại Nha Khoa Dr Hùng, chúng tôi được trang bị Lab tại chỗ (Lab in-house ) nên rút ngắn được thời gian chờ đợi.',
                'is_active' => 1,
                'faq_order' => 5,
            ],
            [
                'question' => 'Tại sao phải niềng răng ( chỉnh nha )?',
                'answer' => 'Khi răng bị lệch lạc, chen chúc làm cho vệ sinh răng miệng khó, dễ gây sâu răng, viêm nướu. Ngoài ra khớp cắn không chuẩn dễ đau khớp nhai ( khớp thái dương hàm ). Hai hàm răng đều đặn, thẳng hàng dễ vệ sinh răng, ăn nhai tốt và làm cho nụ cười của bạn đẹp rạng ngời.',
                'is_active' => 1,
                'faq_order' => 6,
            ],
            [
                'question' => 'Lứa tuổi nên niềng răng  (chỉnh nha)',
                'answer' => 'Thường khoảng 10 -17 tuổi, tùy thuộc vào khám trực tiếp trên miệng và phân tích trên phim. Tuy nhiên, lứa tuổi chỉnh nha hiện nay lớn hơn do nhu cầu thẫm mỹ cũng như một số vần đề liên quan về khớp cắn.',
                'is_active' => 1,
                'faq_order' => 7,
            ],
            [
                'question' => 'Thời gian niềng răng ( chỉnh nha) mất bao lâu?',
                'answer' => 'Khoảng 18-24 tháng, có thể lâu hơn hoặc sớm hơn 1 chút tùy thuộc vào mức độ nặng, nhẹ trên miệng bệnh nhân.',
                'is_active' => 1,
                'faq_order' => 8,
            ],
            [
                'question' => 'Chụp X-quang răng có hại không?',
                'answer' => 'Tại Nha Khoa Dr Hùng, chúng tôi trang bị máy chụp X quang thế hệ mới nhất nên lượng tia phát ra để thu được hình ảnh X quang rất thấp.Ví dụ: Lượng tia trung bình trong môi trường sống ở Mỹ khoảng 3,2 mSv/năm để chụp 1 phim nhỏ trong miệng, cường độ tia khoảng 0.005 milisievent (mSv – đơn vị đo lường phóng xạ ). Như vậy  phải chụp liên tục 640 lần mới bằng mức tia xạ trung bình trong môi trường)',
                'is_active' => 1,
                'faq_order' => 9,
            ],
            [
                'question' => 'Các thói quen răng miệng nào nên từ bỏ?',
                'answer' => 'Thức ăn ngọt, giàu tinh bột dễ sinh acid có hại gây sâu răng. Hút thuốc lá , vệ sinh răng miệng kém cũng ảnh hưởng nghiêm trọng đến các mô xung quanh răng (bệnh nha chu )',
                'is_active' => 1,
                'faq_order' => 10,
            ],
        ];
        \DB::table('faqs')->insertOrIgnore($data);
    }
}
