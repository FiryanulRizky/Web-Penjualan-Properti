<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;
use App\User;
use App\Transaksi;
use App\UserEmail;
use Illuminate\Support\Facades\DB;
use Alert;
use App\Favorit;
use App\Property;
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
    public function updateAvatar(Request $request){
        if($request->hasFile('avatar')){
            $user = Auth::user();
            $dir=public_path('uploads/avatars/'.$user->avatar);
            File::delete($dir);
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(\public_path('/uploads/avatars/' . $filename));
            $user->avatar = $filename;
            $user->save();
        }

        //return view('profile.dashboard', array('user'=> Auth::user()));
        return back();
    }

    public function loadUserDashboard(){

        $id = Auth::user()->id;

        $messages = UserEmail::where(function($query) use ($id) 
        {
            $query->where('receiver_id','=', $id);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

        $offers = $offers = Transaksi::whereHas('property', function($query) use ($id) 
        {
            $query->where('user_id','=', $id);

        })->limit(5)
          ->orderBy('id', 'desc')
          ->get();

        return view('profil.home', compact('offers','messages'),array('user' => Auth::user()));
    }

    public function updateAkun(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string', 'email|max:255|unique:users',
            'descrption'=> 'required|string|max:100',
            // 'nic' => 'required|string|regex:/^[0-9]{9}[Vv]$/',
            'nic' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'birthday' => 'required|date_format:Y-m-d|before:today',
            'gender' => 'required',
            'phoneno' => 'required|string',
        ]);

        $user = User::find($id);
        if(strcmp($user->email,request('email')) != 0 ){
            $user->email_verified_at = NULL;
        }
        $user->name = request('name');
        $user->email = request('email');
        $user->description = request('descrption');
        $user->NIC = request('nic');
        $user->address = request('address');
        $user->city = request('city');
        $user->gender = request('gender');
        $user->birthday = request('birthday');
        $user->phoneNo = request('phoneno');
        $user->save();

        return back()->with('message', 'Akun Anda telah berhasil diperbarui!');
    }

    public function gantiPassword(Request $request){

        $request->validate([

            'password' => 'required|string|min:8|confirmed',
            'current_password' => 'required',
        ]);

        if(!(Hash::check(request('current_password'),Auth::user()->password))){

            return back()->with("errormsg","Kata sandi Anda saat ini tidak cocok dengan kata sandi yang Anda berikan. Silahkan coba lagi.");

        }

        if(strcmp(request('current_password'),request('password')) == 0){

            return back()->with("warningmsg","Kata Sandi Baru tidak boleh sama dengan kata sandi Anda saat ini. Silahkan pilih kata sandi yang berbeda.");

        }

        $user = Auth::user();
        $user->password = Hash::make(request('password'));
        $user->save();

        return back()->with("success","Kata sandi berhasil diubah!");

    }

    public function semuaTransaksi(){

        $id = Auth::user()->id;
        $messages = UserEmail::where(function($query) use ($id) 
        {
            $query->where('receiver_id','=', $id);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });
        $offers = Transaksi::whereHas('property', function($query) use ($id) 
        {
            $query->where('user_id','=', $id);

        })->paginate(15);

        return view('profil.home', compact('offers','messages'),array('user' => Auth::user()));
    }

    public function TransaksiSaya(){

        $id = Auth::user()->id;
        $messages = UserEmail::where(function($query) use ($id) 
        {
            $query->where('receiver_id','=', $id);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

        $offers = Transaksi::whereHas('property', function($query) use ($id) 
        {
            $query->where('offeredUser','=', $id);

        })->paginate(15);

        return view('profil.home', compact('offers','messages'),array('user' => Auth::user()));
    }

    public function PesanSaya()
    {
        $id = Auth::user()->id;
        $messages = UserEmail::where(function($query) use ($id) 
        {
            $query->where('receiver_id','=', $id);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        })->orderBy('id', 'desc')
          ->paginate(10);

        return view('profil.home', compact('messages'),array('user' => Auth::user()));
    }

    public function tampilPesan(UserEmail $message)
    {
        $id = $message->id;
        $id2 = Auth::user()->id;
        $messages = UserEmail::where(function($query) use ($id2) 
        {
            $query->where('receiver_id','=', $id2);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');
    
        });

        $updateMessage = UserEmail::find($id);
        $updateMessage->status = 'read';
        $updateMessage->save();

        return view('profil.home',compact('message','messages') ,array('user' => Auth::user()));

    }

    public function hapusPesan(UserEmail $message)
    {
        if ($message->receiver_id == auth()->id()) {

            DB::table('user_emails')->where('id', '=', $message->id)->delete();

            Alert::success('Pesan Anda telah berhasil dihapus!', 'Sukses Dihapus!')->autoclose(3000);
            return redirect('/profil/pesan');
        }
        else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil/pesan');

        }
    }

    public function tampilSemuaPesan()
    {
        $id = Auth::user()->id;
        $messages = UserEmail::where(function($query) use ($id) 
        {
            $query->where('receiver_id','=', $id);

        })->orderBy('id', 'desc')
          ->paginate(10);

        return view('profil.home', compact('messages'),array('user' => Auth::user()));
    }

    public function tampilFavorit()
    {
        $userId = auth()->id();

        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

        $favorites = Favorit::where(function($query) use ($userId){

            $query->where('user_id','=',$userId);

        })->paginate(15);

        return view('profil.home', compact('favorites','messages'),array('user' => Auth::user()));
    }
    
    public function hapusFavorit(Favorit $favorite)
    {
        if ($favorite->user_id == auth()->id()) {

            DB::table('favorits')->where('id', '=', $favorite->id)->delete();

            Alert::success('Favorit Anda telah berhasil dihapus!', 'Sukses Dihapus!')->autoclose(3000);
            return redirect('/profil/favoritsaya');
        }
        else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil/favoritsaya');
            
        }
    }

    public function tampilPropertiTerjual()
    {
        $userId = auth()->id();

        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');
    
        });

        $properties = Property::where(function($query) use ($userId){

            $query->where('user_id','=',$userId);

        })->paginate(15);

        return view('profil.home', compact('properties','messages'),array('user' => Auth::user()));
    }

    public function tandaiTerjual(Property $property)
    {
        if ($property->user_id == auth()->id()) {

            $property = Property::find($property->id);
            $property->availability = 'Terjual';
            $property->save();

            Alert::success('Properti Anda telah ditandai sebagai terjual!', 'Mark Sold!')->autoclose(3000);
            return redirect('/profil/terjual');
        }
        else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil/terjual');
            
        }
    }

    public function tandaiBelumTerjual(Property $property)
    {
        if ($property->user_id == auth()->id()) {

            $property = Property::find($property->id);
            $property->availability = 'Tidak Terjual';
            $property->save();

            Alert::success('Properti Anda telah ditandai sebagai tidak terjual!', 'Tandai Tidak Terjual!')->autoclose(3000);
            return redirect('/profil/terjual');
        }
        else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil/terjual');
            
        }
    }

    public function kontakTransaksi(Transaksi $offer)
    {
        $userId = auth()->id();

        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');
    
        });
        $user = User::find($offer->offeredUser);
        return view('profil.home', compact('user','offer','messages'),array('user' => Auth::user()));

    }

    public function kontakPemilikTransaksi(Transaksi $offer)
    {
        $userId = auth()->id();

        $messages = UserEmail::where(function($query) use ($userId) 
        {
            $query->where('receiver_id','=', $userId);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });
        
        $user = User::find($offer->property->user->id);
        return view('profil.home', compact('user','offer','messages'),array('user' => Auth::user()));

    }

    public function hapusAkunUser(User $user){

        if ($user->id == auth()->id()) {

            //delete all properties
            $properties = $user->properties;

            foreach($properties as $property){

                $propertyType = checkPropertyTypeById($property->id);

                $dir=public_path('uploads/avatars/'.$user->avatar);
                File::delete($dir);

                if(strcmp($propertyType,'rumah')){

                    DB::table('rumahs')->where('property_id', '=', $property->id)->delete();

                }elseif(strcmp($propertyType,'lahan')){

                    DB::table('lahans')->where('property_id', '=', $property->id)->delete();

                }elseif(strcmp($propertyType,'gedung')){

                    DB::table('gedungs')->where('property_id', '=', $property->id)->delete();

                }elseif(strcmp($propertyType,'apartemen')){

                    DB::table('apartemens')->where('property_id', '=', $property->id)->delete();

                }elseif(strcmp($propertyType,'gudang')){

                    DB::table('gudangs')->where('property_id', '=', $property->id)->delete();

                }else{
                    Alert::error('Permintaan Anda telah ditolak oleh sistem', 'System Error')->autoclose(3000);
                    return redirect('/profil');
                }

                //delete main property
                DB::table('properties')->where('id', '=', $property->id)->delete();
            }

            DB::table('users')->where('id', '=', $user->id)->delete();

            Alert::success('Akun Anda telah berhasil dihapus!', 'Sukses Dihapus!')->autoclose(3000);
            return back();
        }
        else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');

        }
    }

}
