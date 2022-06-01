<?php

namespace Database\Seeders;

use App\Models\Tutoring;
use App\Models\User;
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
        $tudate->user_id= '4';
        $tudate->tutoring_id = '1';
        $tudate->save();

        $tutoring = Tutoring::where('id','2')->get();
        $tudate->tutoring()->associate($tutoring);
        $tudate->save();

        $user = User::where('id','4')->get();
        $tudate->user()->associate($user);
        $tudate->save();

//        $tudate2 = new TutoringDate();
//        $tudate2->tutoringdate = new DateTime();
//        $tudate2->booked = true;
//        $tudate2->accepted = true;
//        $tudate2->status = 'Suchender ist nicht gekommen';
//        $tudate2->save();

//        $user2 = User::where('id','4')->get();
//        $tudate2->user()->associate($user2);
//        $tudate2->save();
    }
}
