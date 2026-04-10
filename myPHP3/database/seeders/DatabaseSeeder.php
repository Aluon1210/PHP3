<?php



namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \DB::table('users')->insert([
            'name' => 'Vui từng phút giây',
            'email' => 'vuiqua@gmail.com',
            'password' => bcrypt('thanhcong'),
            'isgroup' => 1,
            'active' => 1,
            'activation_token' => null,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('users')->insert([
            'name' => 'Nguyễn Thị Gia Huy',
            'email' => 'giahuy@gmail.com',
            'password' => bcrypt('thanhcong'),
            'active' => 1,
            'activation_token' => null,
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('users')->insert([
            'name' => 'Buồn từng phút giây',
            'email' => 'buonqua@gmail.com',
            'password' => bcrypt('thanhcong'),
            'isgroup' => 1,
            'active' => 1,
            'activation_token' => null,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call([
            chenLoaisp::class,
            chendienthoai::class,
            chenthanhvien::class,
        ]);


        \DB::table('loaitin')->insert([
            ['ten' => 'Xã hội', 'thuTu' => 1, 'AnHien' => 1, 'lang' => 'vi', 'created_at' => now(), 'updated_at' => now()],
            ['ten' => 'Du lịch', 'thuTu' => 2, 'AnHien' => 1, 'lang' => 'vi', 'created_at' => now(), 'updated_at' => now()],
            ['ten' => 'Sống đẹp', 'thuTu' => 3, 'AnHien' => 1, 'lang' => 'vi', 'created_at' => now(), 'updated_at' => now()],
        ]);

        \DB::table('tin')->insert([
            [
                'tieuDe' => 'Hoàng hôn trên sông Mê Kông',
                'tomTat' => 'Khung cảnh hoàng hôn tuyệt đẹp trên dòng sông Mê Kông.',
                'urlHinh' => null,
                'ngayDang' => now(),
                'idLT' => 2,
                'xem' => 47,
                'noiBat' => 1,
                'anhien' => 1,
                'tag' => 'dulich',
                'lang' => 'vi',
                'noiDung' => '<p>Nội dung demo.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tieuDe' => 'Tận cùng nỗi đau',
                'tomTat' => 'Một câu chuyện giàu cảm xúc và nhiều suy ngẫm.',
                'urlHinh' => null,
                'ngayDang' => now(),
                'idLT' => 1,
                'xem' => 63,
                'noiBat' => 0,
                'anhien' => 1,
                'tag' => 'xahoi',
                'lang' => 'vi',
                'noiDung' => '<p>Nội dung demo.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
