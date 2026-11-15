<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Buku\Models\Buku;
use Modules\Peminjaman\Models\Peminjaman;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        $daftarBuku = [
            ['Laravel 12 untuk Pemula', 'Rina Aprilia', 'Informatika Press', 2025, 10],
            ['Pemrograman Web dengan PHP', 'Budi Santoso', 'Andi Offset', 2022, 8],
            ['Basis Data Relasional', 'Dewi Lestari', 'Erlangga', 2021, 5],
            ['Algoritma dan Struktur Data', 'Ahmad Fauzi', 'Gramedia', 2020, 7],
            ['Jaringan Komputer', 'Siti Nurhaliza', 'Informatika Bandung', 2019, 4],
            ['Rekayasa Perangkat Lunak', 'Hendra Wijaya', 'Deepublish', 2023, 6],
            ['Dasar-Dasar JavaScript', 'Maya Sari', 'Elex Media', 2024, 9],
            ['Sistem Operasi', 'Rudi Hartono', 'Andi Offset', 2018, 3],
        ];

        foreach ($daftarBuku as [$judul, $penulis, $penerbit, $tahun, $stok]) {
            Buku::create([
                'judul' => $judul,
                'penulis' => $penulis,
                'penerbit' => $penerbit,
                'tahun_terbit' => $tahun,
                'stok' => $stok,
            ]);
        }

        $daftarPeminjaman = [
            ['Andi Pratama', 'Laravel 12 untuk Pemula', '2026-11-01', '2026-11-08', 'Dipinjam'],
            ['Bunga Citra', 'Basis Data Relasional', '2026-10-25', '2026-11-01', 'Dikembalikan'],
            ['Cahyo Nugroho', 'Jaringan Komputer', '2026-11-03', '2026-11-10', 'Dipinjam'],
            ['Dina Marlina', 'Sistem Operasi', '2026-10-28', '2026-11-04', 'Dikembalikan'],
            ['Eko Saputra', 'Dasar-Dasar JavaScript', '2026-11-05', '2026-11-12', 'Dipinjam'],
        ];

        foreach ($daftarPeminjaman as [$nama, $judul, $pinjam, $kembali, $status]) {
            Peminjaman::create([
                'nama_peminjam' => $nama,
                'judul_buku' => $judul,
                'tanggal_pinjam' => $pinjam,
                'tanggal_kembali' => $kembali,
                'status' => $status,
            ]);
        }
    }
}