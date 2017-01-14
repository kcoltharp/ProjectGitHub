function date_time(id)
{
	months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
	days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	
	date = new Date;
	year = date.getFullYear();
	month = date.getMonth();
	
	d = date.getDate();
	day = date.getDay();
	h = date.getHours();

	if(h<10){
		h = "0"+h;
	}
	m = date.getMinutes();
	if(m<10){
		m = "0"+m;
	}
	s = date.getSeconds();
	if(s<10){
		s = "0"+s;
	}

	result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
	document.getElementById(id).innerHTML = result;
	setTimeout('date_time("'+id+'");','1000');

	return true;
}