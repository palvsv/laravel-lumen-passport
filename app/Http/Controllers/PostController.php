<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index()
    {
        # code...
        return post::all();
    }

    public function store(Request $request)
    {
        # code...
        try {
            $post = new post();
            $post->title = $request->title;
            $post->body = $request->body;

            if ($post->save()) {
                return response()->json(['status'=>'success','message'=>'Post has been created Successfully']);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'error','message'=>$th->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $post =post::findOrFail($id);
            $post->title = $request->title;
            $post->body = $request->body;

            if ($post->update()) {
                return response()->json(['status'=>'success','message'=>'Post Updated Successfully']);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'error','message'=>$th->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $post = post::find($id);

            if ($post->delete()) {

                return response()->json(["status"=>"success","message"=>"Post deleted successfully"]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["status"=>"error","message"=> $th->getMessage()]);

        }

    }
}
