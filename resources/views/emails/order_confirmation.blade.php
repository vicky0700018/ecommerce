Thank you for your purchase!

Order ID: #{{ $order->id }}
Status: {{ $order->status }}

Items:
{!! $items !!}

Total Paid: Rs. {{ number_format($order->total_amount, 0) }}
