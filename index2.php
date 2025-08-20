<!DOCTYPE html>
<html lang="en">

<head>
    
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshCart - Grocery Delivery in Minutes</title>
    <meta name="description" content="Get fresh groceries and essentials delivered to your doorstep in minutes. Best prices, quality products, and fast delivery.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4CAF50;
            --primary-dark: #388E3C;
            --secondary: #FF5722;
            --accent: #FFC107;
            --dark: #212121;
            --light: #f5f5f5;
            --gray: #757575;
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        
        header {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .top-bar {
            background-color: var(--dark);
            color: var(--white);
            padding: 8px 0;
            font-size: 14px;
        }

        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar a {
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
        }

        .top-bar a:hover {
            color: var(--accent);
        }

        .top-links {
            display: flex;
            gap: 20px;
        }

        .main-header {
            padding: 15px 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            font-family: 'Roboto', sans-serif;
        }

        .logo-text span {
            color: var(--secondary);
        }

        .search-bar {
            flex-grow: 1;
            max-width: 600px;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px;
            border: 1px solid #ddd;
            border-radius: 30px;
            font-size: 16px;
            outline: none;
            transition: var(--transition);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .search-bar input:focus {
            border-color: var(--primary);
            box-shadow: 0 2px 10px rgba(76, 175, 80, 0.2);
        }

        .search-bar button {
            position: absolute;
            right: 5px;
            top: 5px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 7px 20px;
            cursor: pointer;
            transition: var(--transition);
        }

        .search-bar button:hover {
            background-color: var(--primary-dark);
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .action-icon {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--dark);
            font-size: 12px;
            transition: var(--transition);
        }

        .action-icon i {
            font-size: 22px;
            margin-bottom: 3px;
        }

        .action-icon:hover {
            color: var(--primary);
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--secondary);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }

        .user-profile {
            position: relative;
            cursor: pointer;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }

        .dropdown-menu {
            position: absolute;
            top: 50px;
            right: 0;
            background-color: var(--white);
            width: 200px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 15px 0;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 100;
        }

        .user-profile:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            top: 45px;
        }

        .dropdown-menu a {
            display: block;
            padding: 8px 20px;
            color: var(--dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .dropdown-menu a:hover {
            background-color: var(--light);
            color: var(--primary);
        }

        .dropdown-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

    
        nav {
            background-color: var(--primary);
            position: sticky;
            top: 120px;
            z-index: 999;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-menu {
            display: flex;
            list-style: none;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding: 15px 0;
        }

        .category-menu::-webkit-scrollbar {
            display: none;
        }

        .category-menu li {
            flex-shrink: 0;
        }

        .category-menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: 500;
            transition: var(--transition);
            white-space: nowrap;
        }

        .category-menu a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .all-categories {
            display: flex;
            align-items: center;
            background-color: var(--primary-dark);
            padding: 8px 15px;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            transition: var(--transition);
        }

        .all-categories:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .all-categories i {
            margin-right: 8px;
        }


        .hero-slider {
            position: relative;
            height: 500px;
            overflow: hidden;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: var(--shadow);
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            object-fit: cover;
        }

        .slide.active {
            opacity: 1;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: var(--transition);
        }

        .dot.active {
            background-color: var(--white);
            transform: scale(1.2);
        }

        .section-title {
            font-size: 28px;
            font-weight: 600;
            margin: 30px 0 20px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin: 30px 0;
        }

        .product-card {
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: var(--secondary);
            color: white;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            z-index: 1;
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--dark);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .current-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
        }

        .original-price {
            font-size: 14px;
            color: var(--gray);
            text-decoration: line-through;
        }

        .discount {
            font-size: 12px;
            background-color: var(--accent);
            color: var(--dark);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
        }

        .rating {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .stars {
            color: var(--accent);
            font-size: 14px;
            margin-right: 5px;
        }

        .review-count {
            font-size: 12px;
            color: var(--gray);
        }

        .add-to-cart {
            width: 100%;
            padding: 10px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .add-to-cart:hover {
            background-color: var(--primary-dark);
        }

        .add-to-cart i {
            font-size: 16px;
        }

        .categories-section {
            margin: 50px 0;
        }

        .categories-slider {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .categories-slider::-webkit-scrollbar {
            display: none;
        }

        .category-card {
            min-width: 180px;
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .category-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .category-info {
            padding: 15px;
        }

        .category-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .shop-now {
            display: inline-block;
            padding: 6px 15px;
            background-color: var(--primary);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }

        .shop-now:hover {
            background-color: var(--primary-dark);
        }

        
        .brands-section {
            background-color: var(--white);
            padding: 40px 0;
            margin: 40px 0;
            box-shadow: var(--shadow);
        }

        .brands-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .brands-slider {
            position: relative;
            overflow: hidden;
            padding: 20px 0;
        }

        .brands-track {
            display: flex;
            gap: 30px;
            animation: scroll 30s linear infinite;
            width: max-content;
        }

        .brand-card {
            flex: 0 0 auto;
            width: 150px;
            height: 80px;
            background-color: var(--white);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .brand-card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .brand-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: var(--transition);
        }

        .brand-card:hover img {
            filter: grayscale(0%);
            opacity: 1;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        
        footer {
            background-color: var(--dark);
            color: var(--white);
            padding: 60px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-column h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #bbb;
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a:hover {
            color: var(--white);
            padding-left: 5px;
        }

        .footer-links a i {
            font-size: 14px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #bbb;
        }

        .contact-item i {
            color: var(--primary);
            width: 20px;
            text-align: center;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: var(--white);
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #bbb;
            font-size: 14px;
        }

        .footer-bottom a {
            color: var(--primary);
            text-decoration: none;
        }

        .progress-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background-color: transparent;
            z-index: 1000;
        }

        .progress-bar {
            height: 100%;
            width: 0;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            transition: width 0.1s ease;
        }

        @media (max-width: 992px) {
            .header-content {
                flex-wrap: wrap;
            }
            
            .search-bar {
                order: 3;
                width: 100%;
                max-width: 100%;
            }
            
            .hero-slider {
                height: 350px;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .top-links {
                gap: 10px;
                font-size: 12px;
            }
            
            .logo-text {
                font-size: 20px;
            }
            
            .user-actions {
                gap: 15px;
            }
            
            .action-icon span {
                display: none;
            }
            
            .hero-slider {
                height: 250px;
            }
            
            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
            
            .nav-container {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .all-categories {
                margin-bottom: 10px;
            }
            
            .category-menu {
                width: 100%;
                padding: 10px 0;
            }
        }

        @media (max-width: 576px) {
            .top-bar .container {
                flex-direction: column;
                gap: 5px;
            }
            
            .logo {
                margin-bottom: 10px;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }
            
            .products-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .product-image {
                height: 150px;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade {
            animation: fadeIn 0.8s ease forwards;
        }

        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
    </style>
    <script>
        let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
        updateCartCount();

        document.querySelectorAll('.add-to-cart').forEach((btn, index) => {
            btn.addEventListener('click', () => {
                const productCard = btn.closest('.product-card');
                const name = productCard.querySelector('.product-name').innerText;
                const price = productCard.querySelector('.current-price').innerText;
                const image = productCard.querySelector('.product-image').src;

                cart.push({ name, price, image });
                sessionStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
        });
});

function updateCartCount() {
    const countSpan = document.querySelector('.cart-count');
    countSpan.textContent = cart.length;
}
</script>
</head>

<body>
    <div class="top-bar">
        <div class="container">
            <p>Free delivery on orders over ₹500</p>
            <div class="top-links">
                <a href="tel:+91-9594401905"><i class="fas fa-phone"></i> +91-9594401905</a>
                <a href="mailto:tabish094@gmail.com"><i class="fas fa-envelope"></i> tabish094@gmail.com</a>
                <a href="tel:+91-9220059256"><i class="fas fa-phone"></i> +91-9220059256</a>
                <a href="mailto:kalitkardikshita@gmail.com"><i class="fas fa-envelope"></i> kalitkardikshita@gmail.com</a>

                
            </div>
        </div>
    </div>

    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="https://via.placeholder.com/50x50" alt="">
                    <div class="logo-text">Fresh<span>Cart</span></div>
                </div>
                
                <div class="search-bar">
                    <input type="text" placeholder="Search for products...">
                    <button><i class="fas fa-search"></i> Search</button>
                </div>
                
                <div class="user-actions">
                    <a href="login.php" class="action-icon">
                        <i class="fas fa-user"></i>
                        <span>Account</span>
                    </a>
                    <a href="wishlist.php" class="action-icon">
                        <i class="far fa-heart"></i>
                        <span>Wishlist</span>
                    </a>
                    <a href="cart.php" class="action-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Cart</span>
                        <span class = "cart-count" id="cart-count"><?= array_sum($_SESSION['cart'] ?? []) ?></span>
                        <!-- <span class="cart-count">0</span> -->
                    </a>
                    <div class="user-profile">
                        
                        <img src="https://as2.ftcdn.net/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg" alt="User" class="profile-img">
                        <div class="dropdown-menu">
                            <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                            <a href="orders.php"><i class="fas fa-box"></i> Orders</a>
                            <a href="wishlist.php"><i class="far fa-heart"></i> Wishlist</a>
                            <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <nav>
        <div class="container nav-container">
            <div class="all-categories">
                <i class="fas fa-bars"></i>
                <span>All Categories</span>
            </div>
            <ul class="category-menu">
                <li><a href="#">Fresh Produce</a></li>
                <li><a href="#">Bakery & Breads</a></li>
                <li><a href="#">Dairy & Eggs</a></li>
                <li><a href="#">Grains & Staples</a></li>
                <li><a href="#">Spices</a></li>
                <li><a href="#">Snacks</a></li>
                <li><a href="#">Oils & Sauces</a></li>
                <li><a href="#">Sweets & Chocolates</a></li>
                <li><a href="#">Beverages</a></li>
                <li><a href="#">Household Essentials</a></li>
                <li><a href="#">Personal Care</a></li>
            </ul>
        </div>
    </nav>

    <
    <div class="container">
        <div class="hero-slider">
            <img src="https://img.freepik.com/premium-vector/special-offer-vector-design-template-sale-banner-tag-special-offer-discount-label-limited-time-special-offer-banner-marketing-promotion-retail-store-shop-online-store-website_1213989-992.jpg" alt="Special Offer" class="slide active">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJL1a10vykwtUWo1nOhbGpJ05u8myEK_shIg&s" alt="Fresh Vegetables" class="slide">
            <img src="https://thedietplate.com/cdn/shop/articles/What_is_Dairy.png?crop=center&height=1200&v=1704224579&width=1200" alt="Dairy Products" class="slide">
            <div class="slider-dots">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="section-title animate-fade">Best Sellers</h2>
        <div class="products-grid">

            <div class="product-card animate-fade delay-1">
                <div class="badge">BEST SELLER</div>
                <img src="https://cdn.grofers.com/da/cms-assets/cms/product/04494814-b45d-4e86-a8d8-ccc530e801bf.jpg" alt="Amul Pure Ghee" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Amul Pure Ghee (1L)</h3>
                    <div class="product-price">
                        <span class="current-price">₹585.00</span>
                        <span class="original-price">₹650.00</span>
                        <span class="discount">10% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="review-count">(124)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            
            <div class="product-card animate-fade delay-2">
                <div class="badge">BEST SELLER</div>
                <img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcStKufZClQy7NevBol28PBijyez2jJameB__UwwKaPhWsE6o71SNf8dYXAkOGg1H672e3g2UeQHYxMZOpw0XQZApwW0rnw_c5hzHdYUITt_" alt="Manual Press Chopper" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Manual Press Chopper (500ml)</h3>
                    <div class="product-price">
                        <span class="current-price">₹249.00</span>
                        <span class="original-price">₹299.00</span>
                        <span class="discount">17% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(89)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            
            <div class="product-card animate-fade delay-1">
                <div class="badge">BEST SELLER</div>
                <img src="https://m.media-amazon.com/images/I/9104JpXbv6L._UF1000,1000_QL80_.jpg" alt="Aashirwad Aata" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Aashirwad Aata (5kg)</h3>
                    <div class="product-price">
                        <span class="current-price">₹320.00</span>
                        <span class="original-price">₹350.00</span>
                        <span class="discount">9% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(210)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            
            <div class="product-card animate-fade delay-2">
                <div class="badge">BEST SELLER</div>
                <img src="https://m.media-amazon.com/images/I/61j29HzAsJL.jpg" alt="Dawat Basmati Rice" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Dawat Basmati Rice (5kg)</h3>
                    <div class="product-price">
                        <span class="current-price">₹585.00</span>
                        <span class="original-price">₹650.00</span>
                        <span class="discount">10% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="review-count">(156)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container categories-section">
        <h2 class="section-title animate-fade">Shop by Category</h2>
        <div class="categories-slider">

            <div class="category-card animate-fade delay-1">
                <img src="https://5.imimg.com/data5/SELLER/Default/2021/6/YD/QW/PR/16624432/pulses-and-grains.jpg" alt="Grains and Pulses" class="category-image">
                <div class="category-info">
                    <h3 class="category-name">Grains & Pulses</h3>
                    <a href="#" class="shop-now">Shop Now</a>
                </div>
            </div>
            
            <div class="category-card animate-fade delay-2">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsN8B4snq3pa-L-Qkh5_WMvnfICQ5f97mLAA&s" alt="The Legend Meow" class="category-image">
                <div class="category-info">
                    <h3 class="category-name">The Legend Meow</h3>
                    <a href="#" class="shop-now">Shop Now</a>
                </div>
            </div>
            
            <div class="category-card animate-fade delay-1">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdsiCXyc-ha7mFQXNrxU125pX9YQ7wpOaH8w&s" alt="Fast Food" class="category-image">
                <div class="category-info">
                    <h3 class="category-name">Fast Food</h3>
                    <a href="#" class="shop-now">Shop Now</a>
                </div>
            </div>
            
            <div class="category-card animate-fade delay-2">
                <img src="https://assets.clevelandclinic.org/transform/496eae84-691f-4e90-80fe-aa0827825d97/essentialOils-899747886-770x533-1_jpg" alt="Oils" class="category-image">
                <div class="category-info">
                    <h3 class="category-name">Oils</h3>
                    <a href="#" class="shop-now">Shop Now</a>
                </div>
            </div>
            
            <div class="category-card animate-fade delay-1">
                <img src="https://content.jdmagicbox.com/v2/comp/mumbai/d5/022pxx22.xx22.160827083432.v9d5/catalogue/nandu-sweets-azad-nagar-andheri-west-mumbai-ladoo-retailers-34m9hhnzcc.jpg" alt="Sweets" class="category-image">
                <div class="category-info">
                    <h3 class="category-name">Sweets</h3>
                    <a href="#" class="shop-now">Shop Now</a>
                </div>
            </div>
            
            <div class="category-card animate-fade delay-2">
                <img src="https://static.toiimg.com/photo/75122042.cms" alt="Juices" class="category-image">
                <div class="category-info">
                    <h3 class="category-name">Juices</h3>
                    <a href="#" class="shop-now">Shop Now</a>
                </div>
            </div>
            
            
            <div class="category-card animate-fade delay-1">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwBnI3OVilJi-oU3ojPHQFdxedWPLpcHgaEw&s" alt="Home Cleaning" class="category-image">
                <div class="category-info">
                    <h3 class="category-name">Home Cleaning</h3>
                    <a href="#" class="shop-now">Shop Now</a>
                </div>
            </div>
            
            
            <div class="category-card animate-fade delay-2">
                <img src="https://media.greenmatters.com/brand-img/GHu5ps00f/0x0/why-are-orange-cats-so-crazy-2-1706305464917.jpg" alt="The Legend Meow" class="category-image">
                <div class="category-info">
                    <h3 class="category-name">The Legend Meow</h3>
                    <a href="#" class="shop-now">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="section-title animate-fade">Fresh Picks</h2>
        <div class="products-grid">
            <div class="product-card animate-fade delay-1">
                <div class="badge">NEW</div>
                <img src="https://static.wixstatic.com/media/f0fada_a8366c842bdb4083af690849741a5bbe~mv2.jpg/v1/fill/w_980,h_980,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/f0fada_a8366c842bdb4083af690849741a5bbe~mv2.jpg" alt="Milky Mist Probiotic Curd" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Milky Mist Probiotic Curd (200g)</h3>
                    <div class="product-price">
                        <span class="current-price">₹35.00</span>
                        <span class="original-price">₹40.00</span>
                        <span class="discount">13% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(42)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            
            <div class="product-card animate-fade delay-2">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2LjQH7X35hGhLPJzTLUl5QkJ2clpEE3z8tQ&s" alt="Kasata Ice Cream" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Cassata Slice Ice Cream (90ml)</h3>
                    <div class="product-price">
                        <span class="current-price">₹45.00</span>
                        <span class="original-price">₹50.00</span>
                        <span class="discount">10% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(78)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            
            <div class="product-card animate-fade delay-1">
                <img src="https://m.media-amazon.com/images/I/71+NM33gHWL.jpg" alt="Society Tea" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Society Premium Tea (1kg)</h3>
                    <div class="product-price">
                        <span class="current-price">₹270.00</span>
                        <span class="original-price">₹300.00</span>
                        <span class="discount">10% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(134)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            
            
            <div class="product-card animate-fade delay-2">
                <div class="badge">PREMIUM</div>
                <img src="https://m.media-amazon.com/images/I/81cjIIXS1+L._UF1000,1000_QL80_.jpg" alt="Japanese Matcha Tea" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Japanese Matcha Tea (100g)</h3>
                    <div class="product-price">
                        <span class="current-price">₹890.00</span>
                        <span class="original-price">₹999.00</span>
                        <span class="discount">11% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(56)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            <div class="product-card animate-fade delay-1">
                <div class="badge">EXTREMELY PREMIUM</div>
                <img src="https://media.greenmatters.com/brand-img/GHu5ps00f/0x0/why-are-orange-cats-so-crazy-2-1706305464917.jpg" alt="Santra-stic Billa" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Santra-stic Billa</h3>
                    <div class="product-price">
                        <span class="current-price">₹270000.00</span>
                        <span class="original-price">₹300.00</span>
                        <span class="discount">-90% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(100034)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            <div class="product-card animate-fade delay-1">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlPRbODtR8adNjYzv2Qb7WvhHz51e0elKKHQ&s" alt="Kaalu-endra Meow" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Kaalu-endra Meow</h3>
                    <div class="product-price">
                        <span class="current-price">₹270.00</span>
                        <span class="original-price">₹3.00</span>
                        <span class="discount">Orange is Orange</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(134)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            <div class="product-card animate-fade delay-1">
                <div class="badge">Cat is King</div>
                <img src="https://hips.hearstapps.com/clv.h-cdn.co/assets/16/18/gettyimages-586890581.jpg?crop=0.668xw:1.00xh;0.219xw,0&resize=980:*" alt="Dogesh Bhai" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Dogesh Bhai</h3>
                    <div class="product-price">
                        <span class="current-price">₹2000.00</span>
                        <span class="original-price">₹300.00</span>
                        <span class="discount">450% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(100034)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
            <div class="product-card animate-fade delay-1">
                <div class="badge">PREMIUM|Vodafone Sponsored</div>
                <img src="https://i.ytimg.com/vi/ggcAa7N7CtM/sddefault.jpg" alt="Vodafone wala Kutta" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Vodafone wala Kutta</h3>
                    <div class="product-price">
                        <span class="current-price">₹27000.00</span>
                        <span class="original-price">₹300.00</span>
                        <span class="discount">-60% OFF</span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="review-count">(100034)</span>
                    </div>
                    <button id="payNowBtn" class = "add-to-cart" onclick="alert('Payment Gateway Coming Soon!')">
                        <i class="fas fa-credit-card"></i> Order Now
                    </button>
                    <button class="add-to-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="brands-section">
        <div class="container">
            <div class="brands-title">
                <h2 class="section-title">Our Trusted Brands</h2>
            </div>
            <div class="brands-slider">
                <div class="brands-track">
                    <div class="brand-card">
                        <img src="https://content.jdmagicbox.com/comp/def_content_category/arun-ice-creams-11983640-ij6f0fksd8.jpg" alt="Brand 1">
                    </div>
                    <div class="brand-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbh0UwUUY2-jMJPRX04oL-OX4aMjhs1ozA5Q&s" alt="Brand 2">
                    </div>
                    <div class="brand-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZhSrLbn-fDv5FYdx8IjIuDiUltfCGUvsSLA&s" alt="Brand 3">
                    </div>
                    <div class="brand-card">
                        <img src="https://media.istockphoto.com/id/467621123/photo/fighting-kittens.jpg?s=612x612&w=0&k=20&c=WSJzPjPoGvqJ5V4ITuRjXs8x877BYBDSb8Mu9-dDBfs=" alt="Brand 4">
                    </div>
                    <div class="brand-card">
                        <img src="https://play-lh.googleusercontent.com/jWrQV30SDb5Y-0Wgj9yIjjAzOSYEMF31yX3OGRMfWxMjpKnH6C_84i3JcLGR4rwdv00" alt="Brand 5">
                    </div>
                    <div class="brand-card">
                        <img src="https://www.1mg.com/articles/wp-content/uploads/2024/09/4399087_2331356.jpg" alt="Brand 6">
                    </div>
                    <div class="brand-card">
                        <img src="https://rukminim2.flixcart.com/image/704/844/xif0q/curd-yogurt/s/e/5/1-probiotic-tub-milky-mist-no-original-imagk38ygyswqxqh.jpeg?q=90&crop=false" alt="Brand 7">
                    </div>
                    <div class="brand-card">
                        <img src="https://m.media-amazon.com/images/I/61QCY2VfdTL._UF1000,1000_QL80_.jpg" alt="Brand 8">
                    </div>
                    <div class="brand-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyLk5gLgAqxo17n3ff8RuBLEh-UneZW2mxAw&s" alt="Brand 9">
                    </div>
                    <div class="brand-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdXTy8rh7DvLB_W8JsccgKy3HDMwLLHOk_Yg&s" alt="Brand 10">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>FreshCart</h3>
                    <p>Your one-stop shop for all needs. We deliver quality products at your doorstep with lightning speed.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Shop</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> About Us</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Contact</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> FAQ</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Categories</h3>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Fresh Produce</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Dairy & Eggs</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Beverages</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Snacks</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Household</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123, Mumbai, India</span>
                        </div>
                        

                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+919594401905</span>
                            <i class="fas fa-envelope"></i>
                            <span>tabish094@gmail.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+919220059256</span>
                            <i class="fas fa-envelope"></i>
                            <span>kalitkardikshita@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 FreshCart. All meows reserved. </p><br>
                <p>A website by M. Tabish Siddiqui & Dikshita Kalitkar</p>
            </div>
        </div>
    </footer>

    
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        
        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }
        
        function nextSlide() {
            showSlide(currentSlide + 1);
        }
        
        setInterval(nextSlide, 5000);
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });
        
    
        window.addEventListener('scroll', () => {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercent = (scrollTop / scrollHeight) * 100;
            document.getElementById('progressBar').style.width = scrollPercent + '%';
        });
        
        
        const animateElements = document.querySelectorAll('.animate-fade');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        animateElements.forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(element);
        });

        document.querySelector('.all-categories').addEventListener('click', function() {
            document.querySelector('.category-menu').classList.toggle('active');
        });
    </script>
    <script>
    document.getElementById('payNowBtn').onclick = function(e){
        var options = {
            "key": "", //key id aayegi razorpay se
            "amount": "50000", 
            "currency": "INR",
            "name": "FreshCart",
            "description": "Grocery Purchase",
            "handler": function (response){
                alert("Payment successful! ID: " + response.razorpay_payment_id);
                
            },
            "prefill": {
                "name": "M.",
                "email": "user@example.com"
            },
            "theme": {
                "color": "#4CAF50"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
    }
</script>
<script>
document.querySelector('.fa-shopping-cart').addEventListener('click', () => {
    const cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];
    let html = '<h3>Your Cart</h3><ul>';

    cartItems.forEach(item => {
    html += `<li class="cart-item">
        <img src="${item.image}" style="width:50px;height:50px;">
        ${item.name} - ${item.price}
        <button class="remove-from-cart" data-id="${item.name}">Remove</button>
    </li>`;
});


    html += '</ul>';
    alert(html); // Replace with modal or custom popup for better UX
});
</script>
<script>
document.querySelectorAll('.add-to-cart').forEach(button => {
  button.addEventListener('click', function () {
    const productId = this.dataset.id;

    fetch('add_to_cart.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `product_id=${productId}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.getElementById('cart-count').textContent = data.cart_count;
        // Optionally update cart section dynamically
      }
    });
  });
});
</script>

<script>
document.querySelectorAll('.remove-from-cart').forEach(button => {
  button.addEventListener('click', function () {
    const productId = this.dataset.id;

    fetch('remove_from_cart.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `product_id=${productId}`
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        document.getElementById('cart-count').textContent = data.cart_count;
        // Optionally remove the item from the DOM
        this.closest('.cart-item').remove(); // If your cart items have class "cart-item"
      }
    });
  });
});
</script>
</body>

</html>