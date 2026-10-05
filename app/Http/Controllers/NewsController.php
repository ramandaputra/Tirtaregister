<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // Berita Sorotan / Featured
        $featuredNews = [
            'title' => 'Optimalisasi Pompa Distribusi IPA Kolong Enam Guna Tingkatkan Tekanan Air ke Wilayah Pesisir Kota Rebah',
            'date' => '16 Mei 2025',
            'read_time' => '3 Menit Baca',
            'excerpt' => 'Menjawab aspirasi pelanggan di kawasan dataran tinggi dan pesisir Kota Rebah, teknisi PERUMDA Tirta Kepri berhasil merampungkan kalibrasi booster pump 90 kW di IPA Kolong Enam.',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBFpzfQ-zAi8N7AKHCIIzyHn2YuM0qwB2DMQm8yLrLO7KTmYBLF-wD9Iz7GHt3LYkFAvuuiplAppDCG-_VjCr0id_hpK1UXJbQWPfKevGATM5OlUb8LPEmoVGLm9LEVG9E5Fq5g7OfvVtsw3owUe8lLrcfHIfq3Y-3kjmDKhPmZe9os5AAOwqE5XbFUSXv__IShTCAAEIkwlAablQZ_NUz3RYe6jSC1OIsHsjfo_NQTen7FkojA142izg',
            'benefit_households' => '1.450 Sambungan Rumah',
            'benefit_areas' => 'Kelurahan Sei Jang, Kampung Bugis & Pesisir Barat.'
        ];

        // Daftar Berita/Pengumuman
        $newsList = [
            [
                'id' => 1,
                'category' => 'gangguan',
                'category_label' => 'Gangguan Aliran',
                'category_bg' => 'bg-civic-amber text-on-surface',
                'date' => '15 Mei 2025',
                'title' => 'Jadwal Intermittent Distribusi Air Bersih Wilayah Bintan Center Sehubungan Pembersihan Bak Sedimentasi',
                'excerpt' => 'Pembersihan rutin bak penampungan sedimen IPA Gesek dilakukan bertahap guna menjaga standar kejernihan air minum sesuai Permenkes.',
                'status_info' => 'Estimasi: 8 Jam',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDIovxMQp_38nhM0Ue27Hb2WcP_wnxJHvu4w5eXSHeQ00-S5wYjuagNM1Nn9wNoxyHptVbD_fpUd4VoD4upOUQpwa5b00SzU_5hYKyztuGbTKRfGNY3WrEaTRwtRQsAWNwjt2ENtSe6nwDSFCJWt5yzdZA-UJOKhbvxoPw4SDxlcbkN6ykOGlsINdLArXATyaBqiETY5-Sx-bUyeG7jiibEevAd7-6SVtPMiWHr0-0x8PDSCxYrzGIzqg'
            ],
            [
                'id' => 2,
                'category' => 'kegiatan',
                'category_label' => 'Berita Kegiatan',
                'category_bg' => 'bg-primary-fixed text-on-primary-fixed-variant',
                'date' => '13 Mei 2025',
                'title' => 'PERUMDA Tirta Kepri Gandeng BPKP Kepri Perkuat Tata Kelola dan Transparansi Layanan Publik',
                'excerpt' => 'Penandatanganan komitmen bersama dalam pengawasan Good Corporate Governance (GCG) untuk akuntabilitas operasional.',
                'status_info' => 'Kantor Pusat Tanjungpinang',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBlEtlY7kLCifXb3IrJAGNI1Mqdj8nlerBXyszHafo4sare7dyhmF2S-I8YB4c7wVV3lcKD43Z5HpgWbV896NH5DntXkoa6mO-BMOzEEU9FQbmJf7nw_2nKNMb8--GoI6iIWgTYTJq-CrtVAK-dLBqy0wWC367JaS0mB5InjXSkwR9UfDfqHTekTa4tmfmVKPeORkE6HnQnEo2u_1W77qog-IvKpxRtTmuvxE13UxfHgB3hocYX8xGXlA'
            ],
            [
                'id' => 3,
                'category' => 'layanan',
                'category_label' => 'Layanan Pelanggan',
                'category_bg' => 'bg-status-success/15 text-status-success',
                'date' => '10 Mei 2025',
                'title' => 'Sosialisasi Kemudahan Pembayaran Rekening Air Bersih Melalui Mobile Banking & QRIS Nasional',
                'excerpt' => 'Kini pelanggan di pulau-pulau dapat melunasi tagihan bulanan tepat waktu tanpa antre di loket melalui 20+ kanal perbankan.',
                'status_info' => 'Bebas Antre',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDozzfU-mZTxEvYx-HdEFdh3MqXSOAybaTamz6Cf6PbNE0xIV2LL5AKuoXJte9onIZERVMkNN7Ye8PJGmhSJi8bTBG-7nG5j_Jb6s9kR7HwlP-RZnF7BBAohgSo88PE7S4Jrg06-KF0lrtEvGbo8n52Z3hqpgJLOxY9KBRYIbOJlUU1F02kr9nbo1tDhCcvPEWDrzXzPmJdZfnZSb4yStAQyOwH0JbQ8CqsGr3MCQokbXAnrS-alS1rjQ'
            ],
            [
                'id' => 4,
                'category' => 'gangguan',
                'category_label' => 'Pengumuman',
                'category_bg' => 'bg-primary-container text-on-primary-container',
                'date' => '07 Mei 2025',
                'title' => 'Himbauan Penghematan dan Penampungan Air Selama Periode Musim Kemarau di Pulau Bintan',
                'excerpt' => 'Menjaga kestabilan debit waduk Sei Pulai dan Kolong Enam, masyarakat dianjurkan menampung air secara bijak.',
                'status_info' => 'Wilayah: Bintan & Tanjungpinang',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAw0aY1gVD2qUUVwNLA3cX5zUbWQ_HcwNMLOw-FJdRq1T9gWJXFLZ9lpxWy18YDuKKwfpCl-br8tYZ-BHuFSXYCgtVfJhTh8wIOOt_LmajANlltQOgkYAiF2fu4WdFQJPx0b44_ZPJQrAsFO3uzbVEyGInhUeJ2F4WjegtSsoiNsvvjVMT-vjjMyVfG7ScVNJ9c5l28_-wlW4mQYnUDIH3_aSOmn7MP8_xbI08BPvgVqIpdKuJHOzcnhg'
            ],
            [
                'id' => 5,
                'category' => 'kegiatan',
                'category_label' => 'Infrastruktur',
                'category_bg' => 'bg-secondary-fixed text-on-secondary-fixed',
                'date' => '03 Mei 2025',
                'title' => 'Penyelesaian Pemasangan Jaringan Pipa Distribusi Baru Sepanjang 4,2 KM di Kawasan Pusat Pemprov Dompak',
                'excerpt' => 'Ekspansi pipa transmisi HDPE 300 mm memastikan suplai air bersih ke perkantoran dan pemukiman Dompak terjamin.',
                'status_info' => 'Kawasan Dompak',
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD8lSUweS1ll5j5huUnzTWcP-Q4U8hrLi7AF8X_X4gJDaY8bVM-mSDGoEp6cEMFVuh38CikheCPECTezNOqa5vpp8uCXvw0YfCJX-Xub1nL0hi-FZTUs2pDZYKHZFS9jcIWf0aQqKk97wVbHw1WJ9pXBK49QAfwjuxMIcSWIP_yb47g3n_HWTmX-Cj0pTZwsebyGQewIQKrBtEI7OxRSuHNRhw8XjUOH7_6oNlF8CEPa-Sc7edtMbc5DQ'
            ]
        ];

        return view('pages.news', compact('featuredNews', 'newsList'));
    }
}