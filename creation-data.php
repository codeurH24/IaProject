<?php
header('Access-Control-Allow-Origin: *');
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>IAProject</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>

<body>

Parlez distinctement devant votre micro, pour voir la transcription apparaître ci-dessous :
<button onclick="recognition.start()">Start</button>
<button onclick="recognition.stop()">Stop</button><br>
<textarea id="areaUser" rows=10 cols=100></textarea><br>
Taux de confiance de la reconnaissance vocale : <span id="span">...</span><br>
<textarea id="areaAssistant" rows=10 cols=100>Bonjour, je suis le PC assistant</textarea><br>
<script>
	var areaUser = document.getElementById('areaUser');
	var areaAssistant = document.getElementById('areaAssistant');
	ssu = new SpeechSynthesisUtterance()
	ssu.lang = "fr-FR"

	var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition

	recognition = new SpeechRecognition()
	recognition.continuous = true
	recognition.lang = "fr-FR"
	recognition.onresult = function (event) {
		for (i = event.resultIndex; i < event.results.length; i++) {
				areaUser.value += event.results[i][0].transcript + "\n"
				//document.getElementById("span").innerHTML =
					//Math.round(event.results[i][0].confidence * 100) + " %"
		}
	}
	recognition.start()
	
	
var httpGet =  function (theUrl){
	var xmlHttp = null;

	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET", theUrl, true );
	//xmlHttp.send( null );
	return xmlHttp.responseText;
}

	
	
	
var enEcoute=1;	
var prenom = "";
var variableTemporaire;
var speek = function(){
	
	areaAssistant.value = "Désolé, Je ne comprend pas";
	
	if( enEcoute == 1 ){
		if( window.userCurrentText == "qui es-tu" ){
			areaAssistant.value = "Bonjour, je suis le PC assistant de FLorent";
		}
		
		if( window.userCurrentText == "qui suis-je" ){
			
			if( prenom == ""){
				areaAssistant.value = "... ... Je ne le connais pas pour le moment. Comment t'appel tu ?";
				enEcoute = 2;
			}else{
				areaAssistant.value = "Bonjour, tu est Florent";
			}
			
		}
		
			
		if( window.userCurrentText == "on est quel jour"
			|| window.userCurrentText == "quel jour on est"
			|| window.userCurrentText == "Le jour sommes-nous"
			|| window.userCurrentText == "quel jour sommes-nous"){
			var ladate=new Date()
			
			var tab_jour=new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
			areaAssistant.value = "votre machine indique que nous sommes le "+tab_jour[ladate.getDay()]+" "+ladate.getDate();
		}
		
		if( window.userCurrentText == "quelle heure est-il"
			|| window.userCurrentText == "heure est-il"	
			|| window.userCurrentText == "quelle heure il est"	){
			var phrase=" l'heure de votre machine indique qu'il est ";
			var ladate=new Date()
			var h=ladate.getHours();
			if (h<10) {h = "0" + h}
			 phrase+=h+" heure ";
			var m=ladate.getMinutes();
			if (m<10) {m = "0" + m}
			phrase+=m+" minute ";
			areaAssistant.value = phrase;
		}
		
		if( window.userCurrentText == "dis-moi" ||  window.userCurrentText == "aide-moi"){
			enEcoute=1;
			areaAssistant.value = "Oui, que puis-je faire pour toi Florent";
		}
		

		

		<?php include "fonction/meteo/fonction.php"; ?>
		
		<?php include "fonction/meteo/tempsHeureJ0.php"; ?>
		<?php include "fonction/meteo/tempsHaujourdhui.php"; ?>
		<?php include "fonction/meteo/tempsDemain.php"; ?>
		<?php include "fonction/meteo/tempsHeureDemain.php"; ?>
		
		
		var tabRetiens = [
			"retiens",
			"retiens (.*)"
		]; 
		var valeurRetenue;
		if( (valeurRetenue=tempsHeure(tabRetiens, window.userCurrentText,1)) != false ){
			
			valeurRetenue = valeurRetenue.toString().replace("retiens ", '');
			
			enEcoute=3;
			variableTemporaire = valeurRetenue;
			console.log("Qu'est ce que "+valeurRetenue);
			areaAssistant.value = "Qu'est ce que "+valeurRetenue;
		}
		
		var tabQuesceQue = [
			"qu'est-ce que un (.*)"
		]; 
		var valeurRetenue;
		if( (valeurRetenue=tempsHeure(tabQuesceQue, window.userCurrentText,0)) != false ){
			
			valeurRetenue = valeurRetenue.toString().replace("qu'est-ce que un ", '');
			console.log("C'est "+valeurRetenue);
			if (typeof window[valeurRetenue] != "undefined") {
				areaAssistant.value = "C'est "+window[valeurRetenue];
			}else{	
				areaAssistant.value = valeurRetenue+" est inconnu ";
			}
		}
		
		var tabQuesceQue = [
			"est-ce qu'un (.*)"
		]; 
		var valeurRetenue;
		if( (valeurRetenue=tempsHeure(tabQuesceQue, window.userCurrentText,0)) != false ){
			
			valeurRetenue = valeurRetenue.toString().replace("est-ce qu'un ", '');
			console.log("C'est "+window[valeurRetenue]);
			if (typeof window[valeurRetenue] != "undefined") {
				areaAssistant.value = "C'est "+window[valeurRetenue];
			}else{	
				areaAssistant.value = valeurRetenue+" est inconnu ";
			}
		}
		
		
		var tabQuesceQue = [
			"qui est mon (.*)|qui est mon (.*)e|qui est ma (.*)"
		]; 
		var valeurRetenue;
		if( (valeurRetenue=tempsHeure(tabQuesceQue, window.userCurrentText,0)) != false ){
			
			valeurRetenue = valeurRetenue.toString().replace("qui est mon ", '');
			valeurRetenue = valeurRetenue.toString().replace("qui est ma ", '');
			console.log("C'est "+window[valeurRetenue]);
			if (typeof window[valeurRetenue] != "undefined") {
				areaAssistant.value = "C'est "+window[valeurRetenue];
			}else if (typeof window[valeurRetenue+'e'] != "undefined") {
				areaAssistant.value = "C'est "+window[valeurRetenue+'e'];
			}else{	
				areaAssistant.value = valeurRetenue+" est inconnu ";
			}
		}
			

		
		
		
		
		
		
	}
	
	// "pc ecoute moi", il comprend "essaie écoute moi"
	if( window.userCurrentText == "essaie écoute-moi"
	||  window.userCurrentText == "écoute-moi" 
	||  window.userCurrentText == "PC écoute-moi" ){
		enEcoute=1;
		areaAssistant.value = "Oui, que puis-je faire pour toi Florent";
	}
	
	if( window.userCurrentText == "ok c'est bon"
	|| window.userCurrentText == "et toi"
	|| window.userCurrentText == "ta gueule"
	||  window.userCurrentText == "tais-toi" ){
		enEcoute=0;
		areaAssistant.value = "D'accord, je ne t'ecoute plus";
	}
	
	
	if( window.userCurrentText == "help" ){
		areaAssistant.value = "Tu peux me demande:";
		areaAssistant.value += "\n- qui es-tu.";
		areaAssistant.value += "\n- qui suis-je.";
		areaAssistant.value += "\n- ok c'est bon.(pour me taire)";
		areaAssistant.value += "\n- quelle heure est-il.";
	}
	
	
	
	//if( enEcoute > 0 ){
		window.ssu.text = areaAssistant.value;
		window.speechSynthesis.speak(ssu);
	//}
	
	
}	

var apprend = function(indice){
	
	if( indice == 2){
		enEcoute=1;
		
		prenom=window.userCurrentText;
		areaAssistant.value = "D'accord, tu t'appel "+prenom;
		areaAssistant.value += "\nEnchanté "+prenom;

		window.ssu.text = areaAssistant.value;
		window.speechSynthesis.speak(ssu);
	}else if( indice == 3){
		enEcoute=1;
		
		var tabLabel = window.userCurrentText.split(' ');
		var label = tabLabel[tabLabel.length-1];
		window[label] = variableTemporaire;
		console.log("apprend. Valeur retenu: "+label);
		areaAssistant.value = "D'accord, c'est "+window.userCurrentText;

		window.ssu.text = areaAssistant.value;
		window.speechSynthesis.speak(ssu);
	}
	
}

	
var userCurrentText ;	
var userLastText ;	
$(function() {
	
	setInterval(function(){ 
		window.userCurrentText = areaUser.value.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, ''); ;
		//console.log( 'userCurrentText='+userCurrentText+' - userLastText='+userLastText ) ;
		if( window.userLastText != window.userCurrentText && areaUser.value != ""){
			console.log( "-"+window.userCurrentText+"-" ) ;
			
				
			if( enEcoute > 1) {
				apprend(enEcoute);
			}else{
				speek();
			}
			areaUser.value = "";
		}
		window.userLastText = window.userCurrentText;
	},500);
	
});	


	
</script>


</body>

</html>