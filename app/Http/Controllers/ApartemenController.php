<?php

namespace App\Http\Controllers;

use Alert;
use App\Apartemen;
use App\UserEmail;
use App\MailNotification;
use App\Mail\EmailNotification;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ApartemenController extends Controller
{
    public function tampilApartemen(Apartemen $apartment)
    {

        return view('hasil.tampilapartemen', compact('apartment'));
    }

    public function tampilApartemenAdmin(Property $apartment)
    {
        return view('hasil.tampilapartemen', compact('apartment'));
    }

    public function cariApartemen(Request $request)
    {
        $keyword = $request->input('searchquery');
        $room = $request->input('room');
        $minPrice = $request->input('minprice');
        $maxPrice = $request->input('maxprice');

        $apartments = Apartemen::whereHas('property', function ($query) use ($room) {
            $query->where('noOfRooms', '>=', $room);
        })->whereHas('property', function ($query) use ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->orwhere('postalCode', 'LIKE', $keyword)
                    ->orWhere('province', 'LIKE', $keyword)
                    ->orWhere('city', 'LIKE', $keyword);
            });
        })->whereHas('property', function ($query) {

            $query->where('availability', 'LIKE', "Tersedia");

        })->whereHas('property', function ($query) use ($minPrice, $maxPrice) {

            $query->whereBetween('amount', array($minPrice, $maxPrice));
        })->get();

        return view('hasil.hasilapartemen', compact('apartments'));
    }

    public function tampilEditApartemen(Apartemen $apartment)
    {
        if ($apartment->property->user_id == auth()->id()) {

            $id = Auth::user()->id;
            $messages = UserEmail::where(function($query) use ($id)
            {
                $query->where('receiver_id','=', $id);

            })->where(function ($query){

                $query->where('status', 'LIKE', 'unread');

            });

            return view('profil.home', compact('apartment','messages'), array('user' => Auth::user()));
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');
        }
    }

    public function editApartemen(Request $request)
    {

        $property = Property::find(request('propertyid'));
        $apartment = Apartemen::find(request('apartmentid'));

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
                'rooms' => 'required',
                'kitchen' => 'required',
                'size' => 'required|integer',
                'washroom' => 'required',
                'nschool' => 'required',
                'nrailway' => 'required',
                'nbus' => 'required',

            ]);

            if ($request->hasfile('filename')) {
                $dir_apartemen=$property->type;
                $arr_img=array($property->images);
                $dir=public_path('uploads/property/'.strtolower($dir_apartemen).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                    }
                }
                foreach ($request->file('filename') as $image) {
                    $name = uniqid('real_') . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(1280, 876)->save(\public_path('/uploads/property/apartemen/' . $name));
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

            $apartment->noOfRooms = request('rooms');
            $apartment->noOfKitchen = request('kitchen');
            $apartment->noOfWashrooms = request('washroom');
            $apartment->size = request('size');
            $apartment->nearestSchool = request('nschool');
            $apartment->nearestRailway = request('nrailway');
            $apartment->nearestBusStop = request('nbus');
            $apartment->save();

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

    public function hapusApartemen(Apartemen $apartment)
    {

        if ($apartment->property->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_apartemen=$apartment->property->type;
            $arr_img=array($apartment->property->images);
            $dir=public_path('uploads/property/'.strtolower($dir_apartemen).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$apartment->property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('apartemens')->where('id', '=', $apartment->id)->delete();
                        DB::table('properties')->where('id', '=', $apartment->property->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $apartment->property->user->email;
                $message->receiver_name = $apartment->property->user->name;
                $message->property_name = $apartment->property->name;
                $message->property_location = $apartment->property->city;
                $message->property_createdOn = $apartment->property->created_at;
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

    public function hapusApartemenAdmin(Property $apartment)
    {

        if ($apartment->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_apartemen=$apartment->type;
            $arr_img=array($apartment->images);
            $dir=public_path('uploads/property/'.strtolower($dir_apartemen).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$apartment->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('apartemens')->where('id', '=', $apartment->id)->delete();
                        DB::table('properties')->where('id', '=', $apartment->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $apartment->user->email;
                $message->receiver_name = $apartment->user->name;
                $message->property_name = $apartment->name;
                $message->property_location = $apartment->city;
                $message->property_createdOn = $apartment->created_at;
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
