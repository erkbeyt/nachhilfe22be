<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\TutoringComment;
use App\Models\User;

class TutoringCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tucomment = new TutoringComment();
        $tucomment->comment = 'Anfrage ob ein Termin am 15.Mai verfügbar wäre';
//        $tucomment->tutoingid = '1';
//        $tucomment->userid = '3';
//        dd($user);
        $tucomment->save();
        $user = User::where('id','3')->get();
        $tucomment->user()->associate($user);
        $tucomment->save();

        $tucomment2 = new TutoringComment();
        $tucomment2->comment = 'Anfrage ob ein Termin am 20.Mai verfügbar wäre';
//        $tucomment2->tutoing_id = '1';
//        $tucomment2->user_id = '3';
//        $tucomment2->user()->associate($user);
        $tucomment2->save();
    }
}
