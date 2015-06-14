<?php

use App\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        Model::unguard();

        // $this->call('UserTableSeeder');

        User::create(['email' => 'sa@localhost', 'password' => bcrypt('opensource')]);
    }

}
