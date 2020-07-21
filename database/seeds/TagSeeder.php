<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Now Showing',
            'sort' => 1,
            'status' => true,
            'type' => 1,
        ]);
    }
}
