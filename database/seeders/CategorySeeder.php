<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Tambahkan ini

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan pemeriksaan foreign key sementara
        Schema::disableForeignKeyConstraints();

        // Hapus data lama untuk menghindari duplikasi saat seeding ulang
        DB::table('categories')->truncate();

        // Aktifkan kembali pemeriksaan foreign key
        Schema::enableForeignKeyConstraints();

        // Menambahkan data berdasarkan enum dari tabel project, dengan deskripsi
        DB::table('categories')->insert([
            [
                'name' => 'PKM',
                'description' => 'Proyek yang terkait dengan Program Kreativitas Mahasiswa, mencakup penelitian, pengabdian, dan inovasi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lomba',
                'description' => 'Proyek yang dikerjakan untuk mengikuti kompetisi atau perlombaan akademik maupun non-akademik.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Riset',
                'description' => 'Kegiatan penelitian ilmiah yang mendalam untuk mengembangkan ilmu pengetahuan atau teknologi.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Magang',
                'description' => 'Proyek atau tugas yang dikerjakan selama periode magang atau kerja praktik di sebuah institusi atau perusahaan.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mandiri',
                'description' => 'Proyek pribadi atau independen yang diinisiasi untuk eksplorasi, pembelajaran, atau pengembangan portofolio.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

