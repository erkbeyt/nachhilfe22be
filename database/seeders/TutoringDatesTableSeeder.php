<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\TutoringDate;
use DateTime;

class TutoringDatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tudate = new TutoringDate();
        $tudate->tutoringdate = new DateTime();
        $tudate->booked = false;
        $tudate->accepted = false;
        $tudate->status = 'Neutral';
        $tudate->save();

        $tudate2 = new TutoringDate();
        $tudate2->tutoringdate = new DateTime();
        $tudate2->booked = true;
        $tudate2->accepted = true;
        $tudate2->status = 'Suchender ist nicht gekommen';
        $tudate2->save();
    }
}
