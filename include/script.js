 today = new Date();

 year 	 = today.getFullYear();
 miesiac = today.getMonth();
 dz  	 = today.getDate();
 dzient  = today.getDay();
 godz	 = today.getHours();
 min 	 = today.getMinutes();
 s		 = today.getSeconds();
 ms	     = today.getMilliseconds();
 
 if (s < 10)
 s = "0"+s;
 if (min < 10)
 min = "0"+min;
 
 var miesiace = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
 var dni = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
 
 
 document.writeln("<font color='white'>Today: <br/> "+dni[dzient]+" "+dz+" "+miesiace[miesiac]+" "+year+" <br/>Hour: "+godz+":"+min+":"+s+"</font>");
				