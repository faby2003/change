<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        /* Basic styling for the payment page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .payment-form label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        .payment-form input[type="text"],
        .payment-form input[type="number"],
        .payment-form select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .payment-form input[type="radio"] {
            margin-right: 10px;
        }

        .payment-form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .payment-form button:hover {
            background-color: #0056b3;
        }

        #card-details {
            margin-top: 20px;
        }

        #card-details h3 {
            margin-top: 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Select Payment Method</h2>
        <form id="payment-form" method="post" action="process_payment.php" class="payment-form">
            <label>
                <input type="radio" name="payment_method" value="COD" required> Cash on Delivery
            </label>
            <label>
                <input type="radio" name="payment_method" value="Card" required> Credit/Debit Card
            </label>
            <label for="address">Delivery Address:</label>
            <input type="text" id="address" name="address" required>

            <div id="card-details" style="display: none;">
                <h3>Card Details</h3>
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number">
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" id="expiry_date" name="expiry_date">
                <label for="cvv">CVV:</label>
                <input type="number" id="cvv" name="cvv">
            </div>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($_POST['order_id']); ?>">
            <button type="submit">Proceed</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('input[name="payment_method"]').forEach(input => {
            input.addEventListener('change', function () {
                document.getElementById('card-details').style.display = this.value === 'Card' ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>
