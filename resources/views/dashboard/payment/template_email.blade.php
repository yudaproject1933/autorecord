<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    <span>Hi there, your recent order on history report has been completed.</span>
    <p>Your report has been sent to your email, please check your spam folder just in case the email got delivered there instead of your inbox.</p>
    <p>You can access the report through the link below :</p>
    {{ $details['link'] }}<br>
    <p>Ans we also attach your report here, if you are having trouble opening the link.</p>
    <br>
    <span>If you have any question, you can reply this message to get in touch with us.</span>
</body>
</html>