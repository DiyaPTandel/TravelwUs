<?php include 'header.php'; ?>
<div class="container mt-5">
    <h1>Photo Gallery</h1>
    <div class="row">
        <!--image 1 -->
        <div class="col-md-3 mb-4">
            <div class="image-container">
                <img src="b.jpg" class="img-fluid" alt="Jaisalmer" style="height: 200px; object-fit: cover;">
                <div class="overlay">
                    <div class="overlay-content">
                        <h3>Jaisalmer</h3>
                        <p>The Golden City of Rajasthan</p>
                    </div>
                </div>
            </div>
            
        </div>
        <!--image 2 -->
        <div class="col-md-3 mb-4">
            <div class="image-container">
                <img src="c.jpg" class="img-fluid" alt="Kashi" style="height: 200px; object-fit: cover;">
                <div class="overlay">
                    <div class="overlay-content">
                        <h3>Kashi</h3>
                        <p>The Spiritual Capital of India</p>
                    </div>
                </div>
            </div>
          
        </div>
        <!--image 3 -->
        <div class="col-md-3 mb-4">
            <div class="image-container">
                <img src="d.jpg" class="img-fluid" alt="Kerala" style="height: 200px; object-fit: cover;">
                <div class="overlay">
                    <div class="overlay-content">
                        <h3>Kerala</h3>
                        <p>God's Own Country</p>
                    </div>
                </div>
            </div>
            
        </div>
        <!--image 4 -->
        <div class="col-md-3 mb-4">
            <div class="image-container">
                <img src="e.jpg" class="img-fluid" alt="Jaipur" style="height: 200px; object-fit: cover;">
                <div class="overlay">
                    <div class="overlay-content">
                        <h3>Jaipur</h3>
                        <p>The Pink City</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>            
</div>        
<?php include 'footer.php';?>

<style>
    .image-container {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .image-container:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .image-container img {
        width: 100%;
        height: 100%;
        transition: transform 0.3s ease;
        object-fit: cover;
        border-radius: 10px;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .image-container:hover .overlay {
        opacity: 1;
    }

    .overlay-content {
        color: white;
        text-align: center;
        padding: 20px;
    }

    .overlay-content h3 {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .overlay-content p {
        font-size: 0.9rem;
        margin: 0;
    }

    .text-center {
        margin-top: 10px;
        font-weight: bold;
        color: #333;
    }

    .image-container {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .col-md-3:nth-child(1) .image-container { animation-delay: 0.1s; }
    .col-md-3:nth-child(2) .image-container { animation-delay: 0.3s; }
    .col-md-3:nth-child(3) .image-container { animation-delay: 0.5s; }
    .col-md-3:nth-child(4) .image-container { animation-delay: 0.7s; }
</style>