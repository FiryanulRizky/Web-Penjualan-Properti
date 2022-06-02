<?php

namespace App\Http\Controllers;

use Alert;
use App\Lahan;
use App\UserEmail;
use App\MailNotification;
use App\Mail\EmailNotification;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class LahanController extends Controller
{
    public function tampilLahan(Lahan $land)
    {
        return view('hasil.tampil_lahan', compact('land'));
    }

    public function tampilLahanAdmin(Property $land)
    {
        return view('hasil.tampil_lahan', compact('land'));
    }

    public function cariLahan(Request $request)
    {
        $keyword = $request->input('searchquery');
        $minPrice = $request->input('minprice');
        $maxPrice = $request->input('maxprice');

        if ($electricity = $request->has('electricity')) {

            $electricity = "3 Phase";
        } else {

            $electricity = "%%";
        }

        if ($tapWater = $request->has('tapwater')) {

            $tapWater = "Available";
        } else {

            $tapWater = "%%";
        }

        $lands = Lahan::whereHas('property', function ($query) use ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->orwhere('postalCode', 'LIKE', $keyword)
                    ->orWhere('province', 'LIKE', $keyword)
                    ->orWhere('city', 'LIKE', $keyword);
            });
        })->whereHas('property', function ($query) {

            $query->where('availability', 'LIKE', "Tersedia");

        })->whereHas('property', function ($query) use ($minPrice, $maxPrice) {

            $query->whereBetween('amount', array($minPrice, $maxPrice));

        })->where(function ($query) use ($electricity) {

            $query->where('electricity', 'LIKE', $electricity);

        })->where(function ($query) use ($tapWater) {

            $query->where('tapwater', 'LIKE', $tapWater);
        })->get();

        return view('hasil.hasil_lahan', compact('lands'));
    }

    public function tampilEditLahan(Lahan $land)
    {
        if ($land->property->user_id == auth()->id()) {

            $id = Auth::user()->id;
            $messages = UserEmail::where(function($query) use ($id)
            {
                $query->where('receiver_id','=', $id);

            })->where(function ($query){

                $query->where('status', 'LIKE', 'unread');

            });

            return view('profil.home', compact('land','messages'), array('user' => Auth::user()));
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');
        }
    }

    public function editLahan(Request $request)
    {

        $property = Property::find(request('propertyid'));
        $land = Lahan::find(request('landid'));

        if ($property->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $request->validate([
                'name' => 'required|max:30|min:3',
                'type' => 'required',
                'amount' => 'required',
                'city' => 'required',
                'postalcode' => 'required|integer',
                'province' => 'required',
                'description' => 'required|min:100',
                'contactno' => 'required',
                'contactemail' => 'email|required',
                'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'lat' => 'required',
                'lat' => 'required',
                'size' => 'required|integer',
                'electricity' => 'required',
                'tapwater' => 'required',
                'nschool' => 'required',
                'nrailway' => 'required',
                'nbus' => 'required',

            ]);

            if ($request->hasfile('filename')) {
                $dir_lahan=$property->type;
                $arr_img=array($property->images);
                $dir=public_path('uploads/property/'.strtolower($dir_lahan).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                    }
                }
                foreach ($request->file('filename') as $image) {
                    $name = uniqid('real_') . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(1280, 876)->save(\public_path('/uploads/property/lahan/' . $name));
                    $data[] = $name;
                }
            }

            $property->name = request('name');
            $property->type = request('type');
            $property->amount = request('amount');
            $property->city = request('city');
            $property->postalCode = request('postalcode');
            $property->province = request('province');
            $property->description = request('description');
            $property->contactNo = request('contactno');
            $property->contatctEmail = request('contactemail');

            if ($request->hasfile('filename')) {

                $property->images = json_encode($data);
            }

            $property->latitude = request('lat');
            $property->longitude = request('lng');
            $property->save();

            $land->size = request('size');
            $land->electricity = request('electricity');
            $land->tapwater = request('tapwater');
            $land->nearestSchool = request('nschool');
            $land->nearestRailway = request('nrailway');
            $land->nearestBusStop = request('nbus');
            $land->save();

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $property->user->email;
                $message->receiver_name = $property->user->name;
                $message->property_name = $property->name;
                $message->property_location = $property->city;
                $message->property_createdOn = $property->created_at;
                $message->status = 'Property diubah';
                $message->subject = "Properti Anda telah diubah!";

                \Mail::to($message->receiver_email)->send(new EmailNotification($message));
            }

            Alert::success('Properti Anda telah berhasil diedit!', 'Berhasil Diperbarui')->autoclose(3000);
            return back()->with('message', 'Properti Anda telah berhasil diperbarui!');

            // return dd($data);
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');
        }
    }

    public function hapusLahan(Lahan $land)
    {

        if ($land->property->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_lahan=$land->property->type;
            $arr_img=array($land->property->images);
            $dir=public_path('uploads/property/'.strtolower($dir_lahan).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$land->property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('lahans')->where('id', '=', $land->id)->delete();
                        DB::table('properties')->where('id', '=', $land->property->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $land->property->user->email;
                $message->receiver_name = $land->property->user->name;
                $message->property_name = $land->property->name;
                $message->property_location = $land->property->city;
                $message->property_createdOn = $land->property->created_at;
                $message->status = 'Property dihapus';
                $message->subject = "Properti Anda telah dihapus!";

                \Mail::to($message->receiver_email)->send(new EmailNotification($message));
            }

            Alert::success('Properti Anda telah berhasil dihapus!', 'Sukses Dihapus!')->autoclose(3000);
            return back();
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');

        }
    }

    public function hapusLahanAdmin(Property $land)
    {

        if ($land->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_lahan=$land->type;
            $arr_img=array($land->images);
            $dir=public_path('uploads/property/'.strtolower($dir_lahan).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$land->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('lahans')->where('id', '=', $land->id)->delete();
                        DB::table('properties')->where('id', '=', $land->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $land->user->email;
                $message->receiver_name = $land->user->name;
                $message->property_name = $land->name;
                $message->property_location = $land->city;
                $message->property_createdOn = $land->created_at;
                $message->status = 'Property dihapus';
                $message->subject = "Properti Anda telah dihapus!";

                \Mail::to($message->receiver_email)->send(new EmailNotification($message));
            }

            Alert::success('Properti Anda telah berhasil dihapus!', 'Sukses Dihapus!')->autoclose(3000);
            return back();
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/admin/login');

        }
    }
}
