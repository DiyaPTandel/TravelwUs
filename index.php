<?php include 'header.php'; ?>

<style>
    .hero-section {
        height: 100vh;
        background: url('bg.png') no-repeat center center;
        background-size: cover;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0 20px;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
    }

    .hero-content {
        position: relative;
        z-index: 1;
        color: white;
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
        text-align: center;
        adding-top: 150px; /* Added padding to move content down */
    }

    .hero-title {
        font-size: 5rem;
        font-weight: 700;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .tagline {  
        font-size: 1.8rem;
        margin-bottom: 100px;
        color: #fff;
    }

    .explore-btn {
        display: inline-block;
        background: linear-gradient(45deg, #05adc8, #84d2f7);
        color: white;
        padding: 15px 40px;
        border-radius: 30px;
        font-size: 1.2rem;
        text-decoration: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        cursor: pointer;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 50px; /* Added margin top */
    }

    .explore-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        background: linear-gradient(45deg, #84d2f7, #05adc8);
        color: white;
        text-decoration: none;
    }

    .features {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        padding: 60px 20px;
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
    }

    .feature-item {
        padding: 20px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-10px);
    }

    .feature-item h3 {
        margin: 15px 0;
        color: #333;
        font-size: 1.5rem;
    }

    .feature-item p {
        color: #666;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }
        
        .features {
            grid-template-columns: 1fr;
        }

        .tagline {
            font-size: 1.3rem;
        }

        .explore-btn {
            padding: 12px 30px;
            font-size: 1rem;
        }
    }
</style>

<div class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <a href="packages.php" class="explore-btn">Explore India</a>
    </div>
</div>


<?php include 'footer.php'; ?>