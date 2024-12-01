<?php

namespace App\Http\Controllers\Product_Ordering_Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupen_Code;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Mail;
use Session;

class booking extends Controller
{
    public function opencheckoutpage()
    {
        return view('Product-Order-Screens.checkout');
    }

    public function shippingPaymentScreen()
    {
        return view('Product-Order-Screens.Shipping_Payment_Screen');
    }

    public function orderProceed(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'Payment_Method' => 'required',
            'Door_No' => 'required|max:60',
            'LandMark' => 'required|max:60',
            'city' => 'required|max:60|regex:/^[a-zA-Z\s]*$/',
            'state' => 'required|max:60|regex:/^[a-zA-Z\s]*$/',
            'pincode' => 'required|digits_between:4,10',
            'mno' => 'required|digits:10',
            'alternativemno' => 'nullable|digits:10',
            'country' => 'required|max:30|regex:/^[a-zA-Z\s]*$/',
        ]);

        // Collect delivery details
        $address1 = $request->input('Door_No');
        $address2 = $request->input('LandMark');
        $city = $request->input('city');
        $state = $request->input('state');
        $pincode = $request->input('pincode');
        $mno = $request->input('mno');
        $alternativemno = $request->input('alternativemno');
        $country = $request->input('country');

        // Prepare delivery address
        $deliveryAddress = "$address1, $address2<br>$city, $state, $country<br>$pincode, $mno, $alternativemno";

        // Calculate order details
        $total = 0;
        $deliveryCharges = 0;
        $orderDetails = '';

        if (session('cart')) {
            foreach (session('cart') as $id => $details) {
                $total += $details['Final_Price'] * $details['item_quantity'];
                $orderDetails .= "<br>Product Name: {$details['item_name']}, Quantity: {$details['item_quantity']}<br>Price: {$details['Final_Price']}";
                $deliveryCharges += $details['delivery_charges'];
            }
        }

        // Adjust total based on promo code
        $promoCode = session('promocode');
        $discount = session('discount', 0);
        $amount = $total + $deliveryCharges - ($promoCode ? ($discount * $total / 100) : 0);

        // Create Order
        $order = new Order();
        $order->Customer_Emailid = Auth::user()->email;
        $order->Delivery_Address = $deliveryAddress;
        $order->Order_Details = $orderDetails;
        $order->Coupen_Code = $promoCode;
        $order->Amount = $amount;
        $order->paymentmode = $request->input('Payment_Method');
        $order->save();

        $orderId = $order->id;

        // Handle payment method
        if ($request->input('Payment_Method') === 'Online') {
            return redirect("proceed_to_Payment/$orderId");
        } else {
            // Send confirmation email
            $this->sendConfirmationEmail($orderId, $deliveryAddress, $amount);

            // Clear session data
            Session::forget('cart');
            Session::forget('discount');
            Session::forget('promocode');

            return redirect("/Orders")->with('status', 'Order Placed Successfully!');
        }
    }

    protected function sendConfirmationEmail($orderId, $deliveryAddress, $amount)
    {
        $email = Auth::user()->email;
        $name = Auth::user()->name;

        $emailContent = [
            'WelcomeMessage' => "Hello $name,<br>",
            'emailBody' => "Your Order Was Placed Successfully<br>
                <p>Thank you for your order. We’ll send a confirmation when your order ships. Your estimated delivery date is 3-5 working days.
                If you would like to view the status of your order or make any changes, please visit Your Orders on <a href='https://www.gainaloe.com'>Gainaloe.com</a></p>
                <h4>Order Details:</h4>
                <p>Order No: $orderId</p>
                <p><strong>Delivery Address:</strong> $deliveryAddress</p>
                <p><strong>Total Amount:</strong> $amount</p>"
        ];

        Mail::send(['html' => 'emails.order_email'], $emailContent, function ($message) use ($email, $name, $orderId) {
            $message->to($email, $name)->subject("Your Gainaloe.com order $orderId is Confirmed");
            $message->from('codetalentum@btao.in', 'Gainaloe');
        });
    }
}
