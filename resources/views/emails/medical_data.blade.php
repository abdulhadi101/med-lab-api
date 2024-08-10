<!DOCTYPE html>
<html>
<head>
    <title>Medical Data</title>
</head>
<body>
<h1>Medical Data for {{ $username }}</h1>
<p>The following medical data has been submitted:</p>
<ul>
    @foreach ($data as $key => $value)
        <li>{{ $key }}: {{ $value }}</li>
    @endforeach
</ul>
<br>
<p>Best Regards,</p>
<p>{{$name}}</p> <!-- Replace with your actual name -->
</body>
</html>
