<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Agency Footer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 5;
            padding: 0;
            background-color:rgb(20, 23, 26);
        }
        .footer {
            background: linear-gradient(to bottom,rgb(255,255,255,0.1),rgb(255,255,255,0.1));
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        .footer h2, .footer h3 {
            margin: 10px 0;
        }
        .footer p {
            font-size: 16px;
            margin: 10px 0;
        }
        .features {
            list-style: none;
            padding: 0;
        }
        .features li {
            margin: 10px 0;
        }
        .contact-info {
            margin-top: 20px;
            font-size: 14px;
        }
        .footer {
        border-top: none; 
       }
       .footer h3{
         text-align: center;
       }
       .quick-links,
       .contact-info,
       .about-us {
        border: none;
}
    </style>
</head>
<body>

    <footer class="footer">
        <h2>About Us</h2>
        <p><strong>TravelwUs</strong> is your trusted partner for unforgettable travel experiences across India. We specialize in creating memorable journeys that capture the essence of each destination.</p>
        <h3>Our Mission</h3>
        <p>To make travel hassle-free, exciting, and accessible to everyone through innovation and personalized services.</p>

        <h3>Why Choose Us?</h3>
        <ul class="features">
            <li>✔ Exclusive Tour Packages & Deals</li>
            <li>✔ 24/7 Customer Support</li>
            <li>✔ Easy Online Booking & Secure Payments</li>
        </ul>

        <h3>Contact Us</h3>
        <p class="contact-info">
            📍 Location: TravelwUs, Gujarat, India<br>
            📞 Phone: +91 98700 17584<br>
            📞 Phone: +91 70694 79380 <br>
            📧 Email: info@travelwus.com
        </p>
        <h3> Quick links</h3>
        <ul class="quick-links">
        <ul>
                <a href="packages.php">Tour Packages</a><br>
                <a href="about.php">About Us</a><br>
                <a href="gallery.php">Gallery</a><br>
            </ul>
        </ul>    
    </footer>

</body>
</html>
