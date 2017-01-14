package cwp.data;

import java.sql.*;
import java.text.*;

/**
 *
 * @author Kenny
 */
public class CWPData{

	/**
	 * @param args the command line arguments
	 */
	public static void main(String[] args){
		try{
			String myDriver = "org.gjt.mm.mysql.Driver";
			String myUrl = "jdbc:mysql://localhost/cwp";
			Class.forName(myDriver);
			Connection conn1 = DriverManager.getConnection(myUrl, "root", "kc2269");
			if(conn1 != null){
				System.out.println("Connected to database cwp");
			}
			Date date1 = convertTime("8:05");

			// our SQL SELECT query.
			// if you only need a few columns, specify them by name instead of using "*"
			String selectQuery = "SELECT * FROM students";
			String insertQuery = "UPDATE students"
				+ "SET"
				+ "`lesson1_start_time`=(?),"
				+ "`lesson2_start_time`='8:25',"
				+ "`legal_aspect_test_start`='9:50,"
				+ "`lesson3_start_time`=10:16,"
				+ "`firearm_safety_test_start_time`='11:10',"
				+ "`firearm_qual_start_time`='13:30',"
				+ "`class_number='20160528'` "
				+ "WHERE 1';";

			Statement stmt = conn1.createStatement();
			// create the java statement
			Statement st = conn1.createStatement();

			// execute the query, and get a java resultset
			//ResultSet rs = st.executeQuery(selectQuery);
			int result = st.executeUpdate(insertQuery);
			System.out.println(result + " records were updated");

			/*
			 * // iterate through the java resultset while(rs.next()){
			 * BigDecimal studentNum = rs.getBigDecimal("student_num");
			 * String firstName = rs.getString("fname"); String lastName =
			 * rs.getString("lname");
			 *
			 * // print the results System.out.format("%s, %s, %s\n",
			 * studentNum, firstName, lastName); }
			 */
		}catch(ClassNotFoundException | SQLException e){
			System.out.println("This error was given: " + e.getMessage());
		}

	}

	public static Date convertTime(String d){
		String time = d;
		Date date = null;
		try{
			date = (Date)new SimpleDateFormat("HH:mm").parse(time);
		}catch(ParseException ex){
			System.out.println("ERROR: " + ex.getMessage());
		}
		return date;
	}
}
