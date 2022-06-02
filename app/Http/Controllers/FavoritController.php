<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rumah;
use App\Favorit;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Lahan;
use App\Gedung;
use App\Apartemen;
use App\Gudang;

class FavoritController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function RumahFavorit(Rumah $house)
    {


        $isExits = Favorit::where('property_id', '=', $house->property->id)
            ->where('user_id', '=', auth()->id())
            ->get();
        if ($isExits->count() <= 0) {
            $favorite = new Favorit;
            $favorite->property_id = $house->property->id;
            $favorite->user_id = auth()->id();
            $favorite->rumah_id = $house->id;


            try {
                $favorite->save();
                Alert::success('Favorite has been added successfully!', 'Favorite Added')->autoclose(3000);
                return back();
            } catch (\Illuminate\Database\QueryException $e) {

                $errorCode = $e->errorInfo[1];
                if ($errorCode == '1062') {
                    Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
                    return back();
                }
            }

            Alert::error('Something went wrong!', 'Oops!')->autoclose(3000);
            return back();
        } else {
            Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
            return back();
        }
    }

    public function LahanFavorit(Lahan $land)
    {

        $isExits = Favorit::where('property_id', '=', $land->property->id)
            ->where('user_id', '=', auth()->id())
            ->get();
        if ($isExits->count() <= 0) {
            $favorite = new Favorit;
            $favorite->property_id = $land->property->id;
            $favorite->user_id = auth()->id();
            $favorite->lahan_id = $land->id;


            try {
                $favorite->save();
                Alert::success('Favorite has been added successfully!', 'Favorite Added')->autoclose(3000);
                return back();
            } catch (\Illuminate\Database\QueryException $e) {

                $errorCode = $e->errorInfo[1];
                if ($errorCode == '1062') {
                    Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
                    return back();
                }
            }

            Alert::error('Something went wrong!', 'Oops!')->autoclose(3000);
            return back();
        } else {
            Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
            return back();
        }
    }

    public function GedungFavorit(Gedung $building)
    {

        $isExits = Favorit::where('property_id', '=', $building->property->id)
            ->where('user_id', '=', auth()->id())
            ->get();
        if ($isExits->count() <= 0) {
            $favorite = new Favorit;
            $favorite->property_id = $building->property->id;
            $favorite->user_id = auth()->id();
            $favorite->gedung_id = $building->id;
            try {
                $favorite->save();
                Alert::success('Favorite has been added successfully!', 'Favorite Added')->autoclose(3000);
                return back();
            } catch (\Illuminate\Database\QueryException $e) {

                $errorCode = $e->errorInfo[1];
                if ($errorCode == '1062') {
                    Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
                    return back();
                }
            }

            Alert::error('Something went wrong!', 'Oops!')->autoclose(3000);
            return back();
        } else {
            Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
            return back();
        }
    }

    public function Apartemenfavorit(Apartemen $apartment)
    {

        $isExits = Favorit::where('property_id', '=', $apartment->property->id)
            ->where('user_id', '=', auth()->id())
            ->get();
        if ($isExits->count() <= 0) {
            $favorite = new Favorit;
            $favorite->property_id = $apartment->property->id;
            $favorite->user_id = auth()->id();
            $favorite->apartemen_id = $apartment->id;

            try {
                $favorite->save();
                Alert::success('Favorite has been added successfully!', 'Favorite Added')->autoclose(3000);
                return back();
            } catch (\Illuminate\Database\QueryException $e) {

                $errorCode = $e->errorInfo[1];
                if ($errorCode == '1062') {
                    Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
                    return back();
                }
            }

            Alert::error('Something went wrong!', 'Oops!')->autoclose(3000);
            return back();
        } else {
            Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
            return back();
        }
    }

    public function GudangFavorit(Gudang $warehouse)
    {

        $isExits = Favorit::where('property_id', '=', $warehouse->property->id)
            ->where('user_id', '=', auth()->id())
            ->get();
        if ($isExits->count() <= 0) {
            $favorite = new Favorit;
            $favorite->property_id = $warehouse->property->id;
            $favorite->user_id = auth()->id();
            $favorite->gudang_id = $warehouse->id;

            try {
                $favorite->save();
                Alert::success('Favorite has been added successfully!', 'Favorite Added')->autoclose(3000);
                return back();
            } catch (\Illuminate\Database\QueryException $e) {

                $errorCode = $e->errorInfo[1];
                if ($errorCode == '1062') {
                    Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
                    return back();
                }
            }

            Alert::error('Something went wrong!', 'Oops!')->autoclose(3000);
            return back();
        } else {
            Alert::warning('Favorite has been already added!', 'Already Added')->autoclose(3000);
            return back();
        }
    }
}
