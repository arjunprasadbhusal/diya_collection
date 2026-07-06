<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; background: #f5f5f5; padding: 40px 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); padding: 40px; text-align: center;">
            <h1 style="color: #fff; margin: 0; font-size: 28px;">Order Status Updated</h1>
        </div>
        <div style="padding: 40px;">
            <p style="color: #333; font-size: 16px; line-height: 1.6;">Hi <strong>{{ $order->first_name }}</strong>,</p>
            <p style="color: #555; font-size: 14px; line-height: 1.6;">Your order <strong>#{{ $order->id }}</strong> status has been updated.</p>
            <div style="text-align: center; margin: 30px 0; padding: 25px; background: #fff4e6; border-radius: 12px;">
                <span style="font-size: 14px; color: #888;">Current Status</span>
                <div style="font-size: 24px; font-weight: bold; color: #F85606; margin-top: 5px; text-transform: capitalize;">{{ $order->status }}</div>
            </div>
            <p style="color: #555; font-size: 14px; line-height: 1.6;">Thank you for shopping with Diya Collection!</p>
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('orders.my') }}" style="display: inline-block; background: #F85606; color: white; padding: 14px 36px; border-radius: 12px; text-decoration: none; font-weight: bold; font-size: 14px;">Track My Order</a>
            </div>
        </div>
        <div style="background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #999;">
            &copy; {{ date('Y') }} Diya Collection. All rights reserved.
        </div>
    </div>
</body>
</html>
