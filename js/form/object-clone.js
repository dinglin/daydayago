//������������� 
Object.clone = function(sObj){ 
	if(typeof sObj !== "object"){ 
		return sObj; 
	} 
	var s = {}; 
	if(sObj.constructor == Array){ 
		s = []; 
	} 
	for(var i in sObj){ 
		s[i] = Object.clone(sObj[i]); 
	} 
	return s; 
}