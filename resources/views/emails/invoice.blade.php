<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #667eea;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: white;
            padding: 20px;
        }
        .invoice-details {
            margin-bottom: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .detail-box {
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 3px;
        }
        .detail-box strong {
            display: block;
            color: #667eea;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th {
            background-color: #667eea;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #667eea;
        }
        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-radius: 0 0 5px 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ ShopHub</h1>
            <h2>Invoice</h2>
        </div>

        <div class="content">
            <!-- Invoice Info -->
            <div class="invoice-details">
                <div class="detail-box">
                    <strong>Invoice Number:</strong>
                    {{ $invoice->invoice_number }}
                </div>
                <div class="detail-box">
                    <strong>Order ID:</strong>
                    #{{ $order->id }}
                </div>
                <div class="detail-box">
                    <strong>Invoice Date:</strong>
                    {{ $invoice->issued_at->format('d M Y') }}
                </div>
                <div class="detail-box">
                    <strong>Order Status:</strong>
                    <span style="background-color: #28a745; color: white; padding: 3px 8px; border-radius: 3px;">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <!-- Customer Info -->
            <div style="margin: 20px 0; padding: 15px; background-color: #f0f8ff; border-left: 4px solid #667eea;">
                <strong>Bill To:</strong><br>
                {{ $order->user->name }}<br>
                {{ $order->user->email }}<br>
            </div>

            <!-- Items Table -->
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: right;">Unit Price</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">Rs. {{ number_format($item->price, 2) }}</td>
                        <td style="text-align: right;">Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total Section -->
            <div class="total-section">
                <div style="margin-bottom: 10px;">
                    <strong>Subtotal:</strong> Rs. {{ number_format($order->total_amount, 2) }}
                </div>
                <div class="total-amount">
                    Total Amount: Rs. {{ number_format($order->total_amount, 2) }}
                </div>
            </div>

            <!-- Payment Info -->
            <div style="margin: 20px 0; padding: 15px; background-color: #f0fff4; border-left: 4px solid #28a745;">
                <strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}<br>
                <strong>Payment Status:</strong> <span style="color: #28a745; font-weight: bold;">Completed</span>
            </div>

            <!-- Thank You Message -->
            <div style="margin-top: 30px; padding: 15px; text-align: center; background-color: #fff3cd; border-radius: 3px;">
                <p><strong>Thank you for your purchase! 🎉</strong></p>
                <p style="font-size: 14px; margin: 0;">
                    We appreciate your business. If you have any questions about this invoice, 
                    please contact our support team.
                </p>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 0;">
                ShopHub © {{ date('Y') }} | All Rights Reserved<br>
                This is an automated invoice. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
