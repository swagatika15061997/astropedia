<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

                     <button type="submit" class="btn btn-primary" id="rzp-button1">Pay</button>

</body>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var urls="{{route('success')}}"
var options = {
    "key": "rzp_test_P9DP2EL6CIqXZw", // Enter the Key ID generated from the Dashboard
    "amount": "{{$razorpayOrder->amount}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Astopedia",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    "order_id": "{{$razorpayOrder->id}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        window.location.href = urls + '?payment_id=' + response.razorpay_payment_id;
    },
    "prefill": {
        "name": "Gaurav Kumar",
        "email": "gaurav.kumar@example.com",
        "contact": "9000090000"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
</html>