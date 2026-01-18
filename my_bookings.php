<?php 
include 'header.php';
require 'db-connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user's bookings
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT b.*, p.name as package_name, p.image_url 
    FROM package_bookings b 
    JOIN packages p ON b.package_id = p.package_id 
    WHERE b.id = ? 
    ORDER BY b.created_at DESC
");
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll();
?>

<style>
    .bookings-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .booking-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        transition: transform 0.3s;
    }

    .booking-card:hover {
        transform: translateY(-5px);
    }

    .booking-image {
        height: 200px;
        overflow: hidden;
    }

    .booking-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .booking-content {
        padding: 20px;
    }

    .booking-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #333;
    }

    .booking-details {
        margin-bottom: 15px;
        color: #666;
    }

    .status-pending {
        color: #ffc107;
    }

    .status-confirmed {
        color: #28a745;
    }

    .status-cancelled {
        color: #dc3545;
    }

    .no-bookings {
        text-align: center;
        padding: 50px;
        color: #666;
    }
</style>

<div class="bookings-section">
    <div class="container">
        <h2 class="text-center mb-4">My Bookings</h2>

        <?php if (empty($bookings)): ?>
            <div class="no-bookings">
                <h3>No bookings found</h3>
                <p>You haven't made any bookings yet.</p>
                <a href="packages.php" class="btn btn-primary mt-3">Browse Packages</a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($bookings as $booking): ?>
                    <div class="col-md-6">
                        <div class="booking-card">
                            <div class="booking-image">
                                <img src="<?php echo htmlspecialchars($booking['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($booking['package_name']); ?>">
                            </div>
                            <div class="booking-content">
                                <h3 class="booking-title"><?php echo htmlspecialchars($booking['package_name']); ?></h3>
                                <div class="booking-details">
                                    <p><strong>Booking ID:</strong> #<?php echo $booking['booking_id']; ?></p>
                                    <p><strong>Travel Date:</strong> <?php echo date('d M Y', strtotime($booking['travel_date'])); ?></p>
                                    <p><strong>Number of Travelers:</strong> <?php echo $booking['num_travelers']; ?></p>
                                    <p><strong>Total Price:</strong> ₹<?php echo number_format($booking['total_price'], 2); ?></p>
                                    <p><strong>Status:</strong> 
                                        <span class="status-<?php echo strtolower($booking['status']); ?>">
                                            <?php echo ucfirst($booking['status']); ?>
                                        </span>
                                    </p>
                                </div>
                                <?php if ($booking['status'] == 'pending'): ?>
                                    <a href="cancel_booking.php?id=<?php echo $booking['booking_id']; ?>" 
                                       class="btn btn-danger"
                                       onclick="return confirm('Are you sure you want to cancel this booking?')">
                                        Cancel Booking
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>