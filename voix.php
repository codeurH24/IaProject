<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
Montez le son et rechargez la page <button onclick="location.reload()">Reload (F5)</button>
<script>
	ssu = new SpeechSynthesisUtterance()
	ssu.lang = "fr-FR"
	ssu.text = "Bonjour, bienvenue sur HTML5 démo."
	speechSynthesis.speak(ssu)
</script>
</body>

</html>