<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $quotationNo = $_POST['quotationNo'];
    $quotationTo = $_POST['quotationTo'];
    $mobileno = $_POST['mobileno'];
    $quotationAmount = $_POST['quotationAmount'];
    $subtotal = $_POST['subtotal'];
    $profit = $_POST['profit'];
    $loss = $_POST['loss'];

  
    $sql1 = "INSERT INTO admin (date, `quotation No`, `quotation To`, `mobileno`,`quotation Amount`, subtotal, profit, loss)
             VALUES ('$date', '$quotationNo', '$quotationTo','$mobileno', '$quotationAmount', '$subtotal', '$profit', '$loss')";

    if ($con->query($sql1) === TRUE) {
        $last_id = $con->insert_id;

        for ($i = 1; isset($_POST["item$i"]); $i++) {
            $item = $_POST["item$i"];
            $price = $_POST["price$i"];
            $qty = $_POST["qty$i"];
            $total = $_POST["total$i"];

            $sql2 = "INSERT INTO admin2 (`quotation id`, s_no, item, price, qty, total)
              VALUES ('$last_id', '$_sno', '$item', '$price', '$qty', '$total')";

            $con->query($sql2);
        }

        echo "New record created successfully";
    } else {
        echo "Error: " . $sql1 . "<br>" . $con->error;
    }
}

$con->close();
?>