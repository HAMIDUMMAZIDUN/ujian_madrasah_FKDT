<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'Arjasari', 'email' => 'arjasari@email.com'],
            ['name' => 'Baleendah', 'email' => 'baleendah@email.com'],
            ['name' => 'Banjaran', 'email' => 'banjaran@email.com'],
            ['name' => 'Bojongsoang', 'email' => 'bojongsoang@email.com'],
            ['name' => 'Cangkuang', 'email' => 'cangkuang@email.com'],
            ['name' => 'Cicalengka', 'email' => 'cicalengka@email.com'],
            ['name' => 'Cikancung', 'email' => 'cikancung@email.com'],
            ['name' => 'Cilengkrang', 'email' => 'cilengkrang@email.com'],
            ['name' => 'Cileunyi', 'email' => 'cileunyi@email.com'],
            ['name' => 'Cimaung', 'email' => 'cimaung@email.com'],
            ['name' => 'Cimenyan', 'email' => 'cimenyan@email.com'],
            ['name' => 'Ciparay', 'email' => 'ciparay@email.com'],
            ['name' => 'Ciwidey', 'email' => 'ciwidey@email.com'],
            ['name' => 'Dayeuhkolot', 'email' => 'dayeuhkolot@email.com'],
            ['name' => 'Ibun', 'email' => 'ibun@email.com'],
            ['name' => 'Katapang', 'email' => 'katapang@email.com'],
            ['name' => 'Kertasari', 'email' => 'kertasari@email.com'],
            ['name' => 'Kutawaringin', 'email' => 'kutawaringin@email.com'],
            ['name' => 'Majalaya', 'email' => 'majalaya@email.com'],
            ['name' => 'Margaasih', 'email' => 'margaasih@email.com'],
            ['name' => 'Margahayu', 'email' => 'margahayu@email.com'],
            ['name' => 'Nagreg', 'email' => 'nagreg@email.com'],
            ['name' => 'Pacet', 'email' => 'pacet@email.com'],
            ['name' => 'Pameungpeuk', 'email' => 'pameungpeuk@email.com'],
            ['name' => 'Pangalengan', 'email' => 'pangalengan@email.com'],
            ['name' => 'Pasirjambu', 'email' => 'pasirjambu@email.com'],
            ['name' => 'Paseh', 'email' => 'paseh@email.com'],
            ['name' => 'Rancaekek', 'email' => 'rancaekek@email.com'],
            ['name' => 'Rancabali', 'email' => 'rancabali@email.com'],
            ['name' => 'Solokanjeruk', 'email' => 'solokanjeruk@email.com'],
            ['name' => 'Soreang', 'email' => 'soreang@email.com'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name'       => $user['name'],
                'email'      => $user['email'],
                'password'   => Hash::make('Password123'),
                'role'       => 'user',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
