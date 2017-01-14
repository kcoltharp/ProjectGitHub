package firstcup.dukesage.resource;

import java.util.Calendar;
import java.util.GregorianCalendar;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;

/**
 * REST Web Service
 *
 */
@Path("dukesAge")
public class DukesAgeResource {

	/**
	 * Creates a new instance of DukesAgeResource
	 */
	public DukesAgeResource() {
	}

	/**
	 * Retrieves representation of an instance of DukesAgeResource
	 *
	 * @return an instance of java.lang.String
	 */
	@GET
	@Produces("text/plain")
	public String getText() {
		//Create a new Calendar for my birthday
		Calendar myBirthday = new GregorianCalendar(1969, Calendar.APRIL, 22);
		//Create a new calendar for today
		Calendar now = GregorianCalendar.getInstance();
		
		//Subtract today's year from Duke's birth year
		int myAge = now.get(Calendar.YEAR) - myBirthday.get(Calendar.YEAR);
		myBirthday.add(Calendar.YEAR, myAge);
		
		//If today's date is before Duke's birthday, subtract a year from age
		if(now.before(myBirthday)){
			myAge--;
		}
		//return a String representation of their age
		return "" + myAge;
	}
}
