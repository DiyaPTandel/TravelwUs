CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE packages (
    package_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    duration_days INT NOT NULL,
    duration_nights INT NOT NULL,
    image_url VARCHAR(255),
    features TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Sample data for packages
INSERT INTO packages (name, description, price, duration_days, duration_nights, image_url, features) VALUES 
('Kerala Adventure', 'Experience the beauty of Gods Own Country', 24999.00, 5, 4, 'kerala.jpg', 'Luxury Accommodation, Houseboat Stay, All Meals Included, Guided Tours'),
('Royal Rajasthan', 'Explore the royal heritage of Rajasthan', 29999.00, 6, 5, 'rajasthan.jpg', 'Palace Stay, Desert Safari, Cultural Shows, Local Guide'),
('Goa Beach Holiday', 'Enjoy the sun, sand and sea in Goa', 19999.00, 4, 3, 'goa.jpg', 'Beach Resort, Water Sports, Party Passes, Sightseeing');

CREATE TABLE package_bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    id INT NOT NULL,
    package_id INT NOT NULL,,
    travel_date DATE NOT NULL,
    num_travelers INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (package_id) REFERENCES packages(package_id)
);