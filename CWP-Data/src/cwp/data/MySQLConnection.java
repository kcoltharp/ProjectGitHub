package cwp.data;

import java.sql.*;

public class MySQLConnection{

	Connection conn1 = null;

	public MySQLConnection(){

		try{
			String url1 = "jdbc:mysql://localhost:3306/cwp";
			String user = "root";
			String password = "kc2269";

			conn1 = DriverManager.getConnection(url1, user, password);
			if(conn1 != null){
				System.out.println("Connected to database cwp");
			}
		}catch(SQLException ex){
			System.out.println("An error has occurred. ERROR MESSAGE: " + ex.getMessage() + "\n");
		}
	}

	@SuppressWarnings("InfiniteRecursion")
	public Statement createStatement(){
		Statement stmt;
		stmt = this.createStatement();
		return stmt;
	}

}
