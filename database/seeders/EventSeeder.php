<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run()
    {
    DB::table('events')->insert([
    [
        'name' => 'Khai trương website',
        'location' => 'Online',
        'description' => 'Nhân dịp khai trương website bán sách trực tuyến, chúng tôi hân hạnh mang đến chương trình ưu đãi đặc biệt giảm giá 20% cho tất cả các đầu sách có trên website. Đây là cơ hội tuyệt vời để bạn có thể sở hữu những cuốn sách yêu thích với mức giá vô cùng hấp dẫn. Chương trình khuyến mãi này sẽ diễn ra trong suốt tuần đầu tiên từ khi website chính thức đi vào hoạt động. Hãy nhanh tay truy cập và đặt mua ngay hôm nay để nhận ưu đãi.',
        'start_time' => '2024-08-21 00:07:51',
        'end_time' => '2024-09-15 02:00:00',
        'image' => 'https://res.cloudinary.com/dficfkyug/image/upload/v1724172015/il1gvlzvfarqf5g0czuy.jpg',
        'status' => 'upcoming',
        'created_at' => '2024-08-20 16:40:26',
        'updated_at' => '2024-08-20 16:40:26',
        ],
        [
            'name' => 'Flash Sale sách hot',
            'location' => 'Online',
            'description' => 'Đừng bỏ lỡ sự kiện Flash Sale đặc biệt chỉ kéo dài trong 2 giờ duy nhất! Chúng tôi sẽ giảm giá sâu cho những đầu sách best-seller được yêu thích nhất. Đây là dịp để bạn có thể mua những cuốn sách chất lượng với giá chỉ còn một nửa hoặc thậm chí ít hơn. Số lượng sách có hạn và thời gian ngắn ngủi, hãy chắc chắn rằng bạn không bỏ lỡ cơ hội này.',
            'start_time' => '2024-08-21 00:08:02',
            'end_time' => '2024-09-15 21:00:00',
            'image' => 'https://res.cloudinary.com/dficfkyug/image/upload/v1724172117/urvfyzg3niremxkcbiio.jpg',
            'status' => 'upcoming',
            'created_at' => '2024-08-20 16:42:00',
            'updated_at' => '2024-08-20 16:42:00',
            ],
        [
            'name' => 'Cuộc thi viết review sách',
            'location' => 'Online',
            'description' => 'Chúng tôi tổ chức cuộc thi viết review sách nhằm tạo cơ hội cho bạn đọc chia sẻ cảm nhận về những cuốn sách đã mua từ website của chúng tôi. Mỗi bài review chất lượng sẽ có cơ hội nhận được phần quà tặng giá trị hoặc voucher giảm giá cho lần mua sách tiếp theo. Đây không chỉ là cơ hội để bạn thể hiện quan điểm cá nhân mà còn là cách để nhận những ưu đãi tuyệt vời từ chúng tôi.',
            'start_time' => '2024-08-21 00:08:12',
            'end_time' => '2024-10-10 23:45:00',
            'image' => 'https://res.cloudinary.com/dficfkyug/image/upload/v1724172196/lhlnehtctpobmfda27nt.jpg',
            'status' => 'upcoming',
            'created_at' => '2024-08-20 16:43:19',
            'updated_at' => '2024-08-20 16:43:19',
            ],
        [

            'name' => 'Ngày hội sách thiếu nhi',
            'location' => 'Online',
            'description' => 'Để khuyến khích thói quen đọc sách từ nhỏ, chúng tôi tổ chức Ngày hội sách thiếu nhi với chương trình giảm giá 30% cho tất cả các đầu sách thiếu nhi trên website. Hãy cùng con trẻ khám phá thế giới kỳ diệu qua những trang sách và nuôi dưỡng tình yêu đối với việc đọc từ sớm. Chương trình ưu đãi sẽ kéo dài một tuần, mang lại cho bạn và con trẻ nhiều lựa chọn sách thú vị với giá ưu đãi.',
            'start_time' => '2024-08-21 00:08:21',
            'end_time' => '2024-11-20 23:00:00',
            'image' => 'https://res.cloudinary.com/dficfkyug/image/upload/v1724172262/hytqnd5wikob40cjlg4d.jpg',
            'status' => 'upcoming',
            'created_at' => '2024-08-20 16:44:27',
            'updated_at' => '2024-08-20 16:44:27',
            ],
        [
            'name' => 'Tặng quà khi đặt hàng trước',
            'location' => 'Online',
            'description' => 'Đặt hàng trước những cuốn sách mới sắp ra mắt và nhận ngay quà tặng đặc biệt từ nhà phát hành. Chương trình ưu đãi này được thiết kế riêng cho những khách hàng mong muốn sở hữu sớm những tác phẩm mới nhất, đồng thời nhận được những phần quà hấp dẫn. Đặt hàng trước vừa giúp bạn chắc chắn nhận được sách yêu thích, vừa nhận được nhiều ưu đãi đặc biệt.',
            'start_time' => '2024-08-21 00:08:34',
            'end_time' => '2024-12-05 23:00:00', 'image' => 'https://res.cloudinary.com/dficfkyug/image/upload/v1724172317/cofv3zc3ty9ifnnymcqu.jpg',
            'status' => 'upcoming',
            'created_at' => '2024-08-20 16:45:20',
            'updated_at' => '2024-08-20 16:45:20',
            ],

    ]);
    }
}
