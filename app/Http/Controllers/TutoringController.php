<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use App\Models\TutoringDate;
use App\Models\TutoringComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class TutoringController extends Controller
{
    public function index(){
        $tutorings = Tutoring::with(['users','tutoringdates','tutoringcomments'])->get();
        return $tutorings;
    }

    public function save(Request $request) : JsonResponse {



        DB::beginTransaction();
        try {
            $tutoring = Tutoring::create($request->all());

            //save tutoringdates
            if(isset($request['tutoringdates']) && is_array($request['tutoringdates']))
            {
//                $request = $this->parseRequest($request);
                foreach ($request['tutoringdates'] as $tudate)
                {
                    $tud = TutoringDate::firstOrNew([
                        'tutoringdate' => new DateTime($tudate['tutoringdate']),
                        'booked' => $tudate['booked'],
                        'accepted'=> $tudate['accepted'],
                        'status'=> $tudate['status'],
                    ]);
                    $tutoring->tutoringdates()->save($tud);
                }
            }

            //save possible comments
            //TODO im Postman hinzufügen
            if(isset($request['tutoringcomments']) && is_array($request['tutoringcomments']))
            {
                foreach ($request['tutoringcomments'] as $tucom)
                {
                    $tucomment = TutoringComment::firstOrNew([
                        'comment' => $tucom['comment']
                    ]);
                    $tutoring->tutoringcomments()->save($tucomment);
                }
            }
            DB::commit();
            return response()->json($tutoring, 201);

        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving book failed:" . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, int $tutoringid) : JsonResponse
    {

        DB::beginTransaction();
        try {
            $tutoring = Tutoring::with(['users','tutoringdates','tutoringcomments'])
                ->find($tutoringid);
            if ($tutoring != null) {
//                $request = $this->parseRequest($request);
                $tutoring->update($request->all());

//                delete all old dates
                $tutoring->tutoringdates()->delete();
//                 save dates
                if (isset($request['tutoringdates']) && is_array($request['tutoringdates'])) {
                    foreach ($request['tutoringdates'] as $tudate) {
                        $tutoringdate = TutoringDate::firstOrNew([
                            'tutoringdate' => new DateTime($tudate['tutoringdate']),
                            'booked' => $tudate['booked'],
                            'accepted'=> $tudate['accepted'],
                            'status'=> $tudate['status'],
                        ]);
                        $tutoring->tutoringdates()->save($tutoringdate);
                    }
                }
                //update authors

//                $ids = [];
//                if (isset($request['authors']) && is_array($request['authors'])) {
//                    foreach ($request['authors'] as $auth) {
//                        array_push($ids,$auth['id']);
//                    }
//                }
//                $book->authors()->sync($ids);
                $tutoring->save();

            }
            DB::commit();
//            $book1 = Book::with(['authors', 'images', 'user'])
//                ->where('isbn', $isbn)->first();
            // return a vaild http response
            return response()->json($tutoring, 201);
        }
        catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating user failed: " . $e->getMessage(), 420);
        }
    }


    /**
     * returns 200 if tutoring deleted successfully, throws excpetion if not
     */
    public function delete(string $tutoringid) : JsonResponse
    {
        $tutoring = Tutoring::find($tutoringid);
        if ($tutoring != null) {
            $tutoring->delete();
        }
        else
            throw new \Exception("user couldn't be deleted - it does not exist");
        return response()->json('Tutoring ' . $tutoring->subject . ' successfully deleted', 200);
    }

    private function parseRequest(Request $request):Request
    {
        $date = new DateTime($request->tutoringdate);
        $request['tutoringdate']=$date;
        return $request;
    }
}
