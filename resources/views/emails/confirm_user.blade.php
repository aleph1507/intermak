
<head>
	<title>User Confirmation Mail</title>
</head>
<body>
	<div style="margin-left:20%;margin-right:20%;padding-top:5%;padding-bottom:10%; border:2px dashed black;">
		<h1 style="background-color:#000000;color:#FFFFFF;font-family: Roboto, Helvetica, Arial, sans-serif;text-align:right;padding:10px;">

			Thank you for Signing up</h1>
		<br>
		<p style="font-size:1.3em;font-family: Roboto, Helvetica, Arial, sans-serif;margin-left:15px;">
			Please 
			{{--<form action="{{ route('userConfirm', $hash) }}" method="POST">
				{{ csrf_field() }}
				<input type="submit" value="click here to confirm your Registration.">
			</form>--}}
			<a href="{{ route('userConfirm', $hash) }}"> click here to confirm your Registration.<br></a>
			Thank you
		</p>
		<p style="font-family: Roboto, Helvetica, Arial, sans-serif;text-align:right;margin-left:15px;margin-right:15px;">
			<h3>Intermak<br><small><a href="http://www.exploremk.com">exploremk.com</a></small></h3>
		</p>
	</div>
</body>