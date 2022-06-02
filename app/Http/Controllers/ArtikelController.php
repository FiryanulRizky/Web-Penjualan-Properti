<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artikel;
use Alert;

class ArtikelController extends Controller
{
    public function BlogPostBaru(){

        $archives = Artikel::archive();
        return view('blog.tambahartikel',compact('archives'));

    }
    
    public function tambahBlogPost(Request $request){

        $request->validate([
            'title' => 'required|max:100|min:3',
            'content' => 'required',
            'category' => 'required'
        ]);

        $article = new Artikel();
        $article->admin_id = auth()->user()->id;
        $article->title = request('title');
        $article->content = request('content');
        $article->category = request('category');
        $article->save();

        Alert::success('New article has been added successfully!', 'New Article Added!')->autoclose(3000);
        return redirect('/blog');
    }

    public function tampilEditBlogPost(Artikel $article){

        $archives = Artikel::archive();
        return view('blog.editartikel',compact('article','archives'));
    }

    public function editBlogPost(Request $request){

        $request->validate([
            'title' => 'required|max:100|min:3',
            'content' => 'required',
            'category' => 'required'
        ]);

        $article = Artikel::find(request('id'));
        $article->title = request('title');
        $article->content = request('content');
        $article->category = request('category');
        $article->update();

        Alert::success('Article has been updated successfully!', 'Update Successfully!')->autoclose(3000);
        return redirect('/blog');
    }
}
