<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use App\Models\TutoringComment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutoringCommentController extends Controller
{
    public function index(){
        $tutoringcom = TutoringComment::with(['user','tutoring'])->get();
        return $tutoringcom;
    }

    public function save(Request $request) : JsonResponse {
        DB::beginTransaction();
        try {
            $tutoringcomment = TutoringComment::create([
                'comment' => $request->input('comment'),
                'tutoring_id' => $request->input('tutoringid'),
                'user_id' => $request->input('userid')
            ]);
            DB::commit();
            return response()->json($tutoringcomment, 201);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving tutoringcomment failed:" . $e->getMessage(), 420);
        }
    }

}
