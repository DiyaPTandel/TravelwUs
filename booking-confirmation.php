<?php 
include 'header.php';
require 'db-connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$booking_id = $_GET['booking_id'] ?? '';
$type = $_GET['type'] ?? '';

try {
    $stmt = $pdo->prepare("
        SELECT pb.*, p.name, p.duration, p.image_url, p.description, u.name as user_name, u.email
        FROM package_bookings pb
        JOIN packages p ON pb.package_id = p.package_id
        JOIN users u ON pb.id = u.id
        WHERE pb.booking_id = ?
    ");
    $stmt->execute([$booking_id]);
    $booking = $stmt->fetch();

    if (!$booking) {
        echo "Booking not found";
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<div class="confirmation-container">
    <div class="confirmation-box">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1>Booking Confirmed!</h1>
        <p class="confirmation-message">Thank you for booking with us. Your travel package has been successfully reserved.</p>
        
        <div class="booking-details">
            <h2>Booking Information</h2>
            <div class="detail-row">
                <span>Booking ID:</span>
                <strong>#<?php echo str_pad($booking['booking_id'], 6, '0', STR_PAD_LEFT); ?></strong>
            </div>
            <div class="detail-row">
                <span>Package:</span>
                <strong><?php echo htmlspecialchars($booking['name']); ?></strong>
            </div>
            <div class="detail-row">
                <span>Duration:</span>
                <strong><?php echo htmlspecialchars($booking['duration']); ?></strong>
            </div>
            <div class="detail-row">
                <span>Travel Date:</span>
                <strong><?php echo date('d M, Y', strtotime($booking['travel_date'])); ?></strong>
            </div>
            <div class="detail-row">
                <span>Number of Travelers:</span>
                <strong><?php echo $booking['num_travelers']; ?></strong>
            </div>
            <div class="detail-row total">
                <span>Total Amount:</span>
                <strong>₹<?php echo number_format($booking['total_price']); ?></strong>
            </div>
        </div>

        <div class="traveler-info">
            <h2>Traveler Information</h2>
            <div class="detail-row">
                <span>Name:</span>
                <strong><?php echo htmlspecialchars($booking['user_name']); ?></strong>
            </div>
            <div class="detail-row">
                <span>Email:</span>
                <strong><?php echo htmlspecialchars($booking['email']); ?></strong>
            </div>
        </div>

        <div class="next-steps">
            <h2>What's Next?</h2>
            <ul>
                <li>Our team will contact you within 24 hours</li>
                <li>Please keep this booking ID for future reference</li>
            </ul>
        </div>

        <div class="action-buttons">
            <a href="my_bookings.php" class="btn-primary">View My Bookings</a>
            <a href="packages.php" class="btn-secondary">Browse More Packages</a>
        </div>
    </div>
</div>

<style>
.confirmation-container {
    max-width: 800px;
    margin: 50px auto;
    padding: 0 20px;
}

.confirmation-box {
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    text-align: center;
}

.success-icon {
    color: #28a745;
    font-size: 60px;
    margin-bottom: 20px;
}

h1 {
    color: #333;
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.confirmation-message {
    color: #666;
    font-size: 1.2rem;
    margin-bottom: 40px;
}

.booking-details, .traveler-info, .next-steps {
    text-align: left;
    margin: 30px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

h2 {
    color: #444;
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-row span {
    color: #666;
}

.detail-row.total {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 2px solid #ddd;
    font-size: 1.2rem;
    font-weight: bold;
}

.next-steps ul {
    list-style: none;
    padding: 0;
}

.next-steps li {
    padding: 10px 0;
    color: #666;
    position: relative;
    padding-left: 25px;
}

.next-steps li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #28a745;
}

.action-buttons {
    margin-top: 40px;
    display: flex;
    gap: 20px;
    justify-content: center;
}

.btn-primary, .btn-secondary {
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-primary {
    background: #ff4444;
    color: white;
}

.btn-primary:hover {
    background: #ff2020;
}

.btn-secondary {
    background: #f8f9fa;
    color: #333;
    border: 1px solid #ddd;
}

.btn-secondary:hover {
    background: #e9ecef;
}
</style>

<?php include 'footer.php'; ?>