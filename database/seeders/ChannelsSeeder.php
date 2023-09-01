<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Channel;

class ChannelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $channels = [
            'Udemat',
            'Facultad de Psicología',
        ];

        foreach ($channels as $channel) {
            Channel::create([
                'name' => $channel,
            ]);
        }
    }
}
