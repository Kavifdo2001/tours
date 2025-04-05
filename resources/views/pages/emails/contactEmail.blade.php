<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f4f9ff; /* Subtle light blue for body */
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 30px auto;
        padding: 25px;
        border: 1px solid #d4eaff; /* Softer border */
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); /* More defined shadow */
    }

    h2 {
        color: #0056b3; /* Slightly darker blue */
        text-align: center;
        background-color: #e6f3ff;
        padding: 12px;
        border-radius: 6px;
        font-size: 20px;
        font-weight: bold;
    }

    p {
        color: #333333;
        background-color: #f5f7fa; /* Light gray for contrast */
        padding: 10px;
        border-radius: 6px;
        margin: 8px 0;
        border: 1px solid #e0e6ed;
    }

    strong {
        color: #0056b3;
    }
</style>

<body style="font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f9ff; margin: 0; padding: 0;">
<div style="max-width: 600px; margin: 30px auto; padding: 25px; border: 1px solid #d4eaff; border-radius: 10px; background-color: #ffffff;">
    <h2 style="color: #0056b3; text-align: center; background-color: #e6f3ff; padding: 12px; border-radius: 6px; font-size: 20px; font-weight: bold;">
        You have new contact mail
    </h2>

    <p style="color: #333333; background-color: #f5f7fa; padding: 10px; border-radius: 6px; margin: 8px 0; border: 1px solid #e0e6ed;">
        <strong style="color: #0056b3;">Name:</strong> {{ $contactDetails['name'] }}
    </p>
    <p style="color: #333333; background-color: #f5f7fa; padding: 10px; border-radius: 6px; margin: 8px 0; border: 1px solid #e0e6ed;">
        <strong style="color: #0056b3;">Email:</strong> {{ $contactDetails['email'] }}
    </p>
    <p style="color: #333333; background-color: #f5f7fa; padding: 10px; border-radius: 6px; margin: 8px 0; border: 1px solid #e0e6ed;">
        <strong style="color: #0056b3;">Phone Number:</strong> {{ $contactDetails['contact'] }}
    </p>
    <p style="color: #333333; background-color: #f5f7fa; padding: 10px; border-radius: 6px; margin: 8px 0; border: 1px solid #e0e6ed;">
        <strong style="color: #0056b3;">Subject:</strong> {{ $contactDetails['subject'] }}
    </p>
    <p style="color: #333333; background-color: #f5f7fa; padding: 10px; border-radius: 6px; margin: 8px 0; border: 1px solid #e0e6ed;">
        <strong style="color: #0056b3;">Message:</strong> {{ $contactDetails['message'] }}
    </p>
</div>
</body>

