<?php

namespace App\Http\Controllers;

use Alert;
use App\Gedung;
use App\Property;
use App\UserEmail;
use App\MailNotification;
use App\Mail\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class GedungController extends Controller
{
    public function tampilGedung(Gedung $building)
    {

        return view('hasil.tampilgedung', compact('building'));
    }

    public function tampilGedungAdmin(Property $building)
    {

        return view('hasil.tampilgedung', compact('building'));
    }

    public function cariGedung(Request $request)
    {
        $keyword = $request->input('searchquery');
        $noOfFloors = $request->input('nooffloors');
        $minPrice = $request->input('minprice');
        $maxPrice = $request->input('maxprice');

        if ($lift = $request->has('lift')) {

            $lift = "Available";
        } else {

            $lift = "%%";
        }

        if ($carPark = $request->has('carpark')) {

            $carPark = "Available";
        } else {

            $carPark = "%%";
        }

        $buildings = Gedung::whereHas('property', function ($query) use ($noOfFloors) {
            $query->where('noOfFloors', '>=', $noOfFloors);
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

        })->where(function ($query) use ($lift) {

            $query->where('lift', 'LIKE', $lift);
        })->where(function ($query) use ($carPark) {

            $query->where('carPark', 'LIKE', $carPark);
        })->get();

        //return "OK";
        return view('hasil.hasilgedung', compact('buildings'));
    }

    public function tampilEditGedung(Gedung $building)
    {
        if ($building->property->user_id == auth()->id()) {

            $id = Auth::user()->id;
            $messages = UserEmail::where(function($query) use ($id)
            {
                $query->where('receiver_id','=', $id);

            })->where(function ($query){

                $query->where('status', 'LIKE', 'unread');

            });

            return view('profil.home', compact('building','messages'), array('user' => Auth::user()));
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');
        }
    }

    public function editGedung(Request $request)
    {

        $property = Property::find(request('propertyid'));
        $building = Gedung::find(request('buildingid'));

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
                'lift' => 'required',
                'carpark' => 'required',
                'floorsize' => 'required|integer',
                'floor' => 'required|integer',
                'agreement' => 'required',
                'nschool' => 'required',
                'nrailway' => 'required',
                'nbus' => 'required',

            ]);

            if ($request->hasfile('filename')) {
                $dir_gedung=$property->type;
                $arr_img=array($property->images);
                $dir=public_path('uploads/property/'.strtolower($dir_gedung).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                    }
                }
                foreach ($request->file('filename') as $image) {
                    $name = uniqid('real_') . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(1280, 876)->save(\public_path('/uploads/property/gedung/' . $name));
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

            $building->agreement = request('agreement');
            $building->noOfFloors = request('floor');
            $building->floorSize = request('floorsize');
            $building->lift = request('lift');
            $building->carpark = request('carpark');
            $building->nearestSchool = request('nschool');
            $building->nearestRailway = request('nrailway');
            $building->nearestBusStop = request('nbus');
            $building->save();

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
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');
        }
    }

    public function hapusGedung(Gedung $building)
    {

        if ($building->property->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_gedung=$building->property->type;
            $arr_img=array($building->property->images);
            $dir=public_path('uploads/property/'.strtolower($dir_gedung).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$building->property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('gedungs')->where('id', '=', $building->id)->delete();
                        DB::table('properties')->where('id', '=', $building->property->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $building->property->user->email;
                $message->receiver_name = $building->property->user->name;
                $message->property_name = $building->property->name;
                $message->property_location = $building->property->city;
                $message->property_createdOn = $building->property->created_at;
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

    public function hapusGedungAdmin(Property $building)
    {

        if ($building->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_gedung=$building->type;
            $arr_img=array($building->images);
            $dir=public_path('uploads/property/'.strtolower($dir_gedung).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$building->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('gedungs')->where('id', '=', $building->id)->delete();
                        DB::table('properties')->where('id', '=', $building->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $building->user->email;
                $message->receiver_name = $building->name;
                $message->property_name = $building->name;
                $message->property_location = $building->city;
                $message->property_createdOn = $building->created_at;
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
