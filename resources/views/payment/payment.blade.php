<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <!-- razorpay_payment.blade.php -->
    <form method="POST" action="{{ route('razorpayPayment') }}">
    @csrf
    <input type="hidden" name="service_id" value="{{ $service->id }}">
    <input type="hidden" name="amount" value="{{ $service->price * 100 }}"> <!-- Convert to paisa -->
    <!-- Include other necessary Razorpay fields -->
    <button type="submit">Proceed to Payment</button>
</form>
</body>
</html>