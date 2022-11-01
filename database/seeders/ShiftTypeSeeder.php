<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShiftType;
class ShiftTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shiftTypes = ['Day','Night','Holiday'];

        foreach($shiftTypes as $shiftType){
            ShiftType::create([
                'shift' => $shiftType,
            ]);
        }
    }
}
