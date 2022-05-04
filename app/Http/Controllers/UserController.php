<?php

namespace App\Http\Controllers;

use App\Models\Tutoring;
use App\Models\TutoringComment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['tutorings','tutoringcomments'])->get();
        return $users;
    }

    /**
     * create new user
     */

    public function save(Request $request) : JsonResponse {

//        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $user = User::create($request->all());

            //save tutorings
//            if(isset($request['tutorings']) && is_array($request['tutorings']))
//            {
//                foreach ($request['tutorings'] as $tu)
//                {
//                    $tutoring = Tutoring::firstOrNew([
//                        'study' => $tu['study'],
//                        'description'=> $tu['description']
//                    ]);
//                    $user->tutorings()->save($tutoring);
//                }
//            }
//
//            //save possible comments
//            if(isset($request['tutoringcomments']) && is_array($request['tutoringcomments']))
//            {
//                foreach ($request['tutoringcomments'] as $tucom)
//                {
//                    $tucomment = TutoringComment::firstOrNew([
//                        'comment' => $tucom['comment']
//                    ]);
//                    $user->tutoringcomments()->save($tucomment);
//                }
//            }
            DB::commit();
            return response()->json($user, 201);

        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving book failed:" . $e->getMessage(), 420);
        }

    }

    public function update(Request $request, int $userid) : JsonResponse
    {

        DB::beginTransaction();
        try {
            $user = User::with(['tutorings','tutoringcomments'])
                ->find($userid);
            if ($user != null) {
//                $request = $this->parseRequest($request);
                $user->update($request->all());

                //delete all old images
//                $book->images()->delete();
                // save images
//                if (isset($request['images']) && is_array($request['images'])) {
//                    foreach ($request['images'] as $img) {
//                        $image = Image::firstOrNew(['url'=>$img['url'],'title'=>$img['title']]);
//                        $book->images()->save($image);
//                    }
//                }
                //update authors

//                $ids = [];
//                if (isset($request['authors']) && is_array($request['authors'])) {
//                    foreach ($request['authors'] as $auth) {
//                        array_push($ids,$auth['id']);
//                    }
//                }
//                $book->authors()->sync($ids);
                //$user->save();

            }
            DB::commit();
//            $book1 = Book::with(['authors', 'images', 'user'])
//                ->where('isbn', $isbn)->first();
            // return a vaild http response
            return response()->json($user, 201);
        }
        catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating user failed: " . $e->getMessage(), 420);
        }
    }

    /**
     * returns 200 if user deleted successfully, throws excpetion if not
     */
    public function delete(string $userid) : JsonResponse
    {
        $user = User::find($userid);
        if ($user != null) {
            $user->delete();
        }
        else
            throw new \Exception("user couldn't be deleted - it does not exist");
        return response()->json('user was ' . $user->firstName . ' successfully deleted', 200);
    }

}
