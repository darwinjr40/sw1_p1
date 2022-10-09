<?php

namespace Database\Seeders\data;

use App\Models\UserFile;
use Illuminate\Database\Seeder;

class UserFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserFile::create([
            'user_id' => 7,
            'url' => 'https://s3service12.s3.amazonaws.com/sw1_p1/userFile/7/OH8LGqrT0JPmgVB5BrMjInqdg4SETQFpr5E64XPX.jpg',
            'urlP' => 'sw1_p1/userFile/7/OH8LGqrT0JPmgVB5BrMjInqdg4SETQFpr5E64XPX.jpg'
        ]);
        UserFile::create([
            'user_id' => 7,
            'url' => 'https://s3service12.s3.amazonaws.com/sw1_p1/userFile/7/KVX04jr6Xx1OSPHki8JLHl2p2As00iTV4RLxGQqc.jpg',
            'urlP' => 'sw1_p1/userFile/7/KVX04jr6Xx1OSPHki8JLHl2p2As00iTV4RLxGQqc.jpg'
        ]);
        UserFile::create([
            'user_id' => 7,
            'url' => 'https://s3service12.s3.amazonaws.com/sw1_p1/userFile/7/qFe0qX9QEVvoojvtknv703jPO4HPKAR7fugnyuWs.jpg',
            'urlP' => 'sw1_p1/userFile/7/qFe0qX9QEVvoojvtknv703jPO4HPKAR7fugnyuWs.jpg'
        ]);
    }
}
