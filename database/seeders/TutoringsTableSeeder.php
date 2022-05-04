<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Tutoring;
use App\Models\TutoringDate;
use App\Models\TutoringComment;
use DateTime;

class TutoringsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tu = new Tutoring();
        $tu->subject = 'E-Learning';
        $tu->description = 'WBT und E-Front';
        $tu->save();

        $tu2 = new Tutoring();
        $tu2->subject = 'Programmieren';
        $tu2->description = '9 Einheiten Phyton';
        $tu2->save();

        $tu3 = new Tutoring();
        $tu3->subject = 'Grafik und Formate';
        $tu3->description = 'Adobe Photoshop und  Premiere Pro';
        $tu3->save();

        $tu4 = new Tutoring();
        $tu4->subject = 'Web-Programmierung';
        $tu4->description = 'Gemeinsam programmieren wir eine Single Page App';
        $tu4->save();

        //Tutoring inserting Dates and Comments
        $tudate = new TutoringDate();
        $tudate->tutoringdate = new DateTime();
        $tudate->booked = false;
        $tudate->accepted = false;
        $tudate->status = 'Neutral';

        $tudate2 = new TutoringDate();
        $tudate2->tutoringdate = new DateTime();
        $tudate2->booked = true;
        $tudate2->accepted = true;
        $tudate2->status = 'Suchender ist nicht gekommen';

        $tu4->tutoringdates()->saveMany([$tudate,$tudate2]);

        $tu4->save();

        $tucomment = new TutoringComment();
        $tucomment->comment = 'Anfrage ob ein Termin am 15.Mai verfügbar wäre';
        $tucomment->tutoring()->associate($tu4);
//        $studentx = User::where('id','2')->get();
//        $stu = User::all()->first();
//        find(primary_key) liefert model vom object
        $stu = User::all()->find(3);
        $tucomment->user()->associate($stu);
        $tucomment->save();

//        $tucomment2 = new TutoringComment();
//        $tucomment2->comment = 'Anfrage ob ein Termin am 20.Mai verfügbar wäre';
//        $tucomment2->tutoring()->associate($tu4);
//        $tucomment2->save();

        $tu4->tutoringcomments()->saveMany([$tucomment]);
        $tu4->save();
//
//        $student1 = User::all()
//            ->where('id', '3')
//            ->pluck('id');
//        $test = new User($student1);
//        $test->tutoringcomments()->associate($student1);
//        $test->save();

        $student1 = User::all()
            ->where('isTutor',true)
            ->where('id', '1')
            ->pluck('id');
        $student = User::where('id','2')->get();
        $tu4->users()->sync($student);
        $tu->users()->sync($student);
        $tu3->users()->sync($student1);
        $tu2->users()->sync($student1);
        $tu->save();
        $tu2->save();
        $tu4->save();
        $tu3->save();

//        $users = User::all()->pluck("id");

//        $student2 = User::all()->pluck('name','id');

//        dd($student);
//        dd($student1);

    }
}
