<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $this->userCreate();
            DB::commit();
            $this->command->info('User Create Successfully Done');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function userCreate()
    {
        $user = new User();
        $user->name = 'User';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('password');
        $user->save();
    }
}
