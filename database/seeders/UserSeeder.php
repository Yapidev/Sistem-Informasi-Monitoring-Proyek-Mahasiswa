<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── Mahasiswa ─────────────────────────
        $studentUser = User::create([
            'name' => 'Budi Mahasiswa',
            'email' => 'budi@student.test',
            'password' => Hash::make('12345678'),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $studentUser->id,
            'student_number' => '22010001',
            'name' => 'Budi Mahasiswa',
            'email' => 'budi@student.test',
            'phone' => '081234567890',
            'major' => 'D4 Teknik Komputer',
        ]);

        // ── Dosen ─────────────────────────────
        $lecturerUser = User::create([
            'name' => 'Siti Dosen',
            'email' => 'siti@lecturer.test',
            'password' => Hash::make('12345678'),
            'role' => 'lecturer',
        ]);

        Lecturer::create([
            'user_id' => $lecturerUser->id,
            'lecturer_number' => '19781234',
            'name' => 'Siti Dosen',
            'email' => 'siti@lecturer.test',
            'phone' => '089876543210',
        ]);
    }
}
