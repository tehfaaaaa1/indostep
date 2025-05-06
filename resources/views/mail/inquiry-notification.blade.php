<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>New Inquiry Received</h1>

    <p>You have received a new inquiry from a client.</p>

    <h2>Inquiry Details:</h2>
    <ul>
        <li><strong>Name:</strong> {{ $formData['name'] ?? 'N/A' }}</li>
        <li><strong>Email:</strong> {{ $formData['email'] ?? 'N/A' }}</li>
        <li><strong>Phone:</strong> {{ $formData['phone'] ?? 'N/A' }}</li>
        <li><strong>Desired Trip:</strong> {{ $formData['desired_trip'] ?? 'N/A' }}</li>
        <li><strong>Desired Dates:</strong> {{ $formData['desired_dates'] ?? 'N/A' }}</li>
        <li><strong>Number of Participants:</strong> {{ $formData['num_participants'] ?? 'N/A' }}</li>
    </ul>
</body>

</html>
