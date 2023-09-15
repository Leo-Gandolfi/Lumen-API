<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController 
{

    public function index()
    {
        return Post::all();
    }

    public function searchPost($id)
    {
        $post = Post::find($id);
        if ($post)
        {
            return response()->json($post);
        }
        else{
            return response()->json(['status' => 'error', 'message' => 'erro ao achar postagem, provavelmente foi deletada']);
        }
    }

    public function store(Request $request)
    {
        try{
            $post = new Post();
            $post->name = $request->name;
            $post->message = $request->message;

            if($post->save()){
                return response()->json(['status'=> 'sucesso', 'message' => 'Postagem criada!']);
            }

        }
        catch (\Exception $e){
            return response()->json(['status' => 'erro', 'message' => $e->getMessage()]); 
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $post = Post::findOrFail($id);
            $post->name = $request->name;
            $post->message = $request->message;

            if($post->save()){
                return response()->json(['status'=> 'sucesso', 'message' => 'Postagem atualizada!']);
            }

        }
        catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]); 
        }
    }

    public function delete($id)
    {
        try{
            $post = Post::findOrFail($id);

            if($post->delete()){
                return response()->json(['status'=> 'sucesso', 'message' => 'Postagem deletada!']);
            }

        }
        catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]); 
        }
    }
}
