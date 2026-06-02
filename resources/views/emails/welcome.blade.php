<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to ShopHub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
        }
        .content {
            background-color: white;
            padding: 30px 20px;
        }
        .welcome-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .welcome-box h2 {
            margin: 0 0 10px 0;
            font-size: 24px;
        }
        .features {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .feature-item {
            display: flex;
            align-items: center;
            margin: 15px 0;
            padding: 10px;
            background: white;
            border-radius: 3px;
        }
        .feature-icon {
            font-size: 24px;
            margin-right: 15px;
            min-width: 30px;
        }
        .feature-text {
            flex: 1;
        }
        .feature-text strong {
            display: block;
            color: #667eea;
            margin-bottom: 5px;
        }
        .cta-button {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        .cta-button:hover {
            background-color: #764ba2;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-radius: 0 0 5px 5px;
        }
        .social-links {
            margin-top: 15px;
            text-align: center;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ ShopHub</h1>
            <p style="margin: 10px 0 0 0; font-size: 16px;">Welcome Aboard!</p>
        </div>

        <div class="content">
            <div class="welcome-box">
                <h2>Hello {{ $user->name }}! 👋</h2>
                <p>We're excited to have you join our ShopHub family!</p>
            </div>

            <p>Thank you for creating an account with us. Your registration was successful and your account is now active.</p>

            <div class="features">
                <h3 style="color: #667eea; margin-top: 0;">What You Can Do Now:</h3>
                
                <div class="feature-item">
                    <div class="feature-icon">🛒</div>
                    <div class="feature-text">
                        <strong>Shop Amazing Products</strong>
                        <span>Browse our wide collection of quality products at great prices.</span>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">💳</div>
                    <div class="feature-text">
                        <strong>Secure Checkout</strong>
                        <span>Enjoy safe and secure payments with multiple payment options.</span>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">📦</div>
                    <div class="feature-text">
                        <strong>Track Orders</strong>
                        <span>Keep track of all your orders from your personal dashboard.</span>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">📄</div>
                    <div class="feature-text">
                        <strong>Download Invoices</strong>
                        <span>Get automatic invoice emails for every purchase you make.</span>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">💬</div>
                    <div class="feature-text">
                        <strong>Customer Support</strong>
                        <span>24/7 customer support ready to help you anytime.</span>
                    </div>
                </div>
            </div>

            <h3 style="color: #667eea;">Your Account Details:</h3>
            <div style="background-color: #f5f5f5; padding: 15px; border-radius: 5px; border-left: 4px solid #667eea;">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Registration Date:</strong> {{ $user->created_at->format('d M Y') }}</p>
            </div>

            <p style="margin-top: 20px; padding: 15px; background-color: #fff3cd; border-radius: 5px; border-left: 4px solid #ffc107;">
                <strong>⚠️ Important:</strong> Never share your password with anyone. ShopHub staff will never ask for your password.
            </p>

            <center>
                <a href="http://127.0.0.1:8000" class="cta-button">Start Shopping Now →</a>
            </center>

            <div class="social-links">
                <p style="margin: 0 0 10px 0; color: #666; font-size: 14px;">Connect with us:</p>
                <a href="#">Facebook</a> | 
                <a href="#">Instagram</a> | 
                <a href="#">Twitter</a>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 0;">ShopHub © {{ date('Y') }} | All Rights Reserved</p>
            <p style="margin: 10px 0 0 0; color: #999;">
                This is an automated welcome email. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
