<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
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
        .order-info {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .order-info p {
            margin: 10px 0;
        }
        .order-info strong {
            color: #667eea;
        }
        .items-section {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .items-section h3 {
            color: #667eea;
            margin-top: 0;
        }
        .item-line {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
        }
        .item-line:last-child {
            border-bottom: none;
        }
        .total-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }
        .status-badge {
            display: inline-block;
            background-color: #4caf50;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-radius: 0 0 5px 5px;
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
        }
        .cta-button:hover {
            background-color: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Order Confirmed</h1>
            <p style="margin: 10px 0 0 0; font-size: 16px;">Thank you for shopping with ShopSphere!</p>
        </div>

        <div class="content">
            <p>Hi {{ $order->user->name }},</p>
            
            <p>Your order has been successfully placed and paid. We're excited to process your purchase!</p>

            <!-- Order Details -->
            <div class="order-info">
                <p><strong>Order Number:</strong> #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                <p><strong>Status:</strong> <span class="status-badge">{{ ucfirst($order->status) }}</span></p>
                <p><strong>Payment Method:</strong> Stripe (Secure)</p>
            </div>

            <!-- Items Ordered -->
            <div class="items-section">
                <h3>📦 Your Items:</h3>
                {!! $items !!}
            </div>

            <!-- Total Amount -->
            <div class="total-section">
                Total Paid: ₹{{ number_format($order->total_amount, 0) }}
            </div>

            <p style="background-color: #e3f2fd; padding: 15px; border-radius: 5px; border-left: 4px solid #2196F3;">
                <strong>📧 Estimated Delivery:</strong> Your order will be delivered within 2-3 business days. You'll receive a tracking link via email soon.
            </p>

            <p>
                <strong>What's Next?</strong>
            </p>
            <ul style="color: #666; line-height: 1.8;">
                <li>You'll receive a shipping confirmation email shortly</li>
                <li>Track your order in your ShopSphere dashboard</li>
                <li>Download your invoice anytime from your account</li>
                <li>Contact our support team if you have any questions</li>
            </ul>

            <center>
                <a href="http://127.0.0.1:8000/dashboard" class="cta-button">View Your Order →</a>
            </center>

            <p style="margin-top: 30px; padding: 15px; background-color: #fff3cd; border-radius: 5px; border-left: 4px solid #ffc107; font-size: 13px;">
                <strong>💡 Tip:</strong> Keep this email for your records. It contains your order details and invoice information.
            </p>
        </div>

        <div class="footer">
            <p style="margin: 0;">ShopSphere © {{ date('Y') }} | All Rights Reserved</p>
            <p style="margin: 10px 0 0 0; color: #999;">
                This is an automated order confirmation email. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
