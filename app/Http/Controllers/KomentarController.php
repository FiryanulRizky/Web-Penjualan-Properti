<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komentar;
use Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth','auth:admin']);
    }

    public function tambahKomentar(Request $request){

        if(Auth::guard()->check() || Auth::guard('admin')->check()){
            $request->validate([
                'comment' => 'required|max:200|min:3',
            ]);
    
            $comment = new Komentar();
            if(Auth::guard('admin')->check()){
                $comment->user_id = 0;
            }else{
                $comment->user_id = auth()->user()->id;
            }
            $comment->artikel_id = request('article_id');
            $comment->comment = request('comment');
            $comment->save();
    
            Alert::success('Komentar Anda telah berhasil ditambahkan!', 'Komentar Ditambahkan!')->autoclose(3000);
            return back();
        }else{
            return redirect('/login');
        }

        
    }

    public function hapusKomentar(Komentar $comment){
        DB::table('komentars')->where('id', '=', $comment->id)->delete();
        Alert::success('Komentar telah berhasil dihapus!', 'Komentar Dihapus!')->autoclose(3000);
        return back();
    }
}
