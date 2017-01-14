package carman_jason_ch6employee;
/*
 * Class for the employee that allows for the creation
 * of the memory space for the instances of this class
 * objects, as well as method to set and get all the fields
 * within this class
 */
public class myEmployee {
	/*
	 * Declare variables local to the class we have
	 * created, these are private to the class and
	 * can only be accessed within this class, unless
	 * they are returned to the main class
	 */
	private String empName;
	private String empID;
	private String empPhone;
	private double empRate;
	private double empHours;
	
	/*
	 * Constructor for the employee, sets all values
	 * for fields in the employee to default values.  
	 * Usually known as the empty constructor
	 */
	public myEmployee() {
		
		empName = "";
		empID = "";
		empPhone = "";
		empRate = 7.50;
		empHours = 0;
		
	}
	
	public myEmployee(String conName, String conID, 
		String conPhone, double conRate, double conHours) {
		
		empName = conName;
		empID = conID;
		empPhone = conPhone;
		empRate = conRate;
		empHours = conHours;
		
	}
	
	public myEmployee(String conName, String conID)  {
		
		empName = conName;
		empID = conID;
		empPhone = "";
		empRate = 7.50;
		empHours = 0;
	}
	//setName Mutator (setter) that will take argument
	//for the name and place it into the local class
	//variable
	public void setName(String nameToSet) {
		//sets empName equal to variable passed as argument
		empName = nameToSet;
		
	}
	//setID Mutator (setter) that will take argument
	//for the name and place it into the local class
	//variable	
	public void setID(String IDToSet) {
		//sets empID equal to variable passed as argument
		empID = IDToSet;
		
	}
	//setPhone Mutator (setter) that will take argument
	//for the name and place it into the local class
	//variable
	public void setPhone(String phoneToSet) {
		//sets empPhone equal to variable passed as argument
		empPhone = phoneToSet;
		
	}
	
	//setRate Mutator (setter) that will take argument
	//for the name and place it into the local class
	//variable
	public void setRate(double rateToSet) {
		//sets empRate equal to variable passed as argument
		empRate = rateToSet;
		
	}
	
	//setHours Mutator (setter) that will take argument
	//for the name and place it into the local class
	//variable
	public void setHours(double hoursToSet) {
		//sets empHours equal to variable passed as argument
		empHours = hoursToSet;
		
	}	
	
	//getName Accessor (getter) to gather employee
	//name from the local class variable to be returned
	//to the main program class
	public String getName() {
		//returns the employee name
		return empName;
		
	}
	//getID Accessor (getter) to gather employee
	//ID from the local class variable to be returned
	//to the main program class
	public String getID() {
		//returns the employee ID
		return empID;
		
	}
	//getPhone Accessor (getter) to gather employee
	//Phone from the local class variable to be returned
	//to the main program class	
	public String getPhone() {
		//returns the employee Phone
		return empPhone;
		
	}
	//getTotalPay Accessor (getter) to take the rate
	//and hours from the local class variables and
	//multiply them together to be returned
	//to the main program class
	public double getTotalPay() {
		//Multiplies and returns the hours times rate
		//for total pay
		return empRate * empHours;
		
	}
}
