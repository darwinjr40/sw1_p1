<?php

namespace Database\Seeders\data;

use App\Models\EventFile;
use App\Models\PaperFile;
use Illuminate\Database\Seeder;

class EventFileSeeder extends Seeder
{
 

    public function run() 
    {
        EventFile::create([
            'event_id' => 1,
            'url' => 'https://s3service12.s3.amazonaws.com/1/1CguGn7CyUSS7frwteOB37yTiLtCUq6zWwlcCdTX.jpg',
            'urlP' => '1/1CguGn7CyUSS7frwteOB37yTiLtCUq6zWwlcCdTX.jpg'
        ]);
        EventFile::create([
            'event_id' => 2,
            'url' => 'https://s3service12.s3.amazonaws.com/1/YR8QNIrE2rOq0aN320ctis4ZftrXv5guAW3acc9A.jpg',
            'urlP' => '1/YR8QNIrE2rOq0aN320ctis4ZftrXv5guAW3acc9A.jpg'
        ]);
        EventFile::create([
            'event_id' => 3,
            'url' => 'https://s3service12.s3.amazonaws.com/1/QEybepluhsVHUFsNReE5k3X7zFU8nfp5Bau0ViHQ.webp',
            'urlP' => '1/QEybepluhsVHUFsNReE5k3X7zFU8nfp5Bau0ViHQ.webp'
        ]);


        
    }
}
