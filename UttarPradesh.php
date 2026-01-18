<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uttar Pradesh Tourism</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .destination {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(76, 106, 205, 0.1);
        }

        .destination img {
            flex: 0 0 50%;
            max-width: 50%;
            height: 400px;
            object-fit: cover;
            border-radius: 4px;
        }

        .content-wrapper {
            flex: 1;
            padding: 10px;
        }

        h1 {
            color: #006400;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        h2 {
            color: #2e8b57;
            margin-bottom: 15px;
            font-size: 1.8rem;
        }

        p {
            line-height: 1.6;
            color: #34495e;
            font-size: 1.1rem;
        }

        .back-button {
            text-align: center;
            margin-top: 30px;
        }

        .back-button a {
            background-color: #006400;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .back-button a:hover {
            background-color: #006400;
        }

        @media (max-width: 768px) {
            .destination {
                flex-direction: column;
            }
            
            .destination img {
                flex: 0 0 100%;
                max-width: 100%;
                height: 300px;
            }

            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php
    $destinations = [
        [
            'name' => 'Agra - City of the Taj Mahal',
            'image' => 'taj.jpg',
            'description' => 'Agra, home to the iconic Taj Mahal, is a testament to Mughal architecture and romance. This UNESCO World Heritage site, built by Emperor Shah Jahan in memory of his beloved wife, attracts millions of visitors annually. The city also houses the magnificent Agra Fort and Fatehpur Sikri, showcasing the grandeur of Mughal architecture.'
        ],
        [
            'name' => 'Varanasi - The Spiritual Capital',
            'image' => 'c.jpg',
            'description' => 'One of the world\'s oldest continuously inhabited cities, Varanasi is the spiritual heart of India. The sacred Ganges River, with its famous ghats, hosts the spectacular Ganga Aarti every evening. The city is a center of learning, spirituality, and classical music, with the renowned Banaras Hindu University and countless ancient temples.'
        ],
        [
            'name' => 'Lucknow - City of Nawabs',
            'image' => 'luck.jpg',
            'description' => 'Lucknow, the capital of Uttar Pradesh, is famous for its elegant Nawabi culture, exquisite cuisine, and stunning architecture. The Bara Imambara, Rumi Darwaza, and British Residency showcase the city\'s rich historical heritage. The city is also renowned for its traditional embroidery work, known as Chikankari.'
        ],
        [
            'name' => 'Ayodhya - Ancient Holy City',
            'image' => 'ram.jpg',
            'description' => 'Ayodhya, believed to be the birthplace of Lord Ram, is one of the seven sacred cities for Hindus. The city, situated on the banks of the Sarayu River, is home to numerous temples and ghats. Its rich cultural heritage, religious significance, and historical monuments make it a major pilgrimage destination.'
        ]
    ];
    ?>

    <h1>Discover the Cultural Heritage of Uttar Pradesh</h1>

    <?php foreach($destinations as $destination): ?>
        <div class="destination">
            <img src="<?php echo $destination['image']; ?>" alt="<?php echo $destination['name']; ?>">
            <div class="content-wrapper">
                <h2><?php echo $destination['name']; ?></h2>
                <p><?php echo $destination['description']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="back-button">
        <a href="services.php">Back to Services</a>
    </div>
</body>
</html>