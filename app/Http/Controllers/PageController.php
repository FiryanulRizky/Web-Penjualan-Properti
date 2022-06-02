<?php

namespace App\Http\Controllers;

use App\Page;
use App\User;
use App\Message;

use Auth;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rumah;
use App\Lahan;
use App\Gedung;
use App\Apartemen;
use App\Gudang;
use App\UserEmail;
use App\Artikel;
use App\Komentar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','verified'])->only([
            'profil', 'gantiPassword', 'editakun', 'favorits',
            'tampilPesan', 'PesanSaya', 'RumahSaya', 'ApartemenSaya', 'LahanSaya', 'GedungSaya', 'GudangSaya', 'hapusakun', 'tambahProperti', 'tambahRumah','tambahGedung','tambahLahan','tambahApartemen','tambahGudang'
        ]);
    }
    public function index()
    {
        $articles = Artikel::limit(3)->orderBy('id','desc')->get();
        $houses = Rumah::limit(10)->orderBy('id','desc')->get();
        return view('layouts.master',compact('articles','houses'));
    }

    public function lahan()
    {

        $articles = Artikel::limit(10)->orderBy('id','desc')->get();
        $lands = Lahan::limit(10)->orderBy('id','desc')->get();
        return view('layouts.lahan',compact('articles','lands'));
    }

    public function apartemen()
    {
        $articles = Artikel::limit(3)->orderBy('id','desc')->get();
        $apartemens = Apartemen::limit(10)->orderBy('id','desc')->get();
        return view('layouts.apartemen',compact('articles','apartemens'));
    }

    public function gedung()
    {
        $articles = Artikel::limit(3)->orderBy('id','desc')->get();
        $gedungs = Gedung::limit(10)->orderBy('id','desc')->get();
        return view('layouts.gedung',compact('articles','gedungs'));
    }

    public function gudang()
    {
        $articles = Artikel::limit(3)->orderBy('id','desc')->get();
        $gudangs = Gudang::limit(10)->orderBy('id','desc')->get();
        return view('layouts.gudang',compact('articles','gudangs'));
    }

    public function tentangkami()
    {
        return view('layouts.tentangkami');
    }

    public function kontak_kami()
    {
        return view('layouts.kontak_kami');
    }

    //Logout Route
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    // Search Result Methods
    public function carirumah()
    {
        $houses = Rumah::all();
        return view('hasil.hasilrumah',compact('houses'));
    }
    public function carilahan()
    {
        $lands = Lahan::all();
        return view('hasil.hasil_lahan',compact('lands'));
    }
    public function carigedung()
    {
        $buildings = Gedung::all();
        return view('hasil.hasilgedung',compact('buildings'));
    }
    public function cariapartemen()
    {
        $apartments = Apartemen::all();
        return view('hasil.hasilapartemen',compact('apartments'));
    }
    public function carigudang()
    {
        $warehouses = Gudang::all();
        return view('hasil.hasilgudang',compact('warehouses'));
    }
    
    

    // Profile Page Methods

    public function gantiPassword()
    {
        $id = Auth::user()->id;
        $messages = UserEmail::where(function($query) use ($id) 
        {
            $query->where('receiver_id','=', $id);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');
    
        });
        return view('profil.home', compact('messages'), array('user' => Auth::user()));
    }

    public function editProfil()
    {
        $id = Auth::user()->id;
        $messages = UserEmail::where(function($query) use ($id) 
        {
            $query->where('receiver_id','=', $id);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');
    
        });
        return view('profil.home', compact('messages'), array('user' => Auth::user()));
    }

    public function hapusakun()
    {
        $id = Auth::user()->id;
        $messages = UserEmail::where(function($query) use ($id) 
        {
            $query->where('receiver_id','=', $id);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');
    
        });
        return view('profil.home', compact('messages'), array('user' => Auth::user()));
    }

    public function RumahSaya()
    {
        $userId = auth()->id();
        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

        $houses = Rumah::whereHas('property', function($query) use ($userId){

            $query->where('user_id','=',$userId);

        })->paginate(15);

        return view('profil.home', compact('houses','messages'),array('user' => Auth::user()));
    }

    public function LahanSaya()
    {
        $userId = auth()->id();

        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

        $lands = Lahan::whereHas('property', function($query) use ($userId){

            $query->where('user_id','=',$userId);

        })->paginate(15);

        return view('profil.home', compact('lands','messages'),array('user' => Auth::user()));
    }

    public function ApartemenSaya()
    {
        $userId = auth()->id();

        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

        $apartments = Apartemen::whereHas('property', function($query) use ($userId){

            $query->where('user_id','=',$userId);

        })->paginate(15);

        return view('profil.home', compact('apartments','messages'),array('user' => Auth::user()));
    }

    public function GedungSaya()
    {
        $userId = auth()->id();

        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

        $buildings = Gedung::whereHas('property', function($query) use ($userId){

            $query->where('user_id','=',$userId);

        })->paginate(15);

        return view('profil.home', compact('buildings','messages'),array('user' => Auth::user()));
    }

    public function GudangSaya()
    {
        $userId = auth()->id();

        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

        $warehouses = Gudang::whereHas('property', function($query) use ($userId){

            $query->where('user_id','=',$userId);

        })->paginate(15);

        return view('profil.home', compact('warehouses','messages'),array('user' => Auth::user()));
    }





    // Add Propperties Methods
    public function tambahProperti()
    {
        return view('layouts.tambahproperti', array('user' => Auth::user()));
    }
    public function tambahRumah(){
        return view('layouts.properti.tambahrumah', array('user' => Auth::user()));
    }

    public function dismap(){
        return view('layouts.properti.map', array('user' => Auth::user()));
    }

    public function tambahLahan(){
        return view('layouts.properti.tambahlahan', array('user' => Auth::user()));
    }

    public function tambahGedung(){
        return view('layouts.properti.tambahgedung', array('user' => Auth::user()));
    }

    public function tambahApartemen(){
        return view('layouts.properti.tambahapartemen', array('user' => Auth::user()));
    }

    public function tambahGudang(){
        return view('layouts.properti.tambahgudang', array('user' => Auth::user()));
    }
    


    public function viewpost()
    {
        return view('hasil.view');
    }



    //Blog
    public function tampilBlog(){

        $articles = Artikel::orderBy('id', 'desc');
                           

        if($month = request('month')){

            $articles->whereMonth('created_at', Carbon::parse($month)->month);

        }

        if($year = request('year')){

            $articles->whereYear('created_at', $year);
            
        }

        if($category = request('category')){

            $articles->where('category', $category);            
        }

        $articles = $articles->paginate(3);

        $archives = Artikel::archive();

        return view('blog.blog',compact('articles','archives'));
    }
    
    public function tampilBlogPost(Artikel $article){

        $archives = Artikel::archive();
        return view('blog.lihatartikel',compact('article','archives'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
