<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserType;
use App\Gender;

class FavouriteController extends Controller {

    public function update(Request $request, $id) {
        $user = Auth::user();
        $favourite = User::findOrFail($id);

        if ($user == $favourite) {
            $request->session()->flash('message', 'Τον εαυτό σας θέλετε να προσθέσετε στη λίστα με τους αγαπημένους; Λίγο περίεργο αυτό...');
        } elseif (!$user->favourites->contains($favourite)) {
            $user->favourites()->attach($favourite);
            $request->session()->flash('message', 'Η προσθήκη ' . ($favourite->gender->id == Gender::MALE ? 'του ' : 'της ') . ' ' . $favourite->userType->name . ' "' . $favourite->name . '" στη λίστα με τους αγαπημένους σας πραγματοποιήθηκε επιτυχώς.');
        } else {
            $user->favourites()->detach($favourite);
            $request->session()->flash('message', ($favourite->gender->id == Gender::MALE ? 'Ο ' : 'Η ') . $favourite->userType->name . ' "' . $favourite->name . '" αφαιρέθηκε από τη λίστα με τους αγαπημένους σας.');
        }

        return redirect()->route('profile-show', ['user' => $favourite->id]);
    }

}
