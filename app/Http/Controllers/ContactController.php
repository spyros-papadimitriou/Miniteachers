<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller {

    public function show() {
        $title = 'Επικοινωνία';

        return view('pages.contact', ['title' => $title]);
    }

    public function send(Request $request) {
        $request->validate(
                ['name' => 'required|min:6|max:64',
            'email' => 'required|email',
            'subject' => 'required',
            'content' => 'required|max:255',
            'g-recaptcha-response' => 'required|recaptcha'
                ], ['name.required' => 'Δεν έχετε συμπληρώσει όνομα.',
            'name.min' => 'Το όνομα πρέπει να αποτελείται από τουλάχιστον 6 χαρακτήρες.',
            'name.max' => 'Το όνομα πρέπει να περιέχει το πολύ 64 χαρακτήρες.',
            'email.required' => 'Δεν έχετε συμπληρώσει email.',
            'email.email' => 'Το email δεν είναι έγκυρο.',
            'subject.required' => 'Δεν έχετε συμπληρώσει θέμα του email σας.',
            'content.required' => 'Δεν έχετε συμπληρώσει το μήνυμά σας.',
            'g-recaptcha-response.required' => 'Δεν έχετε συμπληρώσει το reCAPTCHA.',
            'g-recaptcha-response.recaptcha' => 'Το reCAPTCHA δεν είναι έγκυρο.']
        );

        Mail::send('emails.contact', ['title' => "Φόρμα Επικοινωνίας", 'name' => $request->name, 'email' => $request->email, 'subject' => $request->subject, 'content' => $request->content], function ($message) use ($request) {
            $message->from('info@spyrospapadimitriou.gr', 'Spyros Papadimitriou');
            $message->to('puma1140@gmail.com');
            $message->subject("Φόρμα επικοινωνίας: " . $request->subject);
        });

        $request->session()->flash('message', 'Τα στοιχεία της φόρμας στάλθηκαν με επιτυχία.');

        return view('pages.contact');
    }

}
