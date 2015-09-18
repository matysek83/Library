 dzisiaj = new Date();

 rok 	 = dzisiaj.getFullYear();
 miesiac = dzisiaj.getMonth();
 dz  	 = dzisiaj.getDate();
 dzient  = dzisiaj.getDay();
 godz	 = dzisiaj.getHours();
 min 	 = dzisiaj.getMinutes();
 s		 = dzisiaj.getSeconds();
 ms	     = dzisiaj.getMilliseconds();
 
 if (s < 10)
 s = "0"+s;
 if (min < 10)
 min = "0"+min;
 
 var miesiace = ["Stycznia", "Luty", "Marca", "Kwietnia", "Maja", "Czerwca", "Lipca", "Sierpnia", "Września", "Pazdziernika", "Listopada", "Grudnia"];
 var dni = ["Niedzielę", "Poniedziałek", "Wtorek", "Środę", "Czwartek", "Piątek", "Sobotę"];
 
 
 document.writeln("<font color='white'>Dzisiaj mamy: <br/> "+dni[dzient]+" "+dz+" "+miesiace[miesiac]+" "+rok+" rok<br/>Godzina: "+godz+":"+min+":"+s+"</font>");
				