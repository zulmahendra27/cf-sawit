<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $symptoms = [
            ['G001', 'Tanaman tumbuh abnormal dan lemah'],
            ['G002', 'Daun bibit menjadi kusam kekuningan dimulai dari ujung daun'],
            ['G003', 'Daun menjadi layu'],
            ['G004', 'Daun berubah warna menjadi kuning cerah dan timbul bercak-bercak'],
            ['G005', 'Akar menjadi lunak'],
            ['G006', 'Daun berwarna hijau pucat'],
            ['G007', 'Daun mengalami perubahan warna daun (nekrosis) yang dimulai dari bagian daun paling tua menyebar ke bagian yang lebih  muda'],
            ['G008', 'Pelepah daun akan patah dan menggantung'],
            ['G009', 'Daun tombak (pupus) yang baru muncul tidak membuka'],
            ['G010', 'Daun tombak berkumpul lebih dari tiga helai'],
            ['G011', 'Jamur yang terbentuk sedikit'],
            ['G012', 'Jaringan pada kuncup (spear) membusuk'],
            ['G013', 'Jaringan pada kuncup berwarna kecoklat-coklatan'],
            ['G014', 'Setelah dewasa, kuncup akan bengkok dan melengkung'],
            ['G015', 'Daun menjadi kering'],
            ['G016', 'Daun yang terserang akhirnya mengalami kematian'],
            ['G017', 'Pada daun yang terserang, tampak bercak-bercak lonjong'],
            ['G018', 'Bercak berwarna kuning'],
            ['G019', 'Ditengah-tengah bercak berwarna coklat'],
            ['G020', 'Menyerang pada saat bagian ujung daun belum membuka'],
            ['G021', 'Menyebar kehelai lain yang telah terbuka'],
            ['G022', 'Helai daun bagian tengah pelepah berukuran kecil-kecil dan sobek'],
            ['G023', 'Helai daun tidak ada sama sekali'],
            ['G024', 'Pada tanaman berumur 2-4 tahun jaringan yang terinfeksi pada pelepah yang tidak membuka berwarna coklat kemerah-merahan'],
            ['G025', 'Pelepah bengkok dan tidak berhelai daun'],
            ['G026', 'Terdapat Miselium berwarna putih diantara buah masak atau pangkal pelepah daun'],
            ['G027', 'Miselium tersebut akan menutupi kulit buah 2-4 bulan setelah antesis'],
            ['G028', 'Menyerang pangkal buah'],
            ['G029', 'Menyerang daging buah (mesokarp)'],
            ['G030', 'Perikarp menjadi lembek dan busuk'],
            ['G031', 'Warna buah menjadi kecoklatan dan berubah lagi menjadi kehitaman']
        ];

        foreach ($symptoms as $symptom) {
            Symptom::create([
                'uuid' => Str::uuid(),
                'kode' => $symptom[0],
                'gejala' => $symptom[1]
            ]);
        }
    }
}
