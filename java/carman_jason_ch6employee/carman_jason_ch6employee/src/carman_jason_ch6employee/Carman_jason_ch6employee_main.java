package carman_jason_ch6employee;
/*
 * Professor Carman
 * Summer 2015
 * Chapter 6.1
 * This program will allow the creation of employee information
 * through the use of classes.  The employees will have information
 * related to name, ID, Phone and rate and hours of pay
 * The program will allow for input and output of all these
 * employee fields.   
 */
import java.util.Scanner;

public class Carman_jason_ch6employee_main {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		//Creation of instance of scanner object named keyboard
		Scanner keyboard = new Scanner(System.in);
		
		//Creation of instances of employee class objects for each employee.
		//Due to overloaded constructors, the first three have the empty
		//constructor, which will put blank values for each item, the fourth
		//use a hybrid, which allows for entry of the first two items, then default
		//for the last three.  The final is the full constructor, which requires
		//arguments for the all 5 field items
		myEmployee someGuy = new myEmployee();
		myEmployee someGuy2 = new myEmployee();
		myEmployee someGuy3 = new myEmployee();
		myEmployee someGuy4 = new myEmployee("Bob Jones", "34");
		myEmployee someGuy5 = new myEmployee("Jason Carman5", "5", "111-111", 15, 40);
		
		//Asks for prompt for the name
		System.out.print("Please enter the first some guys name  ");
		//uses the set name object in the myEmployee class to take the input from the
		//keyboard and place it into the name field for the employee object
		someGuy.setName(keyboard.nextLine());
		//Asks for prompt for the ID
		System.out.print("Please enter the first some guys ID  ");
		//uses the set ID object in the myEmployee class to take the input from the
		//keyboard and place it into the ID field for the employee object
		someGuy.setID(keyboard.nextLine());
		//Asks for prompt for the rate
		System.out.print("Please enter the first some guys rate  ");
		//uses the set rate object in the myEmployee class to take the input from the
		//keyboard and place it into the rate field for the employee object
		someGuy.setRate(keyboard.nextDouble());
		//Asks for prompt for the hours
		System.out.print("Please enter the first some guys hours  ");
		//uses the set hours object in the myEmployee class to take the input from the
		//keyboard and place it into the hours field for the employee object
		someGuy.setHours(keyboard.nextDouble());
		
		//uses the set name object in the myEmployee class to take the values
		//passed as arguments and place them into the name field for the employee object
		someGuy2.setName("Jason Carman2");
		someGuy3.setName("Jason Carman3");

		//uses the set ID object in the myEmployee class to take the values
		//passed as arguments and place them into the ID field for the employee object
		someGuy2.setID("2");
		someGuy3.setID("3");
		
		//uses the set rate object in the myEmployee class to take the values
		//passed as arguments and place them into the rate field for the employee object
		someGuy2.setRate(11);
		someGuy3.setRate(12);
		
		//uses the set hours object in the myEmployee class to take the values
		//passed as arguments and place them into the hours field for the employee object
		someGuy2.setHours(21);
		someGuy3.setHours(22);
		
		/*
		 * Output for all the employee items.  Uses the getters to gather the information
		 * from the class for the name and total pay for each employee
		 */
		System.out.println(someGuy.getName() + "    $" + someGuy.getTotalPay());
		System.out.println(someGuy2.getName() + "    $" + someGuy2.getTotalPay());
		System.out.println(someGuy3.getName() + "    $" + someGuy3.getTotalPay());
		System.out.println(someGuy4.getName() + "    $" + someGuy4.getTotalPay());
		System.out.println(someGuy5.getName() + "    $" + someGuy5.getTotalPay());
		
		
		
	}

}
