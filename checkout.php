<?php include 'razorpay-config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h2>Complete Your Payment</h2>
    <button id="payBtn">Pay ₹500</button>

    <script>
        var options = {
            "key": "<?php echo $keyId; ?>",
            "amount": "50000", // Amount in paise = ₹500
            "currency": "INR",
            "name": "Grocery Store",
            "description": "Order Payment",
            "handler": function (response){
                alert("Payment successful! ID: " + response.razorpay_payment_id);
                window.location.href = "success.php?payment_id=" + response.razorpay_payment_id;
            },
            "prefill": {
                "name": "M.",
                "email": "user@example.com"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('payBtn').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>