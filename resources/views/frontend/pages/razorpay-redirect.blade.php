<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    {{-- The viewport meta tag is used to set the visible area of the page, making it responsive on different devices --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- The http-equiv tag ensures compatibility with Internet Explorer --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- The title tag defines the title of the web page --}}
    <title>RazorPayment</title>

    {{-- Inline styles to hide the Razorpay payment button --}}
    <style>
        .razorpay-payment-button {
            display: none;
        }
    </style>
</head>
<body>
    {{-- PHP block to fetch the grand total from the session and calculate the payable amount --}}
    @php
        // Fetch the grand total value stored in the session
        $grandTotal = session()->get('grand_total');

        // Calculate the payable amount by multiplying the grand total with the Razorpay rate
        // Then multiply by 100 because Razorpay expects the amount in the smallest currency unit (paise for INR)
        $payableAmount = ($grandTotal * config('gatewaySettings.razorpay_rate')) * 100
    @endphp

    {{-- This form is used to send payment details to Razorpay --}}
    {{-- This form is triggered when the user presses the payment option --}}
    <form action="{{ route('razorpay.payment') }}" method="POST">
        {{-- CSRF protection token for the form submission --}}
        @csrf

        {{-- Razorpay Checkout script tag --}}
        <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{ config('gatewaySettings.razorpay_api_key') }}"  {{-- Razorpay API key for authentication --}}
            data-currency="{{ config('gatewaySettings.razorpay_currency') }}"  {{-- Currency for the payment --}}
            data-amount="{{ $payableAmount }}"  {{-- The amount to be paid (converted to paise) --}}
            data-buttontext="Pay"  {{-- Text that appears on the payment button --}}
            data-name="Payment"  {{-- Name displayed in the payment form --}}
            data-description="Payment for product"  {{-- Description of the payment --}}
            data-prefill.name="Jhon"  {{-- Prefilled customer name (for demonstration, replace with dynamic data) --}}
            data-prefill.email="test@gmail.com"  {{-- Prefilled customer email --}}
            data-theme.color="#ff7529"  {{-- Theme color for the Razorpay form --}}
        ></script>
    </form>

    {{-- JavaScript code to automatically press the hidden Razorpay button when the page is loaded --}}
    {{-- This function triggers the payment button automatically after the page has loaded --}}
    <script>
        // Listen for the 'DOMContentLoaded' event to ensure the HTML is fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Select the Razorpay payment button (which is hidden by default)
            var button = document.querySelector(".razorpay-payment-button");

            // Automatically click the hidden button to trigger the Razorpay payment process
            button.click();
        })
    </script>
</body>
</html>
