
		var heure;
		var tabHeureJ0 = [
			"temps",
			"fait-il",
			"([0-9]{1,2}h)"
		]; 
		if( (heure = tempsHeure(tabHeureJ0, window.userCurrentText,2)) != false ){
			var meteo;
			heure = parseInt(heure);
			
			$.ajax({

				url: 'https://www.prevision-meteo.ch/services/json/havre',
				type: 'GET',
				crossDomain: true,
				async: false,
				dataType: 'html',
				success: function(html) {
					
					meteo = JSON.parse(html);
					var condition = meteo.fcst_day_0.hourly_data[heure+'H00'].CONDITION
					
					console.log("Resultat="+condition); 
					areaAssistant.value = "aujourd'hui il y aura a "+heure+"h "+condition;
				},
				error: function (error) {
					areaAssistant.value = "il y a une erreur";
				}
			});
			
		}