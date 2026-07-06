<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; background: #f5f5f5; padding: 40px 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <div style="background: linear-gradient(135deg, #1a1a2e, #16213e); padding: 40px; text-align: center;">
            <h1 style="color: #fff; margin: 0; font-size: 28px;">New Contact Message</h1>
        </div>
        <div style="padding: 40px;">
            <p style="color: #555; font-size: 14px; line-height: 1.6;">You have received a new message from the contact form.</p>
            <div style="background: #f8f8f8; border-radius: 12px; padding: 20px; margin: 20px 0;">
                <p style="margin: 0 0 8px; font-size: 13px; color: #555;"><strong>Name:</strong> {{ $data['name'] }}</p>
                <p style="margin: 0 0 8px; font-size: 13px; color: #555;"><strong>Email:</strong> {{ $data['email'] }}</p>
                <p style="margin: 0 0 8px; font-size: 13px; color: #555;"><strong>Subject:</strong> {{ $data['subject'] }}</p>
                <p style="margin: 15px 0 0; font-size: 13px; color: #555; line-height: 1.6;"><strong>Message:</strong></p>
                <p style="margin: 5px 0 0; font-size: 13px; color: #333; line-height: 1.6;">{{ $data['message'] }}</p>
            </div>
        </div>
        <div style="background: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #999;">
            &copy; {{ date('Y') }} Diya Collection. All rights reserved.
        </div>
    </div>
</body>
</html>
