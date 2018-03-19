		if( window.userCurrentText == "météo"
		|| window.userCurrentText == "temps fait-il aujourd'hui"
		|| window.userCurrentText == "en fait-il aujourd'hui"
		|| window.userCurrentText == "quel temps fait-il"
		|| window.userCurrentText == "quel temps fait-il aujourd'hui"){
			var meteo;
			$.ajax({

				url: 'https://www.prevision-meteo.ch/services/json/havre',
				type: 'GET',
				crossDomain: true,
				async: false,
				dataType: 'html',
				success: function(html) { 
					meteo = JSON.parse(html);
					console.log("Resultat="+meteo.fcst_day_0.condition); 
					areaAssistant.value = "aujourd'hui il y aura "+meteo.fcst_day_0.condition;
				}
			});
			
			
		}