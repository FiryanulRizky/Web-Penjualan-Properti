<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Lahan;
use App\Rumah;
use App\Gedung;
use App\Apartemen;
use App\Gudang;
use App\User;
use Alert;
use Illuminate\Support\Facades\Validator;
use App\Property;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function transaksiRumah(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'offeramount' => "required|regex:/^\d+(\.\d{1,2})?$/"
        ]);
        
        $property = Property::find(request('propertyid'));

        if($property->user_id == auth()->id()){
            
            Alert::warning('Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!', 'Offer Rejected')->autoclose(3000);
            return back()->with("warning", "Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!");
        }
       
        if ($validator->fails()) {
            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        if (Rumah::find(request('houseid'))->offer > 0) {

            $currentMax = Rumah::find(request('houseid'))->offer->sortBy('offerAmount')->last()->offerAmount;

            if ($currentMax > request('offeramount')) {

                Alert::warning('Penawaran Anda harus lebih tinggi dari penawaran saat ini!', 'Offer Rejected')->autoclose(3000);
                return back()->with("warning", "Penawaran Anda harus lebih tinggi dari penawaran saat ini!");
            }
        }

        $offer = new Transaksi();
        $offer->property_id =  request('propertyid');
        $offer->rumah_id =  request('houseid');
        $offer->offeredUser = auth()->id();
        $offer->offerAmount = request('offeramount');
        $offer->save();

        Alert::success('Penawaran Anda telah berhasil dikirimkan!', 'Offer Submitted')->autoclose(3000);
        return back()->with("success", "Penawaran Anda telah berhasil dikirimkan!");
    }

    public function transaksiLahan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'offeramount' => "required|regex:/^\d+(\.\d{1,2})?$/"
        ]);
        
        $property = Property::find(request('propertyid'));

        if($property->user_id == auth()->id()){
            
            Alert::warning('Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!', 'Offer Rejected')->autoclose(3000);
            return back()->with("warning", "Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!");
        }

        if ($validator->fails()) {
            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        if (Lahan::find(request('landid'))->offer > 0) {

            $currentMax = Lahan::find(request('landid'))->offers->sortBy('offerAmount')->last()->offerAmount;

            if ($currentMax > request('offeramount')) {

                Alert::warning('Penawaran Anda harus lebih tinggi dari penawaran saat ini!', 'Offer Rejected')->autoclose(3000);
                return back()->with("warning", "Penawaran Anda harus lebih tinggi dari penawaran saat ini!");
            }
        }
        $offer = new Transaksi();
        $offer->property_id =  request('propertyid');
        $offer->lahan_id =  request('landid');
        $offer->offeredUser = auth()->id();
        $offer->offerAmount = request('offeramount');
        $offer->save();

        Alert::success('Penawaran Anda telah berhasil dikirimkan!', 'Offer Submitted')->autoclose(3000);
        return back()->with("success", "Penawaran Anda telah berhasil dikirimkan !");
    }

    public function transaksiGedung(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'offeramount' => "required|regex:/^\d+(\.\d{1,2})?$/"
        ]);
        
        $property = Property::find(request('propertyid'));

        if($property->user_id == auth()->id()){
            
            Alert::warning('Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!', 'Offer Rejected')->autoclose(3000);
            return back()->with("warning", "Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!");
        }
       
        if ($validator->fails()) {
            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        if (Gedung::find(request('buildingid'))->offer > 0) {

            $currentMax = Gedung::find(request('buildingid'))->offers->sortBy('offerAmount')->last()->offerAmount;

            if ($currentMax > request('offeramount')) {

                Alert::warning('Penawaran Anda harus lebih tinggi dari penawaran saat ini!', 'Offer Rejected')->autoclose(3000);
                return back()->with("warning", "Penawaran Anda harus lebih tinggi dari penawaran saat ini!");
            }
        }
        $offer = new Transaksi();
        $offer->property_id =  request('propertyid');
        $offer->gudang_id =  request('buildingid');
        $offer->offeredUser = auth()->id();
        $offer->offerAmount = request('offeramount');
        $offer->save();

        Alert::success('Penawaran Anda telah berhasil dikirimkan!', 'Offer Submitted')->autoclose(3000);
        return back()->with("success", "Penawaran Anda telah berhasil dikirimkan !");
    }


    public function transaksiApartemen(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'offeramount' => "required|regex:/^\d+(\.\d{1,2})?$/"
        ]);
        
       $property = Property::find(request('propertyid'));

        if($property->user_id == auth()->id()){
            
            Alert::warning('Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!', 'Offer Rejected')->autoclose(3000);
            return back()->with("warning", "Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!");
        }

        if ($validator->fails()) {
            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        if (Apartemen::find(request('apartmentid'))->offer > 0) {

            $currentMax = Apartemen::find(request('apartmentid'))->offers->sortBy('offerAmount')->last()->offerAmount;

            if ($currentMax > request('offeramount')) {

                Alert::warning('Penawaran Anda harus lebih tinggi dari penawaran saat ini!', 'Offer Rejected')->autoclose(3000);
                return back()->with("warning", "Penawaran Anda harus lebih tinggi dari penawaran saat ini!");
            }
        }
        $offer = new Transaksi();
        $offer->property_id =  request('propertyid');
        $offer->apartemen_id =  request('apartmentid');
        $offer->offeredUser = auth()->id();
        $offer->offerAmount = request('offeramount');
        $offer->save();

        Alert::success('Penawaran Anda telah berhasil dikirimkan!', 'Offer Submitted')->autoclose(3000);
        return back()->with("success", "Penawaran Anda telah berhasil dikirimkan !");
    }


    public function transaksiGudang(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'offeramount' => "required|regex:/^\d+(\.\d{1,2})?$/"
        ]);
        
        $property = Property::find(request('propertyid'));

        if($property->user_id == auth()->id()){
            
            Alert::warning('Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!', 'Offer Rejected')->autoclose(3000);
            return back()->with("warning", "Anda tidak dapat mengirimkan penawaran untuk properti Anda sendiri!");
        }
       
        if ($validator->fails()) {
            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }
        
        if (Gudang::find(request('warehouseid'))->offer > 0) {

            $currentMax = Gudang::find(request('warehouseid'))->offers->sortBy('offerAmount')->last()->offerAmount;

            if ($currentMax > request('offeramount')) {

                Alert::warning('Penawaran Anda harus lebih tinggi dari penawaran saat ini!', 'Offer Rejected')->autoclose(3000);
                return back()->with("warning", "Penawaran Anda harus lebih tinggi dari penawaran saat ini!");
            }
        }
        $offer = new Transaksi();
        $offer->property_id =  request('propertyid');
        $offer->gudang_id =  request('warehouseid');
        $offer->offeredUser = auth()->id();
        $offer->offerAmount = request('offeramount');
        $offer->save();

        if ($validator->fails()) {
            Alert::error('Penawaran Anda harus lebih tinggi dari penawaran saat ini!', 'Offer Rejected')->autoclose(3000);
        } else {

            Alert::success('Penawaran Anda telah berhasil dikirimkan!', 'Offer Submitted')->autoclose(3000);
            return back()->with("success", "Penawaran Anda telah berhasil dikirimkan !");
        }
    }
}
