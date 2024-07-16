Hallo {{ $user->getFullName() }},<br>
<br>
vielen Dank für Ihre Registrierung bei INKLUSIVA Call.<br><br>
Ihr Benutzerkonto wurde erfolgreich aktiviert. Ihr Passwort können Sie unter dem Link <a href="{{$link}}">Passwort setzen</a> festlegen.<br/>
Sobald Sie Ihr Passwort gesetzt haben, können Sie sich mit Ihrer E-Mail Adresse und Ihrem Passwort <a href="{{route('login')}}">einloggen</a>.<br>
<br>
Viele Grüße,<br>
Ihr INKLUSIVA Call-Team

