<?php

use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business')->insert([
            'id' => 999,
            'is_private' => 0,
            'is_visible' => 1,
            'status_id' => 5,
            'views' => 1,
            'created_by' => 1,
            'category' => 'flower',
            'address' => '4761  Wood Duck Drive',
            'city' => 'Cornell',
            'state' => 'MI',
            'zip' => '49818',
            'contact_no' => '906-384-1165',
            'profile_picture' => '1_profile.png',
            'cover_photo' => '1_cover_photo.png',
            'name' => 'EDU BIZ',
            'tag_line' => 'Something for nothing.',
            'tags' => 'SPORTS,ENTERTAINMENT',
            'business_email' => 'edbiz@gmail.com',
            'created_at' => Date('Y-m-d H:i:s'),
            'updated_at' => Date('Y-m-d H:i:s')
        ]);
    }
}
