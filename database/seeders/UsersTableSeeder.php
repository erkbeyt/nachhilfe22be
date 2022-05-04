<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tutor = new User;
        $tutor->firstName = 'Beytullah';
        $tutor->lastName = 'Erkol';
        $tutor->email = 'b.erkol@gmx.at';
        $tutor->password = bcrypt("beyt05");
        $tutor->study = 'KWM Hagenberg';
        $tutor->isTutor = true;
        $tutor->save();

        $tutor2 = new User;
        $tutor2->firstName = 'Franz';
        $tutor2->lastName = 'Loisl';
        $tutor2->email = 'tutor1@hgb.at';
        $tutor2->password = bcrypt("tut01");
        $tutor2->study = 'SE Hagenberg';
        $tutor2->isTutor = true;
        $tutor2->save();

        $student = new User;
        $student->firstName = 'Toni';
        $student->lastName = 'Eisenstöck';
        $student->email = 'student170996@hgb.at';
        $student->password = bcrypt("stu01");
        $student->study = 'KWM Hagenberg';
        $student->isTutor = false;
        $student->save();

        $student2 = new User;
        $student2->firstName = 'Moritz';
        $student2->lastName = 'Bertl';
        $student2->email = 'student170997@hgb.at';
        $student2->password = bcrypt("stu02");
        $student2->study = 'SE Hagenberg';
        $student2->isTutor = false;
        $student2->save();

//        DB::table('users')->insert([
//            'name' => "Klaus Maier",
//            'email' => "tutor1@hgb.at",
//            'password' => bcrypt("tutor1"),
//            'study' => "KWM Hagenberg",
//            'tutor' => true,
//            'created_at' => date("Y-m-d H:i:s"),
//            'updated_at' => date("Y-m-d H:i:s")
//        ]);
//
//        DB::table('users')->insert([
//            'name' => "Bettina Gruber",
//            'email' => "student170998@hgb.at",
//            'password' => bcrypt("student1"),
//            'study' => "KWM Hagenberg",
//            'tutor' => false,
//            'created_at' => date("Y-m-d H:i:s"),
//            'updated_at' => date("Y-m-d H:i:s")
//        ]);
//
//        DB::table('users')->insert([
//            'name' => "Moritz Bertl",
//            'email' => "student170997@hgb.at",
//            'password' => bcrypt("student2"),
//            'study' => "KWM Hagenberg",
//            'tutor' => false,
//            'created_at' => date("Y-m-d H:i:s"),
//            'updated_at' => date("Y-m-d H:i:s")
//        ]);
//
//        DB::table('users')->insert([
//            'name' => "Toni Eisenstöck",
//            'email' => "student170996@hgb.at",
//            'password' => bcrypt("student3"),
//            'study' => "HCI Hagenberg",
//            'tutor' => false,
//            'created_at' => date("Y-m-d H:i:s"),
//            'updated_at' => date("Y-m-d H:i:s")
//        ]);
//
//        DB::table('users')->insert([
//            'name' => "Franz Loisl",
//            'email' => "student170995@hgb.at",
//            'password' => bcrypt("student4"),
//            'study' => "SE Hagenberg",
//            'tutor' => true,
//            'created_at' => date("Y-m-d H:i:s"),
//            'updated_at' => date("Y-m-d H:i:s")
//        ]);




    }
}
