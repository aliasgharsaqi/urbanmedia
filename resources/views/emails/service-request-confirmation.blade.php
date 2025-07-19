<!DOCTYPE html>
<html>
<head>
    <title>Service Request Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Hello, {{ $requestDetails->name }}!</h2>
    <p>Thank you for reaching out. We have successfully received your service request and will get back to you shortly. Here are the details you provided:</p>

    <ul>
        <li><strong>Name:</strong> {{ $requestDetails->name }}</li>
        <li><strong>Email:</strong> {{ $requestDetails->email }}</li>
        @if($requestDetails->club)
            <li><strong>Club/Organization:</strong> {{ $requestDetails->club }}</li>
        @endif
        @if($requestDetails->location)
            <li><strong>Location:</strong> {{ $requestDetails->location }}</li>
        @endif
    </ul>

    <h3>Services You're Interested In:</h3>
    <ul>
        @foreach($requestDetails->services as $service)
            <li>{{ $service }}</li>
        @endforeach
    </ul>

    <p>If any of this information is incorrect, please contact us immediately.</p>
    <p>Best regards,<br>The Team</p>
</body>
</html>