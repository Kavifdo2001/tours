<?php

namespace App\Http\Controllers;


use App\Mail\AdminTourNotification;
use App\Mail\ContactMail;
use App\Mail\TourBookingConfirmation;
use App\Models\Booking;
use App\Models\Comment;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;


class UserController extends Controller
{
    public function user_profile()
    {
        $user = Auth::user();
        $tours = Package::where('user_id', $user->id)->get();
        $bookings = Booking::where('user_id', $user->id)->get();
        return view('pages.user.userProfile', compact('user','tours','bookings'));
    }

    public function user_profile_edit()
    {
        $user = Auth::user();
        return view('pages.user.editProfile', compact('user'));
    }

    public function user_profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;


        if ($request->hasFile('profile_image')) {

            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profile'), $imageName);
            $user->profile_image = 'images/profile/' . $imageName;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
    public function user_change_Password(Request $request)
    {
        $request->validate([
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Password changed successfully');
    }


    public function user_tours($id)
    {
        $tour = Package::findOrFail($id);

        return view('pages.user.UserPackages', compact('tour'));
    }



    public function book_tour(Request $request, $id)
    {
        $adminMail = "kavinduf774@gmail.com";

        $user = Auth::user();
        $tour = Package::find($id);

        if (!$tour) {
            return back()->with('error', 'Package not found.');
        }

        $total = $request->total_amount;
        $persons = $request->no_of_persons;

        $totalAmount= $total * $persons;

//       dd($totalAmount);

        $booking = new Booking();
        $booking->package_id = $tour->id;
        $booking->user_id = $user->id;
        $booking->status = "booked";
        $booking->total_amount = $totalAmount;
        $booking->no_of_persons = $request->no_of_persons;


        $booking->save();

        if ($tour->type == "custom"){
            $package = Package::find($id);
            $package->status = "booked";

            $package->save();
        }

        Mail::to($user->email)->send(new TourBookingConfirmation($user, $tour, $totalAmount));
        Mail::to($adminMail)->send(new AdminTourNotification($user, $tour,$totalAmount, $booking));

        return redirect()->route('profile')->with('success', 'Your Tour Booked.');

    }

    public function view_booked_tours($id)
    {
        $tour = Booking::find($id);

        return view('pages.user.UserBookings', compact('tour'));
    }

    public function send_email(Request $request)
    {
        $adminEmail = 'info@kingsrilankatours.com';

        // Collect the form data
        $contactDetails = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'contact' => $request->input('contact'),
        ];

        // Send the email to the admin
        Mail::to($adminEmail)->send(new ContactMail($contactDetails));

        return back()->with('success', 'We will contact you soon.');
    }



    public function user_comment(Request $request)
    {
        $user = Auth::user();

        Comment::create([
           'user_id' => $user->id,
            'comment' => $request->comment,
        ]);

        return back()->with('success','Your comment uploaded');
    }


}
