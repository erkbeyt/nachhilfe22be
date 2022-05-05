<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\TutoringDate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutoringDateController extends Controller
{
    public function index(){
        $tutoringdate = TutoringDate::with(['tutoring'])->get();
        return $tutoringdate;
    }

    public function update(Request $request, int $tutoringdateId) : JsonResponse
    {

        DB::beginTransaction();
        try {
            $tutoringdate = TutoringDate::with(['tutoring'])
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
    private function parseRequest(Request $request):Request
    {
        $date = new DateTime($request->tutoringdate);
        $request['tutoringdate']=$date;
        return $request;
    }

}
