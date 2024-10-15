<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <style>
            p {
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <div>
            <p>Your ticket with subject: <strong>{{ $ticketSubject }}</strong> has been created</p>
            <p>You can access it via your profile, or directly at this URL:</p>
            <p>http://localhost:8000/{{ $ticketID }}</p>
            <p>Please do not reply to this email.</p>
        </div>
    </body>
</html>
