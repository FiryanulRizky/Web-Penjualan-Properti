<?php

namespace App\Http\Controllers;

use Alert;
use App\Rumah;
use App\Property;
use App\UserEmail;
use App\MailNotification;
use App\Mail\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class RumahController extends Controller
{
    public function tampilRumah(Rumah $house)
    {
        return view('hasil.tampilrumah', compact('house'));
    }

    public function tampilRumahAdmin(Property $house)
    {
        return view('hasil.tampilrumah', compact('house'));
    }

    public function cariRumah(Request $request)
    {
        $keyword = $request->input('searchquery');
        $room = $request->input('room');
        $minPrice = $request->input('minprice');
        $maxPrice = $request->input('maxprice');

        if ($swimmingPool = $request->has('swimmingpool')) {

            $swimmingPool = "Available";
        } else {

            $swimmingPool = "%%";
        }

        if ($noOfFloors = $request->has('balcony')) {

            $noOfFloors = 2;
        } else {

            $noOfFloors = 0;
        }

        if ($outdoor = $request->has('outdoor')) {

            $outdoor = "Available";
        } else {

            $outdoor = "%%";
        }

        $houses = Rumah::whereHas('property', function ($query) use ($room) {
            $query->where('noOfRooms', '>=', $room);
        })->whereHas('property', function ($query) use ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->orwhere('postalCode', 'LIKE', $keyword)
                    ->orWhere('province', 'LIKE', $keyword)
                    ->orWhere('city', 'LIKE', $keyword);
            });
        })->whereHas('property', function ($query) use ($minPrice, $maxPrice) {

            $query->whereBetween('amount', array($minPrice, $maxPrice));
        })->whereHas('property', function ($query) {

            $query->where('availability', 'LIKE', "Tersedia");

        })->where(function ($query) use ($swimmingPool) {

            $query->where('swimmingPool', 'LIKE', $swimmingPool);
        })->where(function ($query) use ($noOfFloors) {

            $query->where('noOfFloors', '>=', $noOfFloors);
        })->where(function ($query) use ($outdoor) {

            $query->where('garden', 'LIKE', $outdoor);
        })->get();

        return view('hasil.hasilrumah', compact('houses'));
    }

    public function tampilEditRumah(Rumah $house)
    {
        if ($house->property->user_id == auth()->id()) {

        $id = Auth::user()->id;

        $messages = UserEmail::where(function($query) use ($id)
        {
            $query->where('receiver_id','=', $id);

        })->where(function ($query){

            $query->where('status', 'LIKE', 'unread');

        });

            return view('profil.home', compact('house','messages'), array('user' => Auth::user()));

        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');
        }
    }

    public function editRumah(Request $request)
    {

        $property = Property::find(request('propertyid'));
        $house = Rumah::find(request('houseid'));

        if ($property->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $request->validate([
                'name' => 'required|max:50|min:3',
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
                'rooms' => 'required|integer',
                'kitchen' => 'required|integer',
                'floor' => 'required|integer',
                'washroom' => 'required|integer',
                'size' => 'required|integer',
                'swimming' => 'required',
                'garden' => 'required',
                'nschool' => 'required',
                'nrailway' => 'required',
                'nbus' => 'required',

            ]);

            if ($request->hasfile('filename')) {
                $dir_rumah=$property->type;
                $arr_img=array($property->images);
                $dir=public_path('uploads/property/'.strtolower($dir_rumah).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                    }
                }
                foreach ($request->file('filename') as $image) {
                    $name = uniqid('real_') . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(1280, 876)->save(\public_path('/uploads/property/rumah/' . $name));
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

            $house->noOfRooms = request('rooms');
            $house->noOfKitchen = request('kitchen');
            $house->noOfFloors = request('floor');
            $house->noOfWashrooms = request('washroom');
            $house->size = request('size');
            $house->swimmingPool = request('swimming');
            $house->garden = request('garden');
            $house->nearestSchool = request('nschool');
            $house->nearestRailway = request('nrailway');
            $house->nearestBusStop = request('nbus');
            $house->save();

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
            return back()->with('message', 'Your property has been Berhasil Diperbarui!');
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');

        }
    }

    public function hapusRumah(Rumah $house)
    {

        if ($house->property->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_rumah=$house->property->type;
            $arr_img=array($house->property->images);
            $dir=public_path('uploads/property/'.strtolower($dir_rumah).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$house->property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('rumahs')->where('id', '=', $house->id)->delete();
                        DB::table('properties')->where('id', '=', $house->property->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $house->property->user->email;
                $message->receiver_name = $house->property->user->name;
                $message->property_name = $house->property->name;
                $message->property_location = $house->property->city;
                $message->property_createdOn = $house->property->created_at;
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

    public function hapusRumahAdmin(Property $house)
    {

        if ($house->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_rumah=$house->type;
            $arr_img=array($house->images);
            $dir=public_path('uploads/property/'.strtolower($dir_rumah).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$house->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('rumahs')->where('id', '=', $house->id)->delete();
                        DB::table('properties')->where('id', '=', $house->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $house->user->email;
                $message->receiver_name = $house->user->name;
                $message->property_name = $house->name;
                $message->property_location = $house->city;
                $message->property_createdOn = $house->created_at;
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
