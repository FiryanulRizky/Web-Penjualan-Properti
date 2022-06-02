<?php

namespace App\Http\Controllers;

use Alert;
use App\MailNotification;
use App\UserEmail;
use App\Mail\EmailNotification;
use App\Property;
use App\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class GudangController extends Controller
{
    public function tampilGudang(Gudang $warehouse)
    {
        return view('hasil.tampilgudang', compact('warehouse'));
    }

    public function tampilGudangAdmin(Property $warehouse)
    {
        return view('hasil.tampilgudang', compact('warehouse'));
    }

    public function cariGudang(Request $request)
    {
        $keyword = $request->input('searchquery');
        $minPrice = $request->input('minprice');
        $maxPrice = $request->input('maxprice');

        if ($electricity = $request->has('electricity')) {

            $electricity = "3 Phase";
        } else {

            $electricity = "%%";
        }

        if ($parkingArea = $request->has('parkingarea')) {

            $parkingArea = "Available";
        } else {

            $parkingArea = "%%";
        }

        $warehouses = Gudang::whereHas('property', function ($query) use ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->orwhere('postalCode', 'LIKE', $keyword)
                    ->orWhere('province', 'LIKE', $keyword)
                    ->orWhere('city', 'LIKE', $keyword);
            });
        })->whereHas('property', function ($query) use ($minPrice, $maxPrice) {

            $query->whereBetween('amount', array($minPrice, $maxPrice));
        })->whereHas('property', function ($query) {

            $query->where('availability', 'LIKE', "Tersedia");

        })->where(function ($query) use ($electricity) {

            $query->where('electricity', 'LIKE', $electricity);
        })->where(function ($query) use ($parkingArea) {

            $query->where('parkingArea', 'LIKE', $parkingArea);
        })->get();

        return view('hasil.hasilgudang', compact('warehouses'));
    }

    public function tampilEditGudang(Gudang $warehouse)
    {
        if ($warehouse->property->user_id == auth()->id()) {

            $id = Auth::user()->id;
            $messages = UserEmail::where(function($query) use ($id)
            {
                $query->where('receiver_id','=', $id);

            })->where(function ($query){

                $query->where('status', 'LIKE', 'unread');

            });

            return view('profil.home', compact('warehouse','messages'), array('user' => Auth::user()));
        } else {

            Alert::error('Permintaan Anda telah ditolak oleh sistem', 'Upaya Tidak Diizinkan')->autoclose(3000);
            return redirect('/profil');
        }
    }

    public function editGudang(Request $request)
    {

        $property = Property::find(request('propertyid'));
        $warehouse = Gudang::find(request('warehouseid'));

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
                'agreement' => 'required',
                'electricity' => 'required',
                'size' => 'required|integer',
                'carpark' => 'required',

            ]);

            if ($request->hasfile('filename')) {
                $dir_gudang=$property->type;
                $arr_img=array($property->images);
                $dir=public_path('uploads/property/'.strtolower($dir_gudang).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                    }
                }
                foreach ($request->file('filename') as $image) {
                    $name = uniqid('real_') . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(1280, 876)->save(\public_path('/uploads/property/gudang/' . $name));
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

            $warehouse->agreement = request('agreement');
            $warehouse->electricity = request('electricity');
            $warehouse->parkingArea = request('carpark');
            $warehouse->size = request('size');
            $warehouse->save();

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

    public function hapusGudang(Gudang $warehouse)
    {

        if ($warehouse->property->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_gudang=$warehouse->property->type;
            $arr_img=array($warehouse->property->images);
            $dir=public_path('uploads/property/'.strtolower($dir_gudang).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$warehouse->property->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('gudangs')->where('id', '=', $warehouse->id)->delete();
                        DB::table('properties')->where('id', '=', $warehouse->property->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $warehouse->property->user->email;
                $message->receiver_name = $warehouse->property->user->name;
                $message->property_name = $warehouse->property->name;
                $message->property_location = $warehouse->property->city;
                $message->property_createdOn = $warehouse->property->created_at;
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

    public function hapusGudangAdmin(Property $warehouse)
    {

        if ($warehouse->user_id == auth()->id() || Auth::guard('admin')->check()) {

            $dir_gudang=$warehouse->type;
            $arr_img=array($warehouse->images);
            $dir=public_path('uploads/property/'.strtolower($dir_gudang).'/');
                foreach($arr_img as $img) {
                    $j=explode(",",$warehouse->images);
                    for($i=0;$i< count($j); $i++){
                        File::delete($dir.json_decode($img)[$i]);
                        DB::table('gudangs')->where('id', '=', $warehouse->id)->delete();
                        DB::table('properties')->where('id', '=', $warehouse->id)->delete();
                    }
                }

            if (Auth::guard('admin')->check()) {

                $message = new MailNotification;
                $message->receiver_email = $warehouse->user->email;
                $message->receiver_name = $warehouse->user->name;
                $message->property_name = $warehouse->name;
                $message->property_location = $warehouse->city;
                $message->property_createdOn = $warehouse->created_at;
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
