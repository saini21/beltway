<?php

use Migrations\AbstractSeed;

/**
 * Hashtags Seed
 */
class AdminsSeed extends AbstractSeed {

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run() {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'satwinder.singh.21@gmail.com',
                'password' => '$2y$10$xHM/piNh8WcbC7rK3BxsNuQNz840XBBeTtuK4pS5Bnd2KVWBUx5Dm',//'admin',
            ]
        ];

        $table = $this->table('admins');

        $table->insert($data)->save();
    }
}
