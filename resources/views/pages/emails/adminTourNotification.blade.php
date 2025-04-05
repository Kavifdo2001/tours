<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Tour Booking</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }
        h2 {
            font-size: 22px;
            color: #444;
            margin-top: 25px;
            margin-bottom: 12px;
            font-weight: 500;
        }
        p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e2e2e2;
            margin-bottom: 20px;
        }
        .details strong {
            color: #333;
            font-weight: 600;
        }
        .highlight {
            background-color: #eff7ff;
            border-left: 5px solid #007bff;
            padding-left: 15px;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 12px 25px;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            margin-top: 20px;
        }
        .cta-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>New Tour Booking Details</h1>

    <div class="details">
        <p><strong>Client Name:</strong> {{ $user->name }}</p>
        <p><strong>Client Email:</strong> {{ $user->email }}</p>
        <p><strong>Client Contact:</strong> {{ $user->contact }}</p>
    </div>

    <h2>Tour Package Details</h2>
    <div class="details">
        <p><strong>Tour Name:</strong> {{ $tour->name }}</p>
        <p><strong>Tour Type:</strong> {{ $tour->type }}</p>
    </div>

    <h2>Booking Details</h2>
    <div class="details highlight">
        <p><strong>Number of Persons:</strong> {{ $booking->no_of_persons }}</p>
        <p><strong>Total Amount:</strong> ${{ $booking->total_amount }}</p>
        <p><strong>Status:</strong> {{ $booking->status }}</p>
    </div>

    <div class="footer">
        <p>King Sri Lanka Tours!</p>

    </div>
</div>

</body>
</html>
