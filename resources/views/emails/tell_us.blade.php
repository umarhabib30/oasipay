<!DOCTYPE html>
<html>
<head>
    <title>Complaint Received</title>
</head>
<body>
    <h2>Hello,</h2>

    <p>We have received your complaint. Here are the details:</p>

    <h3>Complaint Details:</h3>
    <ul>
        <li><strong>Reason:</strong> {{ $data['reason'] }}</li>
        <li><strong>Email:</strong> {{ $data['email'] }}</li>
        <li><strong>Description:</strong> {{ $data['description'] }}</li>

        @if ($data['image'])
            <li><strong>Attached Image:</strong> <br>
                <img src="{{ $data['image'] }}" alt="Complaint Image" style="max-width: 300px;">
            </li>
        @endif
    </ul>

    <p>We will review your request and get back to you shortly.</p>

    <p>Best Regards, <br> Your Company Team</p>
</body>
</html>
