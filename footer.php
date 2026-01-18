<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="packages.php">Tour Packages</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="contact.php">Contact Us</a></li>

            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Contact Info</h4>
            <ul class="contact-info">
                <li><i class="fas fa-phone"></i> +91 98700 17584</li>
                <li><i class="fas fa-phone"></i> +91 70694 79380</li>
                <li><i class="fas fa-envelope"></i> info@travelwus.com</li>
                <li><i class="fas fa-map-marker-alt"></i> TravelwUs, Gujarat, India</li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2025 TravelwUs. All rights reserved.</p>
    </div>
</footer>

<style>
.footer {
    background: #333;
    color: #fff;
    padding: 30px 0 0; /* Removed bottom padding */
    margin: 0; /* Removed all margins */
    position: relative;
    width: 100%;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 0 20px;
}

.footer-bottom {
    text-align: center;
    padding: 15px 20px; /* Adjusted padding */
    margin-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.1);
    width: 100%;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}
/* ... rest of the styles remain the same ... */

.footer-bottom {
    text-align: center;
    padding-top: 40px;
    margin-top: 40px;
    border-top: 1px solid rgba(255,255,255,0.1);
    width: 100%;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 20px;
    padding-right: 20px;
}

@media (max-width: 992px) {
    .footer-content {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .footer-content {
        grid-template-columns: 1fr;
    }
}
</style>