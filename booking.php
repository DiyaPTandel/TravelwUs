<?php
include 'header.php';
require 'db-connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit();
}

// Get booking parameters
$hotel_id = $_GET['hotel_id'] ?? '';
$check_in = $_GET['check_in'] ?? '';
$check_out = $_GET['check_out'] ?? '';
$guests = $_GET['guests'] ?? '';

// Fetch hotel details
try {
    $stmt = $pdo->prepare("SELECT * FROM hotels WHERE hotel_id = ?");
    $stmt->execute([$hotel_id]);
    $hotel = $stmt->fetch();

    if (!$hotel) {
        echo "Hotel not found";
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Calculate total nights and price
$check_in_date = new DateTime($check_in);
$check_out_date = new DateTime($check_out);
$nights = $check_in_date->diff($check_out_date)->days;
$total_price = $hotel['price_per_night'] * $nights;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO bookings (id, hotel_id, check_in_date, check_out_date, num_guests, total_price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $hotel_id,
            $check_in,
            $check_out,
            $guests,
            $total_price
        ]);
        
        $booking_id = $pdo->lastInsertId();
        header('Location: booking-confirmation.php?booking_id=' . $booking_id);
        exit();
    } catch(PDOException $e) {
        $error = "Booking failed: " . $e->getMessage();
    }
}
?>

<div class="booking-container">
    <div class="booking-summary">
        <h2>Booking Summary</h2>
        <div class="hotel-details">
            <img src="<?php echo htmlspecialchars($hotel['image_url']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>" class="hotel-image">
            <h3><?php echo htmlspecialchars($hotel['name']); ?></h3>
            <p class="location"><?php echo htmlspecialchars($hotel['location']); ?></p>
        </div>

        <div class="booking-details">
            <div class="detail-item">
                <span>Check-in:</span>
                <strong><?php echo date('D, M d, Y', strtotime($check_in)); ?></strong>
            </div>
            <div class="detail-item">
                <span>Check-out:</span>
                <strong><?php echo date('D, M d, Y', strtotime($check_out)); ?></strong>
            </div>
            <div class="detail-item">
                <span>Guests:</span>
                <strong><?php echo $guests; ?></strong>
            </div>
            <div class="detail-item">
                <span>Duration:</span>
                <strong><?php echo $nights; ?> nights</strong>
            </div>
        </div>

        <div class="price-summary">
            <div class="price-item">
                <span>Price per night:</span>
                <strong>₹<?php echo number_format($hotel['price_per_night']); ?></strong>
            </div>
            <div class="price-item total">
                <span>Total Price:</span>
                <strong>₹<?php echo number_format($total_price); ?></strong>
            </div>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="booking-form">
            <button type="submit" class="confirm-booking">Confirm Booking</button>
        </form>
    </div>
</div>

<style>
    .booking-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .booking-summary {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .hotel-details {
        margin: 20px 0;
        text-align: center;
    }

    .hotel-image {
        width: 100%;
        max-width: 400px;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .booking-details {
        margin: 30px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 20px 0;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
        color: #666;
    }

    .price-summary {
        margin: 20px 0;
    }

    .price-item {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
    }

    .price-item.total {
        font-size: 1.2em;
        font-weight: bold;
        border-top: 2px solid #eee;
        padding-top: 10px;
        margin-top: 10px;
    }

    .confirm-booking {
        width: 100%;
        padding: 15px;
        background: #ff4444;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .confirm-booking:hover {
        background: #ff2020;
    }

    .error-message {
        color: #ff4444;
        text-align: center;
        margin: 10px 0;
    }

    @media (max-width: 768px) {
        .booking-container {
            margin: 20px auto;
        }

        .booking-summary {
            padding: 20px;
        }
    }
</style>

<?php include 'footer.php'; ?>