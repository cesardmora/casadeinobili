<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee;">
        <h2 style="color: #b8956b;">Thank you for your enquiry</h2>
        <p>Dear <strong>{{ $inquiry->name }}</strong>,</p>
        <p>We have received your request regarding our properties at <strong>Case dei Nobili</strong>.</p>
        
        <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 0;"><strong>Your Message:</strong></p>
            <p style="font-style: italic; color: #666;">"{{ $inquiry->message }}"</p>
        </div>

        <p>Our team will review your details and contact you within the next 48 hours.</p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">
        <p style="font-size: 12px; color: #999; text-align: center;">
            Case dei Nobili — Korčula, Croatia  

            <a href="https://casedeinobili.com" style="color: #b8956b; text-decoration: none;">casedeinobili.com</a>
        </p>
    </div>
</body>
</html>

