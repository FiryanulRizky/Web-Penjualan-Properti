<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReportProperty;
use Illuminate\Support\Facades\Validator;
use Alert;

class ReportPropertyController extends Controller
{
    public function reportRumah(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|email',
            'reason' => 'required|string|max:200'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $report = new ReportProperty;
        $report->property_id = request('propertyid');
        $report->rumah_id = request('houseid');
        $report->reporterEmail = request('email');
        $report->Reason = request('reason');
        $report->save();

        
        Alert::success('Laporan Anda telah berhasil dikirim!', 'Report Dikirim')->autoclose(3000);

        return back();

    }

    public function reportLahan(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|email',
            'reason' => 'required|string|max:200'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $report = new ReportProperty;
        $report->property_id = request('propertyid');
        $report->lahan_id = request('landid');
        $report->reporterEmail = request('email');
        $report->Reason = request('reason');
        $report->save();

        
        Alert::success('Laporan Anda telah berhasil dikirim!', 'Report Dikirim')->autoclose(3000);

        return back();

    }

    public function reportGedung(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|email',
            'reason' => 'required|string|max:200'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $report = new ReportProperty;
        $report->property_id = request('propertyid');
        $report->gedung_id = request('buildingid');
        $report->reporterEmail = request('email');
        $report->Reason = request('reason');
        $report->save();

        
        Alert::success('Laporan Anda telah berhasil dikirim!', 'Report Dikirim')->autoclose(3000);

        return back();

    }

    public function reportApartemen(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|email',
            'reason' => 'required|string|max:200'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $report = new ReportProperty;
        $report->property_id = request('propertyid');
        $report->apartemen_id = request('apartmentid');
        $report->reporterEmail = request('email');
        $report->Reason = request('reason');
        $report->save();

        
        Alert::success('Laporan Anda telah berhasil dikirim!', 'Report Dikirim')->autoclose(3000);

        return back();

    }

    public function reportGudang(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255|email',
            'reason' => 'required|string|max:200'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $report = new ReportProperty;
        $report->property_id = request('propertyid');
        $report->gudang_id = request('warehouseid');
        $report->reporterEmail = request('email');
        $report->Reason = request('reason');
        $report->save();

        
        Alert::success('Laporan Anda telah berhasil dikirim!', 'Report Dikirim')->autoclose(3000);

        return back();

    }
}
