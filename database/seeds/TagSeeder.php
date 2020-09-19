<?php

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
        for ($n=0;$n<5;$n++) {
            for ($i = 0; $i < 1000; $i++) {
                DB::table('business_profile_tags')->insert([
                    'business_id' => $i + 1,
                    'tag' => '#' . Str::random(10)
                ]);
            }
        }
    }
}
