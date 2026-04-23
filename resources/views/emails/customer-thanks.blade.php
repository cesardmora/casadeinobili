<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thank you for your enquiry | Case dei Nobili</title>
  <style>
    body { font-family: Georgia, serif; background: #F5F2ED; color: #1A1917; margin: 0; padding: 40px 20px; }
    .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 48px; }
    .header { border-bottom: 1px solid #B8956B; padding-bottom: 24px; margin-bottom: 32px; }
    .label { font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; color: #B8956B; }
    .value { font-size: 16px; margin-top: 4px; margin-bottom: 24px; }
    .message-box { background: #F5F2ED; padding: 24px; margin-top: 8px; }
    .footer { margin-top: 48px; font-size: 12px; color: #9B9690; }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1 style="font-weight: 300; font-size: 28px; margin: 0;">Thank you for your enquiry</h1>
      <p class="value">Dear <strong>{{ $inquiry->name }}</strong>,</p>
      <p class="value">We have received your request regarding our properties at <strong>Case dei Nobili</strong>.</p>
    </div>
    
    {{-- <p class="label">Email</p>
    <p class="value">{{ $inquiry->email }}</a></p> --}}

    {{-- <p class="label">Your Message:</p>
    <p class="value">{{ $inquiry->message }}</p> --}}

    @if($inquiry->property)
      <p class="label">Property of interest</p>
      <p class="value">{{ $inquiry->property->name }}</p>
    @endif

    @if($inquiry->arrival_date)
      <p class="label">Dates</p>
      <p class="value">
        {{ $inquiry->arrival_date->format('d/m/Y') }}
        @if($inquiry->departure_date) → {{ $inquiry->departure_date->format('d/m/Y') }} @endif
        @if($inquiry->guests) · {{ $inquiry->guests }} guests @endif
      </p>
    @endif

    <p class="label">Your message</p>
    <div class="message-box">
      <p style="white-space: pre-line; margin: 0; line-height: 1.7;">{{ $inquiry->message }}</p>
      <p>Our team will review your details and contact you within the next 48 hours.</p>
    </div>

    <div class="footer">
      {{-- <p>IP: {{ $inquiry->ip_address }} · {{ $inquiry->created_at->format('d/m/Y H:i') }}</p> --}}
      <p>Case dei Nobili · Korčula · Croatia · 
        <a href="https://casedeinobili.com" style="color: #b8956b; text-decoration: none;">casedeinobili.com</a>
      </p>
    </div>
  </div>
</body>
</html>


