<?php

use Illuminate\Database\Seeder;

class seederData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [

            ['id' => 1, 'title' => 'Admin',],
            ['id' => 2, 'title' => 'Client',]

        ];

        foreach ($roles as $item) {
            \App\Role::create($item);
        }


        factory(\App\User::class,10)->create();
        factory(\App\Products::class,10)->create();
        factory(\App\Orders::class,10)->create();

    }
}
