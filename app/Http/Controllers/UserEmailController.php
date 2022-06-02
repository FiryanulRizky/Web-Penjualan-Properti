<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Mail\InqueryEmail;
use App\UserEmail;
use App\User;
use Alert;
use Illuminate\Support\Facades\Validator;

class UserEmailController extends Controller
{
    public function kontakRumah(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'pno' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2500|min:10'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $owner = \App\User::find(request('owner'));

        $message = new UserEmail;
        $message->receiver_id = request('owner');
        $message->sender_id = request('sender');
        $message->senderMail = request('email');
        $message->senderName = request('name');
        $message->phoneNo = request('pno');
        $message->subject = request('subject');
        $message->message = request('message');
        $message->property_url = request('path');
        $message->save();

        \Mail::to($owner->email)->send(new ContactMail($request));
        
        Alert::success('Pesan Anda telah berhasil dikirim!', 'Pesan terkirim')->autoclose(3000);

        return back();

    }

    public function kontakLahan(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'pno' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2500|min:10'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $owner = \App\User::find(request('owner'));

        $message = new UserEmail;
        $message->receiver_id = request('owner');
        $message->sender_id = request('sender');
        $message->senderMail = request('email');
        $message->senderName = request('name');
        $message->phoneNo = request('pno');
        $message->subject = request('subject');
        $message->message = request('message');
        $message->property_url = request('path');
        $message->save();

        \Mail::to($owner->email)->send(new ContactMail($request));
        
        Alert::success('Pesan Anda telah berhasil dikirim!', 'Pesan terkirim')->autoclose(3000);

        return back();

    }

    public function kontakBangunan(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'pno' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2500|min:10'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $owner = \App\User::find(request('owner'));

        $message = new UserEmail;
        $message->receiver_id = request('owner');
        $message->sender_id = request('sender');
        $message->senderMail = request('email');
        $message->senderName = request('name');
        $message->phoneNo = request('pno');
        $message->subject = request('subject');
        $message->message = request('message');
        $message->property_url = request('path');
        $message->save();


        \Mail::to($owner->email)->send(new ContactMail($request));
        
        Alert::success('Pesan Anda telah berhasil dikirim!', 'Pesan terkirim')->autoclose(3000);

        return back();

    }

    public function kontakApartemen(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'pno' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2500|min:10'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $owner = \App\User::find(request('owner'));

        $message = new UserEmail;
        $message->receiver_id = request('owner');
        $message->sender_id = request('sender');
        $message->senderMail = request('email');
        $message->senderName = request('name');
        $message->phoneNo = request('pno');
        $message->subject = request('subject');
        $message->message = request('message');
        $message->property_url = request('path');
        $message->save();


        \Mail::to($owner->email)->send(new ContactMail($request));
        
        Alert::success('Pesan Anda telah berhasil dikirim!', 'Pesan terkirim')->autoclose(3000);

        return back();

    }

    public function kontakGudang(Request $request)
    {
 
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'pno' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2500|min:10'
        ]);
        
       
        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }

        $owner = \App\User::find(request('owner'));

        $message = new UserEmail;
        $message->receiver_id = request('owner');
        $message->sender_id = request('sender');
        $message->senderMail = request('email');
        $message->senderName = request('name');
        $message->phoneNo = request('pno');
        $message->subject = request('subject');
        $message->message = request('message');
        $message->property_url = request('path');
        $message->save();


        \Mail::to($owner->email)->send(new ContactMail($request));
        
        Alert::success('Pesan Anda telah berhasil dikirim!', 'Pesan terkirim')->autoclose(3000);

        return back();

    }

    public function balasPesan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:2500|min:10'
        ]);

        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }
        
        $message = new UserEmail;
        $message->receiver_id = request('owner');
        $message->sender_id = auth()->user()->id;
        $message->senderMail = auth()->user()->email;
        $message->senderName = auth()->user()->name;
        $message->phoneNo = auth()->user()->phoneNo;
        $message->subject = request('subject');
        $message->message = request('message');
        $message->property_url = request('path');
        $message->save();

        $request->name = auth()->user()->name;
        $request->email = auth()->user()->email;
        $request->pno = auth()->user()->phoneNo;
        $request->property_url = request('path');


        \Mail::to(request('email'))->send(new ContactMail($request));
        
        Alert::success('Pesan Anda telah berhasil dikirim!', 'Pesan terkirim')->autoclose(3000);

        return back();

    }

    public function kirimKontakTransaksi(Request $request){
        
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:2500|min:10'
        ]);

        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }
        
        $message = new UserEmail;
        $message->receiver_id = request('owner');
        $message->sender_id = auth()->user()->id;
        $message->senderMail = auth()->user()->email;
        $message->senderName = auth()->user()->name;
        $message->phoneNo = auth()->user()->phoneNo;
        $message->subject = request('subject');
        $message->message = request('message');
        $message->property_url = request('path');
        $message->save();

        $request->name = auth()->user()->name;
        $request->email = auth()->user()->email;
        $request->pno = auth()->user()->phoneNo;
        $request->property_url = request('path');

        $user = User::find(request('owner'));
        \Mail::to($user->email)->send(new ContactMail($request));
        
        Alert::success('Pesan Anda telah berhasil dikirim!', 'Pesan terkirim')->autoclose(3000);

        return back();
    }

    public function kirimKontakPemilikTransaksi(Request $request){
        
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:2500|min:10'
        ]);

        if ($validator->fails()) {

            Alert::error('Silahkan periksa input Anda dan perbaiki kesalahan berikut', 'Percobaan Tidak Valid')->autoclose(3000);
            return back()->withErrors($validator);
        }
        
        $message = new UserEmail;
        $message->receiver_id = request('owner');
        $message->sender_id = auth()->user()->id;
        $message->senderMail = auth()->user()->email;
        $message->senderName = auth()->user()->name;
        $message->phoneNo = auth()->user()->phoneNo;
        $message->subject = request('subject');
        $message->message = request('message');
        $message->property_url = request('path');
        $message->save();

        $request->name = auth()->user()->name;
        $request->email = auth()->user()->email;
        $request->pno = auth()->user()->phoneNo;
        $request->property_url = request('path');

        $user = User::find(request('owner'));
        \Mail::to($user->email)->send(new ContactMail($request));
        
        Alert::success('Pesan Anda telah berhasil dikirim!', 'Pesan terkirim')->autoclose(3000);

        return back();
    }
}
