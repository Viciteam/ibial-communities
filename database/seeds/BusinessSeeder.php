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
        for ($i=0;$i<1000;$i++){
            DB::table('business')->insert([
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
                'name' => Str::random(10) . ' BIZ',
                'tag_line' => 'Tag line here - ' . Str::random(10),
                'tags' => 'SPORTS,ENTERTAINMENT',
                'business_email' => Str::random(10) . 'biz@gmail.com',
                'created_at' => Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s'),
                'country' => 'United States'
            ]);
        }

    }
}
