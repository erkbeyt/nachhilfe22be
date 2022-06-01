<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['tutorings','tutoringcomments'])->get();
        return $users;
    }

    public function indexById($userId){
        $user = User::with(['tutorings','tutoringcomments'])->find($userId);
        return $user;
    }

    /**
     * create new user
     */

    public function save(Request $request) : JsonResponse {
        DB::beginTransaction();
        try {
            $user = User::create($request->all());

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
                $user->update($request->all());
            }
            DB::commit();
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
