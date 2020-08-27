	<html>

	    <head>
	        <title>W3.CSS</title>
	        <meta name="viewport" content="width=device-width, initial-scale=1">
	        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	    </head>

	    <body>

	        <div class="w3-container w3-teal">
	            <h1>{{ $user->name }}</h1>

	            <a href="{{ route('verification', $user->email_verification_token ) }}">Varification</a>

	        </div>

	    </body>

	</html>