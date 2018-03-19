var tabTempDemain = [
			"temps",
			"fait-il",
			"demain"
		]; 
		if( tempsHeure(tabTempDemain, window.userCurrentText,0) != false ){
			
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
					var condition = meteo.fcst_day_1.condition
					
					
					console.log("Demain il fera un temps "+condition); 
					areaAssistant.value = "Demain il fera un temps "+condition;
				},
				error: function (error) {
					areaAssistant.value = "il y a une erreur";
				}
			});
			
			
			
		}