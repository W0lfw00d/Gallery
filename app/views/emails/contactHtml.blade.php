<html>
<head>
	<title>Contact form</title>
</head>
<body>

<p>Hello,</p>

<p>{{ $input['firstName'] }} {{ $input['lastName'] }} send you the following message:</p>

<p>{{ nl2br($input['comment']) }}</p>

<p>Email: {{ $input['email'] }}</p>
@if(isset($input['phone']))
<p>Phone: {{ $input['phone'] }}</p>
@endif

</body>
</html>