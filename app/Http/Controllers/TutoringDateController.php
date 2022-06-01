<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use App\Models\User;
use DateTime;
use App\Models\TutoringDate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutoringDateController extends Controller
{
    public function index(){
        $tutoringdate = TutoringDate::with(['user','tutoring'])->get();
        return $tutoringdate;
    }

    public function save(Request $request) : JsonResponse {
        DB::beginTransaction();
        try {
            $tutoringdate = TutoringDate::create($request->all());

            //save tutoring offer
            if(isset($request['tutoringid']))
            {
                $tutoring = Tutoring::find($request->input('tutoringid'));
                $tutoringdate->tutoring()->associate($tutoring);
                $tutoringdate->save();
            }

            //save student who booked tutoring
            if(isset($request['userid']))
            {
                $user = User::find($request->input('userid'));
                $tutoringdate->user()->associate($user);
                $tutoringdate->save();
            }

            DB::commit();
            return response()->json($tutoringdate, 201);

        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving tutoringdate failed:" . $e->getMessage(), 420);
        }
    }


    public function update(Request $request, int $tutoringdateId) : JsonResponse
    {

        DB::beginTransaction();
        try {
            $tutoringdate = TutoringDate::with(['tutoring','user'])
                ->find($tutoringdateId);
            if ($tutoringdate != null) {
                $request = $this->parseRequest($request);
                $tutoringdate->update($request->all());
                $tutoringdate->save();
            }
            DB::commit();
            // return a vaild http response
            return response()->json($tutoringdate, 201);
        }
        catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating tutoringdate failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(string $tutoringdateid) : JsonResponse
    {
        $tutoringdate = TutoringDate::find($tutoringdateid);
        if ($tutoringdate != null) {
            $tutoringdate->delete();
        }
        else
            throw new \Exception("tutoringdate couldn't be deleted - it does not exist");
        return response()->json('Tutoring Date: ' . $tutoringdate->tutoringdate . ' successfully deleted', 200);
    }

    private function parseRequest(Request $request):Request
    {
        $date = new DateTime($request->tutoringdate);
        $request['tutoringdate']=$date;
        return $request;
    }

}
