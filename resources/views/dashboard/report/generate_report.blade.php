<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salary</title>

    <link href="{{asset('backend/asset/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('backend/asset/css/font-awesome.min.css')}}" rel="stylesheet">
</head>
<body>
    
    <table>
        <thead>
            <tr>
                @for ($i = 1; $i < date('t'); $i++)
                    <th>{{$i}}</th>
                @endfor
            </tr>
        </thead>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="{{asset('backend/asset/js/bootstrap.min.js')}}"></script>
</body>
</html>