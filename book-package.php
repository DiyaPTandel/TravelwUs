<?php
include 'header.php';
require 'db-connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit();
}

// Get package ID
$package_id = $_GET['id'] ?? '';

// Fetch package details
try {
    $stmt = $pdo->prepare("SELECT * FROM packages WHERE package_id = ?");
    $stmt->execute([$package_id]);
    $package = $stmt->fetch();

    if (!$package) {
        echo "Package not found";
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $travel_date = $_POST['travel_date'] ?? '';
    $num_travelers = $_POST['num_travelers'] ?? '';
    $total_price = $package['price'] * $num_travelers;

    try {
        $stmt = $pdo->prepare("INSERT INTO package_bookings (id, package_id, travel_date, num_travelers, total_price) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $package_id,
            $travel_date,
            $num_travelers,
            $total_price
        ]);
        
        $booking_id = $pdo->lastInsertId();
        header('Location: booking-confirmation.php?booking_id=' . $booking_id . '&type=package');
        exit();
    } catch(PDOException $e) {
        $error = "Booking failed: " . $e->getMessage();
    }
}
?>

<div class="booking-container">
    <div class="booking-summary">
        <h2>Package Booking</h2>
        <div class="package-details">
            <img src="<?php echo htmlspecialchars($package['image_url']); ?>" alt="<?php echo htmlspecialchars($package['name']); ?>" class="package-image">
            <h3><?php echo htmlspecialchars($package['name']); ?></h3>
            <p class="duration"><?php echo htmlspecialchars($package['duration']); ?></p>
            <p class="description"><?php echo htmlspecialchars($package['description']); ?></p>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" class="booking-form" id="packageBookingForm">
            <div class="form-group">
                <label for="travel_date">Travel Date</label>
                <input type="date" id="travel_date" name="travel_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="num_travelers">Number of Travelers</label>
                <select id="num_travelers" name="num_travelers" class="form-control" required>
                    <option value="">Select number of travelers</option>
                    <?php for($i = 1; $i <= 7; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?> Traveler<?php echo $i > 1 ? 's' : ''; ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="price-summary">
                <div class="price-item">
                    <span>Price per person:</span>
                    <strong>₹<?php echo number_format($package['price']); ?></strong>
                </div>
                <div class="price-item total" id="totalPrice" style="display: none;">
                    <span>Total Price:</span>
                    <strong></strong>
                </div>
            </div>

            <button type="submit" class="confirm-booking">Book Package</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Set minimum date as tomorrow
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var tomorrowStr = tomorrow.toISOString().split('T')[0];
    $('#travel_date').attr('min', tomorrowStr);

    // Calculate total price
    $('#num_travelers').change(function() {
        var numTravelers = $(this).val();
        var pricePerPerson = <?php echo $package['price']; ?>;
        if(numTravelers) {
            var total = numTravelers * pricePerPerson;
            $('#totalPrice strong').text('₹' + total.toLocaleString());
            $('#totalPrice').show();
        } else {
            $('#totalPrice').hide();
        }
    });

    // Form validation
    $("#packageBookingForm").validate({
        rules: {
            travel_date: {
                required: true,
                date: true
            },
            num_travelers: {
                required: true
            }
        },
        messages: {
            travel_date: {
                required: "Please select travel date",
                date: "Please enter a valid date"
            },
            num_travelers: {
                required: "Please select number of travelers"
            }
        },
        errorClass: "text-danger",
        errorElement: "div"
    });
});
</script>

<style>
    .booking-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .booking-summary {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    }

    .package-details {
        text-align: center;
        margin-bottom: 40px;
    }

    .package-image {
        width: 100%;
        max-width: 800px;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    h2 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    h3 {
        font-size: 2rem;
        color: #444;
        margin-bottom: 15px;
    }

    .duration {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 20px;
    }

    .description {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .booking-form {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        font-size: 1.1rem;
        color: #444;
        margin-bottom: 10px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
    }

    .price-summary {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin: 30px 0;
    }

    .price-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        font-size: 1.1rem;
    }

    .price-item.total {
        border-top: 2px solid #ddd;
        margin-top: 10px;
        padding-top: 20px;
        font-size: 1.3rem;
        font-weight: bold;
    }

    .confirm-booking {
        width: 100%;
        padding: 15px;
        background: #ff4444;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.2rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
    }

    .confirm-booking:hover {
        background: #ff2020;
    }

    .error-message {
        color: #ff4444;
        background: #ffe6e6;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>