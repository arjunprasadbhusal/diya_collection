<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; background: #f5f5f5; padding: 40px 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); padding: 40px; text-align: center;">
            <h1 style="color: #fff; margin: 0; font-size: 28px;">Order Confirmed!</h1>
            <p style="color: #aaa; margin: 8px 0 0; font-size: 14px;">Thank you for your purchase</p>
        </div>
        <div style="padding: 40px;">
            <p style="color: #333; font-size: 16px; line-height: 1.6;">Hi <strong>{{ $order->first_name }}</strong>,</p>
            <p style="color: #555; font-size: 14px; line-height: 1.6;">Your order has been placed successfully. Here's a summary of your order.</p>

            <div style="background: #f8f8f8; border-radius: 12px; padding: 20px; margin: 20px 0;">
                <table style="width: 100%; font-size: 13px; color: #555;">
                    <tr>
                        <td style="padding: 4px 0; color: #999;">Order ID</td>
                        <td style="padding: 4px 0; text-align: right; font-weight: bold; color: #333;">#{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; color: #999;">Order Date</td>
                        <td style="padding: 4px 0; text-align: right;">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; color: #999;">Status</td>
                        <td style="padding: 4px 0; text-align: right; text-transform: capitalize; color: #F85606; font-weight: bold;">{{ $order->status }}</td>
                    </tr>
                </table>
            </div>

            <h3 style="font-size: 14px; color: #333; margin: 25px 0 12px;">Items Ordered</h3>
            <div style="background: #f8f8f8; border-radius: 12px; padding: 20px; margin: 0 0 20px;">
                @php $items = is_array($order->items) ? $order->items : json_decode($order->items, true); @endphp
                @foreach($items as $item)
                    <div style="display: flex; gap: 12px; padding: 10px 0; {{ !$loop->last ? 'border-bottom: 1px solid #eee;' : '' }}">
                        <div style="width: 50px; height: 50px; background: #eee; border-radius: 8px; flex-shrink: 0; overflow: hidden;">
                            @php
                                $img = $item['image'] ?? null;
                                if ($img && !\Str::startsWith($img, ['http://', 'https://'])) {
                                    $img = \Illuminate\Support\Facades\Storage::disk('public')->exists($img)
                                        ? \Illuminate\Support\Facades\Storage::url($img)
                                        : asset($img);
                                }
                            @endphp
                            @if($img)
                                <img src="{{ $img }}" alt="{{ $item['name'] ?? '' }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <div style="flex: 1;">
                            <p style="margin: 0; font-size: 13px; font-weight: 600; color: #333;">{{ $item['name'] ?? 'Product' }}</p>
                            <p style="margin: 2px 0; font-size: 12px; color: #999;">Size: {{ $item['size'] ?? 'N/A' }} &times; {{ $item['quantity'] ?? 1 }}</p>
                            <p style="margin: 0; font-size: 13px; color: #F85606; font-weight: bold;">Rs. {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="background: #f8f8f8; border-radius: 12px; padding: 20px; margin: 0 0 20px;">
                <table style="width: 100%; font-size: 13px; color: #555;">
                    <tr>
                        <td style="padding: 4px 0;">Subtotal ({{ $order->items_count }} item{{ $order->items_count > 1 ? 's' : '' }})</td>
                        <td style="padding: 4px 0; text-align: right;">Rs. {{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0;">Tax (8%)</td>
                        <td style="padding: 4px 0; text-align: right;">Rs. {{ number_format($order->tax, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; color: #999;">Delivery</td>
                        <td style="padding: 4px 0; text-align: right; color: #22c55e;">Free</td>
                    </tr>
                    <tr style="border-top: 2px solid #ddd;">
                        <td style="padding: 10px 0 0; font-weight: bold; font-size: 15px; color: #1a1a2e;">Total</td>
                        <td style="padding: 10px 0 0; text-align: right; font-weight: bold; font-size: 15px; color: #1a1a2e;">Rs. {{ number_format($order->total, 2) }}</td>
                    </tr>
                </table>
            </div>

            <h3 style="font-size: 14px; color: #333; margin: 25px 0 12px;">Customer Details</h3>
            <div style="background: #f8f8f8; border-radius: 12px; padding: 20px; margin: 0 0 20px;">
                <table style="width: 100%; font-size: 13px; color: #555;">
                    <tr>
                        <td style="padding: 4px 0; color: #999; width: 100px;">Name</td>
                        <td style="padding: 4px 0;">{{ $order->first_name }} {{ $order->last_name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; color: #999;">Email</td>
                        <td style="padding: 4px 0;">{{ $order->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; color: #999;">Phone</td>
                        <td style="padding: 4px 0;">{{ $order->phone ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <h3 style="font-size: 14px; color: #333; margin: 25px 0 12px;">Shipping Address</h3>
            <div style="background: #f0f7ff; border-radius: 12px; padding: 20px; margin: 0 0 20px;">
                <p style="margin: 0 0 4px; font-size: 13px; color: #333;">{{ $order->first_name }} {{ $order->last_name }}</p>
                <p style="margin: 0 0 4px; font-size: 13px; color: #555;">{{ $order->shipping_address_1 }}</p>
                @if($order->shipping_address_2)
                    <p style="margin: 0 0 4px; font-size: 13px; color: #555;">{{ $order->shipping_address_2 }}</p>
                @endif
                <p style="margin: 0 0 4px; font-size: 13px; color: #555;">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
            </div>

            <div style="background: #f0f7ff; border-radius: 12px; padding: 20px; margin: 0 0 20px;">
                <table style="width: 100%; font-size: 13px; color: #555;">
                    <tr>
                        <td style="padding: 4px 0; color: #999;">Payment Method</td>
                        <td style="padding: 4px 0; text-align: right; text-transform: capitalize;">{{ $order->payment_method }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 4px 0; color: #999;">Payment Status</td>
                        <td style="padding: 4px 0; text-align: right;">
                            <span style="color: #eab308; font-weight: 600;">Pending</span>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('orders.my') }}" style="display: inline-block; background: #F85606; color: white; padding: 14px 36px; border-radius: 12px; text-decoration: none; font-weight: bold; font-size: 14px;">View My Orders</a>
            </div>
        </div>
        <div style="background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #999;">
            <p style="margin: 0 0 6px;">Need help? Contact us at <a href="mailto:diyacollection97@gmail.com" style="color: #F85606; text-decoration: none;">diyacollection97@gmail.com</a></p>
            <p style="margin: 0;">&copy; {{ date('Y') }} Diya Collection. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
