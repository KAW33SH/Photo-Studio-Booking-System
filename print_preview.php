<?php
include 'connection.php'; // Include your connection file

// Retrieve the reservation ID from the query string
$reservationId = $_GET['reservationId'];

// Retrieve the reservation details from the database
try {
    $stmt = $conn->prepare('SELECT reservations.date, studios.name AS studio_name, time_slots.time, packages.name AS package_name, packages.price, reservations.advance_payment, reservations.status FROM reservations
                            INNER JOIN studios ON reservations.studio_id = studios.id
                            INNER JOIN time_slots ON reservations.time_slot_id = time_slots.id
                            INNER JOIN packages ON reservations.package_id = packages.id
                            WHERE reservations.id = :reservationId');
    $stmt->bindParam(':reservationId', $reservationId);
    $stmt->execute();
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    // Calculate the total by subtracting the advance payment from the package price
    $total = $reservation['price'] - $reservation['advance_payment'];
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    exit();
}



// Generate the printable version of the bill
$html = '
<style>

html {
    /* Change the background color to your desired color */
    background-color: #f5f5f5;
}

.bill-container {
    width: 500px;
    margin: 0 auto;
    padding: 20px;
    border: 8px solid #000000;
    font-family: Arial, sans-serif;
    background-color: #a3a3a315;
}

.bill-title {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.bill-category {
    margin-top: 20px;
    margin-bottom: 10px;
    color: #555;
    font-weight: bold;
}

.bill-info {
    margin-bottom: 10px;
    color: #555;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-bottom: 1px solid #ccc;
    padding-bottom: 5px;
}

.bill-info label {
    font-weight: bold;
    flex-basis: 40%;
}

.bill-info p {
    margin: 0;
    flex-basis: 60%;
    text-align: right;
}

.bill-total {
    margin-top: 40px;
    text-align: right;
    font-weight: bold;
    color: #333;
}

.bill-studio-logo {
    width: 150px;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    display: block;
}

.bill-studio-info {
    text-align: left;
    color: #ac8355;
    font-size: 12px;
}

.bill-divider {
    border-top: 1px solid #ccc;
    margin-top: 10px;
    margin-bottom: 10px;
}

.bill-title {
    text-align: left;
    font-size: 24px;
    margin-bottom: 20px;
    color: #000000;
    text-shadow:
        -1px -1px 0 #6969697e,
        /* Top left */
        1px -1px 0 #6969697e,
        /* Top right */
        -1px 1px 0 #6969697e,
        /* Bottom left */
        1px 1px 0 #6969697e;
    /* Bottom right */
}

.bill-table {
    width: 100%;
    border-collapse: separate;
    margin-bottom: 20px;
    background-color: #94949486;
    border-spacing: 10px;
}

.bill-table th {
    padding: 8px;
    border: 2px solid #000000;
    background-color: #686868;
    font-family: sans-serif;
}

.bill-table td {
    padding: 8px;
    border: 2px solid #0000006c;
    font-family: monospace;
    font-weight: bolder;
}

.td1 {
    font-style: italic;
}

.bill-category {
    color: #000000;
}

.bill-studio p {
    font-size: 12px;
    font-family: Arial, sans-serif;
    color: #555;
    font-style: italic;
  }
 

</style>
<div class="bill-container">
    <img class="bill-studio-logo" src="assets/images/photo_studio_logo.png" alt="Studio Logo">
    <h1 class="bill-title">Reservation</h1>
    <table class="bill-table">
    <tr>
        <th colspan="2" class="bill-category">Invoice</th>
    </tr>
    <tr>
        <td class="td1">ID:</td>
        <td><p>' . $reservationId . '</p></td>
    </tr>
    <tr>
        <td class="td1">Reservation Date:</td>
        <td><p>' . $reservation['date'] . '</p></td>
    </tr>
    <tr>
        <td class="td1">Time Slot:</td>
        <td><p>' . $reservation['time'] . '</p></td>
    </tr>
    <!-- Add more rows for other reservation details if needed -->
    <tr>
        <td class="td1">Studio:</td>
        <td><p>' . $reservation['studio_name'] . '</p></td>
    </tr>
    <!-- Add more rows for other studio details if needed -->

    <tr>
        <td class="td1">Package:</td>
        <td><p>' . $reservation['package_name'] . '</p></td>
    </tr>
    <tr>
        <td class="td1">Package Price:</td>
        <td><p>LKR ' . $reservation['price'] . '</p></td>
    </tr>
    <tr>
        <td class="td1">Advance Payment:</td>
        <td><p>LKR ' . $reservation['advance_payment'] . '</p></td>
    </tr>
</table>
    <div class="bill-total">
        <label>Total Payable:</label>
        <p>LKR ' . $total . '</p>
    </div>

    <div class="bill-studio-info">
        <p>No 240/B1A</p>
        <p> 6 High Level Rd</p>
        <p>Colombo 00600</p>
        <p>Phone: (94)11-555-0012</p>
        <p>Email: info@studio.com</p>
        <div class="bill-print-date">
            <p>Printed on: ' . gmdate('Y-m-d h:i:s A', time() + 19800) . '</p>
        </div>
        
    </div>
    <div class="bill-studio">
    <p "bill-studio">**this bill should be presented to the studio</p>
    </div>
</div>
';

// Output the printable bill
echo $html;