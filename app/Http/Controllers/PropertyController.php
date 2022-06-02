<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Property;
use App\Rumah;
use Image;
use App\Lahan;
use App\Gedung;
use App\Apartemen;
use App\Gudang;

class PropertyController extends Controller
{
    public function tambahRumah(Request $request){

        $request->validate([
            'name' => 'required|max:50|min:3',
            'type' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'city' => 'required',
            'postalcode' => 'required|integer',
            'province' => 'required',
            'description' => 'required|min:100',
            'contactno' => 'required|numeric',
            'contactemail' => 'email|required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'lat' => 'required',
            'lng' => 'required',
            'rooms' => 'required|integer',
            'kitchen' => 'required|integer',
            'floor' => 'required|integer',
            'washroom' => 'required|integer',
            'size' => 'required|integer',
            'swimming' => 'required',
            'garden' => 'required',
            'nschool' => 'required',
            'nrailway' => 'required',
            'nbus' => 'required'
            
        ]);

        $property = new Property;
        $rumah_dir=$property->type = request('type');

        if($request->hasfile('filename'))
         {
            $dir = public_path("uploads/property/" . strtolower($rumah_dir)."/");

            if (!File::exists($dir)) {
                File::makeDirectory($dir);
            }

            foreach($request->file('filename') as $image)
            {
                $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(1280,876)->save(($dir . $name));  
                $data[] = $name;
            }
         }

        $property->user_id = auth()->id();
        $property->name = request('name');
        $property->amount = request('amount');
        $property->city = request('city');
        $property->postalCode = request('postalcode');
        $property->province = request('province');
        $property->description = request('description');
        $property->contactNo = request('contactno');
        $property->contatctEmail = request('contactemail');
        $property->images =json_encode($data);
        $property->availability ='Tersedia';
        $property->latitude = request('lat');
        $property->longitude = request('lng');
        $property->save();

        $house = new Rumah;
        $house->property()->associate($property);
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

        return back()->with('message', 'Properti Anda telah berhasil ditambahkan!');

    }

    public function tambahLahan(Request $request){

        $request->validate([
            'name' => 'required|max:30|min:3',
            'type' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'city' => 'required',
            'postalcode' => 'required|integer',
            'province' => 'required',
            'description' => 'required|min:100',
            'contactno' => 'required|numeric',
            'contactemail' => 'email|required',
            'filename' => 'required',
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

        $property = new Property;
        $lahan_dir=$property->type = request('type');

        if($request->hasfile('filename'))
         {
            $dir = public_path("uploads/property/" . strtolower($lahan_dir)."/");

            if (!File::exists($dir)) {
                File::makeDirectory($dir);
            }

            foreach($request->file('filename') as $image)
            {
                $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(1280,876)->save(($dir . $name));  
                $data[] = $name;  
            }
         }

        $property->user_id = auth()->id();
        $property->name = request('name');
        $property->amount = request('amount');
        $property->city = request('city');
        $property->postalCode = request('postalcode');
        $property->province = request('province');
        $property->description = request('description');
        $property->contactNo = request('contactno');
        $property->contatctEmail = request('contactemail');
        $property->images =json_encode($data);
        $property->availability ='Tersedia';
        $property->latitude = request('lat');
        $property->longitude = request('lng');
        $property->save();

        $land = new Lahan;
        $land->property()->associate($property);
        $land->size = request('size');
        $land->electricity = request('electricity');
        $land->tapwater = request('tapwater');
        $land->nearestSchool = request('nschool');
        $land->nearestRailway = request('nrailway');
        $land->nearestBusStop = request('nbus');
        $land->save();

        return back()->with('message', 'Properti Anda telah berhasil ditambahkan!');
        

    }

    public function tambahGedung(Request $request){

        $request->validate([
            'name' => 'required|max:30|min:3',
            'type' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'city' => 'required',
            'postalcode' => 'required|integer',
            'province' => 'required',
            'description' => 'required|min:100',
            'contactno' => 'required|string',
            'contactemail' => 'email|required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'lat' => 'required',
            'lng' => 'required',
            'lift' => 'required',
            'carpark' => 'required',
            'floorsize' => 'required|integer',
            'floor' => 'required|integer',
            'agreement' => 'required',
            'nschool' => 'required',
            'nrailway' => 'required',
            'nbus' => 'required'
            
        ]);

        $property = new Property;
        $gedung_dir=$property->type = request('type');

        if($request->hasfile('filename'))
         {
            $dir = public_path("uploads/property/" . strtolower($gedung_dir)."/");

            if (!File::exists($dir)) {
                File::makeDirectory($dir);
            }

            foreach($request->file('filename') as $image)
            {
                $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(1280,876)->save(($dir . $name));  
                $data[] = $name;  
            }
         }

        $property->user_id = auth()->id();
        $property->name = request('name');
        $property->amount = request('amount');
        $property->city = request('city');
        $property->postalCode = request('postalcode');
        $property->province = request('province');
        $property->description = request('description');
        $property->contactNo = request('contactno');
        $property->contatctEmail = request('contactemail');
        $property->images =json_encode($data);
        $property->availability ='Tersedia';
        $property->latitude = request('lat');
        $property->longitude = request('lng');
        $property->save();

        $building = new Gedung();
        $building->property()->associate($property);
        $building->agreement = request('agreement');
        $building->noOfFloors = request('floor');
        $building->floorSize = request('floorsize');
        $building->lift = request('lift');
        $building->carpark = request('carpark');
        $building->nearestSchool = request('nschool');
        $building->nearestRailway = request('nrailway');
        $building->nearestBusStop = request('nbus');
        $building->save();

        return back()->with('message', 'Properti Anda telah berhasil ditambahkan!');

    }

    public function tambahApartemen(Request $request){

        $request->validate([
            'name' => 'required|max:30|min:3',
            'type' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'city' => 'required',
            'postalcode' => 'required|integer',
            'province' => 'required',
            'description' => 'required|min:100',
            'contactno' => 'required|string',
            'contactemail' => 'email|required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'lat' => 'required',
            'lng' => 'required',
            'rooms' => 'required',
            'kitchen' => 'required',
            'size' => 'required|integer',
            'washroom' => 'required',
            'nschool' => 'required',
            'nrailway' => 'required',
            'nbus' => 'required'
            
        ]);

        $property = new Property;
        $apartemen_dir=$property->type = request('type');

        if($request->hasfile('filename'))
         {
            $dir = public_path("uploads/property/" . strtolower($apartemen_dir)."/");

            if (!File::exists($dir)) {
                File::makeDirectory($dir);
            }

            foreach($request->file('filename') as $image)
            {
                $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(1280,876)->save(($dir . $name));  
                $data[] = $name;  
            }
         }

        $property = new Property;
        $property->user_id = auth()->id();
        $property->name = request('name');
        $property->type = request('type');
        $property->amount = request('amount');
        $property->city = request('city');
        $property->postalCode = request('postalcode');
        $property->province = request('province');
        $property->description = request('description');
        $property->contactNo = request('contactno');
        $property->contatctEmail = request('contactemail');
        $property->images =json_encode($data);
        $property->availability ='Tersedia';
        $property->latitude = request('lat');
        $property->longitude = request('lng');
        $property->save();

        $apartment = new Apartemen();
        $apartment->property()->associate($property);
        $apartment->noOfRooms = request('rooms');
        $apartment->noOfKitchen = request('kitchen');
        $apartment->noOfWashrooms = request('washroom');
        $apartment->size = request('size');
        $apartment->nearestSchool = request('nschool');
        $apartment->nearestRailway = request('nrailway');
        $apartment->nearestBusStop = request('nbus');
        $apartment->save();

        return back()->with('message', 'Properti Anda telah berhasil ditambahkan!');

    }

    public function tambahGudang(Request $request){

        $request->validate([
            'name' => 'required|max:30|min:3',
            'type' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'city' => 'required',
            'postalcode' => 'required|integer',
            'province' => 'required',
            'description' => 'required|min:100',
            'contactno' => 'required|string',
            'contactemail' => 'email|required',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'lat' => 'required',
            'lng' => 'required',
            'agreement' => 'required',
            'electricity' => 'required',
            'size' => 'required|integer',
            'carpark' => 'required'
            
        ]);

        $property = new Property;
        $gudang_dir=$property->type = request('type');

        if($request->hasfile('filename'))
         {
            $dir = public_path("uploads/property/" . strtolower($gudang_dir)."/");

            if (!File::exists($dir)) {
                File::makeDirectory($dir);
            }

            foreach($request->file('filename') as $image)
            {
                $name= uniqid('real_') . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(1280,876)->save(($dir . $name));  
                $data[] = $name;  
            }
         }

        $property = new Property;
        $property->user_id = auth()->id();
        $property->name = request('name');
        $property->type = request('type');
        $property->amount = request('amount');
        $property->city = request('city');
        $property->postalCode = request('postalcode');
        $property->province = request('province');
        $property->description = request('description');
        $property->contactNo = request('contactno');
        $property->contatctEmail = request('contactemail');
        $property->images =json_encode($data);
        $property->availability ='Tersedia';
        $property->latitude = request('lat');
        $property->longitude = request('lng');
        $property->save();

        $warehouse = new Gudang();
        $warehouse->property()->associate($property);
        $warehouse->agreement = request('agreement');
        $warehouse->electricity = request('electricity');
        $warehouse->parkingArea = request('carpark');
        $warehouse->size = request('size');
        $warehouse->save();

        return back()->with('message', 'Properti Anda telah berhasil ditambahkan!');

    }
}
