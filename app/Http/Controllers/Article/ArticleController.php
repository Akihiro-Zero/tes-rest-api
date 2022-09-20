<?php

namespace App\Http\Controllers\Article;

use Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article\Article;
use Exception;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::get();
        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // @dd($request['title']);
        $request->validate([
            'title' => ['required','min:3','max:255'],
            'body' => ['required'],
            'subject' => ['required'],
        ]);

        $articles = auth()->user()->articles()->create([
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'body' => request('body'),
            'subject_id' => request('subject')
        ]);
        return $articles;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //dd($article);
        try{
            $show = Article::where('slug',$slug)->first();

            return response([
                'status' => 'succes',
                'article' => new ArticleResource($show),
            ]);
            return new ArticleResource($show);

        }catch(Exception $e){
            echo $e->getMessage(). "Pada baris". $e->getLine();
        }
        // return $article;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // @dd($request['title'],$slug);
        // $validate = $request->validate([
        //     'title' => ['required','min:3','max:255'],
        //     'body' => ['required'],
        //     'subject' => ['required'],
        // ]);
        echo "test";

            $update = Article::where('slug',$slug)->first();
            // return new ArticleResource($show);
            $update->update([
                    'title' => request('title'),
                    'slug' => \Str::slug(request('title')),
                    'body' => request('body'),
                    'subject_id' => request('subject')
                ]);
            echo "Succes";
            return $update;

            // return "Ada Kesalahan Validasi";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Article::where('slug',$slug)->first()->delete();
        return response()->json("the article was deleted",200);
    }

    public function articleStore()
    {
        return[
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'body' => request('body'),
            'subject_id' => request('subject')
        ];
    }
}
