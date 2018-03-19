var tempsHeure = function(tab, chaine2, indice){
	var chaine=chaine2;
	var loop=0;
	var rVal="None";
	var faux=0;
	
	tab.forEach(function(element) {
		
		var reg1=new RegExp(element, "g");
		var matches1=chaine.match(reg1);
		
		if( matches1 == null){
			faux=1;
			return false;
		}
		
		if( indice == loop){
			rVal = matches1;
		}
		loop = loop+1;
	});
	
	if( faux == 1 ){
		return false;
	}
	return rVal;
}