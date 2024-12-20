<?php
require('fpdf/fpdf.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "watch_store");
    if (!$con) {
        die("DB not connected: " . mysqli_connect_error());
    }

    // Fetch the order details from the database
    $sql = "SELECT orders.order_id, products.model, products.price, orders.order_date, orders.address, orders.status
            FROM orders
            JOIN products ON orders.product_id = products.productid
            WHERE orders.order_id = $order_id";
    $result = mysqli_query($con, $sql);
    $order = mysqli_fetch_assoc($result);

    mysqli_close($con);

    // Create a new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', 'B', 16);

    // Add a title
    $pdf->Cell(0, 10, 'Invoice for Order ID: ' . $order['order_id'], 0, 1, 'C');
    $pdf->Ln(10);

    // Add order details
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Model: ' . $order['model'], 0, 1);
    $pdf->Cell(0, 10, 'Price: ₹' . number_format($order['price'], 2), 0, 1);
    $pdf->Cell(0, 10, 'Order Date: ' . $order['order_date'], 0, 1);
    $pdf->Cell(0, 10, 'Address: ' . $order['address'], 0, 1);
    $pdf->Cell(0, 10, 'Status: ' . $order['status'], 0, 1);

    // Output the PDF as a download
    $pdf->Output('D', 'invoice_order_' . $order['order_id'] . '.pdf');
} else {
    echo "Invalid order ID.";
}
?>
