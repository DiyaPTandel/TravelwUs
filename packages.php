<?php include 'header.php'; ?>

<style>
    .packages-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 15px;
    }

    .section-title p {
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .package-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        transition: transform 0.3s;
    }

    .package-card:hover {
        transform: translateY(-5px);
    }

    .package-image {
        height: 200px;
        overflow: hidden;
    }

    .package-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .package-content {
        padding: 20px;
    }

    .package-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #333;
    }

    .package-price {
        font-size: 1.8rem;
        color: #ff4444;
        margin-bottom: 15px;
    }

    .package-details {
        margin-bottom: 20px;
        color: #666;
    }

    .package-features {
        list-style: none;
        padding: 0;
        margin-bottom: 20px;
    }

    .package-features li {
        padding: 5px 0;
        color: #666;
    }

    .package-features li i {
        color: #28a745;
        margin-right: 10px;
    }

    .btn-book {
        background: rgb(86, 78, 249); 
        color: white;
        padding: 10px 25px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        transition: background 0.3s;
    }

    .btn-book:hover {
        background:rgb(77, 70, 224);
        color: white;
    }
</style>

<div class="packages-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Travel Packages</h2>
            <p>Discover our carefully curated travel packages designed to give you the best experience</p>
        </div>

        <div class="row">
            <!-- Package Card 1 -->
            <div class="col-md-4">
                <div class="package-card">
                    <div class="package-image">
                        <img src="kerala.jpg" alt="Kerala Package">
                    </div>
                    <div class="package-content">
                        <h3 class="package-title">Kerala Adventure</h3>
                        <div class="package-price">₹24,999</div>
                        <div class="package-details">
                            5 Days | 4 Nights
                        </div>
                        <ul class="package-features">
                            <li><i class="fas fa-check"></i> Luxury Accommodation</li>
                            <li><i class="fas fa-check"></i> Houseboat Stay</li>
                            <li><i class="fas fa-check"></i> All Meals Included</li>
                            <li><i class="fas fa-check"></i> Guided Tours</li>
                        </ul>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="book-package.php?id=1" class="btn-book">Book Now</a>
                        <?php else: ?>
                            <a href="login.php" class="btn-book">Login to Book</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Package Card 2 -->
            <div class="col-md-4">
                <div class="package-card">
                    <div class="package-image">
                        <img src="rajasthan.jpg" alt="Rajasthan Package">
                    </div>
                    <div class="package-content">
                        <h3 class="package-title">Royal Rajasthan</h3>
                        <div class="package-price">₹29,999</div>
                        <div class="package-details">
                            6 Days | 5 Nights
                        </div>
                        <ul class="package-features">
                            <li><i class="fas fa-check"></i> Palace Stay</li>
                            <li><i class="fas fa-check"></i> Desert Safari</li>
                            <li><i class="fas fa-check"></i> Cultural Shows</li>
                            <li><i class="fas fa-check"></i> Local Guide</li>
                        </ul>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="book-package.php?id=2" class="btn-book">Book Now</a>
                        <?php else: ?>
                            <a href="login.php" class="btn-book">Login to Book</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Package Card 3 -->
            <div class="col-md-4">
                <div class="package-card">
                    <div class="package-image">
                        <img src="goa.jpg" alt="Goa Package">
                    </div>
                    <div class="package-content">
                        <h3 class="package-title">Goa Beach Holiday</h3>
                        <div class="package-price">₹19,999</div>
                        <div class="package-details">
                            4 Days | 3 Nights
                        </div>
                        <ul class="package-features">
                            <li><i class="fas fa-check"></i> Beach Resort</li>
                            <li><i class="fas fa-check"></i> Water Sports</li>
                            <li><i class="fas fa-check"></i> Party Passes</li>
                            <li><i class="fas fa-check"></i> Sightseeing</li>
                        </ul>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="book-package.php?id=3" class="btn-book">Book Now</a>
                        <?php else: ?>
                            <a href="login.php" class="btn-book">Login to Book</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>