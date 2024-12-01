<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Order;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Mail;

class UserController extends Controller
{
    public function subscribe(Request $request)
    {
        $NewsLetter = new NewsLetter();
        $NewsLetter->name = $request->input('name');
        $NewsLetter->email = $request->input('email');
        $NewsLetter->save();
        return redirect()->back()->with('status', 'Thanks for Subscribing! We Will mail You Our Latest Updates');
    }

    public function index()
    {
        return view('dashboards.user.index');
    }

    public function open_profile()
    {
        return view('dashboards.user.profile');
    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'name' => 'nullable|max:60',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'LandMark' => 'nullable|max:60',
            'city' => 'nullable|max:60|regex:/^[a-zA-Z\s]*$/',
            'state' => 'nullable|max:60|regex:/^[a-zA-Z\s]*$/',
            'pincode' => 'nullable|digits_between:4,10',
            'mno' => 'nullable|digits:10',
            'alternativemno' => 'nullable|digits:10',
            'country' => 'nullable|max:30|regex:/^[a-zA-Z\s]*$/',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name', $user->name);
        $user->address1 = $request->input('address1', $user->address1);
        $user->address2 = $request->input('address2', $user->address2);
        $user->LandMark = $request->input('LandMark', $user->LandMark);
        $user->city = $request->input('city', $user->city);
        $user->state = $request->input('state', $user->state);
        $user->pincode = $request->input('pincode', $user->pincode);
        $user->mnumber = $request->input('mno', $user->mnumber);
        $user->alternativemno = $request->input('alternativemno', $user->alternativemno);
        $user->country = $request->input('country', $user->country);

        // Handle image upload
        if ($request->hasFile('image')) {
            $destination = 'Uploads/profiles/' . $user->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('Uploads/profiles/', $filename);
            $user->image = $filename;
        }

        $user->save();
        return redirect()->back()->with('successstatus', 'Your Profile Data is Updated Successfully');
    }

    public function open_orders()
    {
        return view('dashboards.user.orders');
    }

    public function open_transactions()
    {
        return view('dashboards.user.transactions');
    }

    public function updatepassword(Request $request)
    {
        $validation = $request->validate([
            'newpass' => 'required',
            'confirm_new_Pass' => 'required',
        ]);

        $newpass = $request->input('newpass');
        $confirm_new_Pass = $request->input('confirm_new_Pass');
        if ($confirm_new_Pass == $newpass) {
            $user = Auth::user();
            $user->password = Hash::make($newpass);
            $user->save();
            return redirect()->back()->with('successstatus', 'Password is Updated Successfully');
        } else {
            return redirect()->back()->with('passwordwontmatch', 'Password Won\'t Match! Please Try Again!!');
        }
    }

    public function send_email(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:30|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email',
            'subject' => 'required|max:80',
            'message' => 'required|max:300',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        $emailto = "demelashasires4@gmail.com";
        $recievername = "Admin";

        // Mail logic
        $welcomemessage = 'Hello Admin';
        $emailbody = 'I am ' . $name . '<br><p><strong>My Query/Message: </strong> :' . $message . '</p><br><strong>My Emailid: </strong>' . $email . '<br>';
        $emailcontent = [
            'WelcomeMessage' => $welcomemessage,
            'emailBody' => $emailbody
        ];

        Mail::send(['html' => 'emails.order_email'], $emailcontent, function($message) use ($emailto, $subject, $recievername) {
            $message->to($emailto, $recievername)->subject('Hello Admin New Mail From your Client/Customer:' . $subject);
            $message->from('codetalentum@btao.in', 'CodeTalentum');
        });

        return redirect()->back()->with('status', 'Thank you for contacting us,
        we will reach you as soon as possible');
    }
}
