var d = new Date();
var theDay = d.getDay();
var time = d.getHours();		
function dayToDay(){			
			switch (theDay){
				case 1:
				document.write("Monday");
				break;
				case 2:
				document.write("Tuesday");
				break;
				case 3:
				document.write("Wednesday");
				break;
				case 4:
				document.write("Thurday");
				break;
				case 5:
				document.write("Friday");
				break;
				case 6:
				document.write("Saturday");
				break;
				default:
				document.write("Sunday");
			}
		}
function timeOfDay(){			
			if (time <10){
			document.write("Good morning<br>");
			}
			else if(time>=10 && time<16){
			document.write("Good day<br>")
			}
			else{
			document.write("Good evening<br>");
			}		
}