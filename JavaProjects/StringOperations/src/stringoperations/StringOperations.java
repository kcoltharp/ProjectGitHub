package stringoperations;

import java.text.SimpleDateFormat;
import java.util.Date;

/**
 *
 * @author Kenny
 */
public class StringOperations {

	public static void main(String args[]) {
		String str = "jan-feb-march";
		String[] temp;
		String delimeter = "-";
		temp = str.split(delimeter);
		for (int i = 0; i < temp.length; i++) {
			System.out.println(temp[i]);
			System.out.println("");
			str = "jan.feb.march";
			delimeter = "\\.";
			temp = str.split(delimeter);
		}
		for (int i = 0; i < temp.length; i++) {
			System.out.println(temp[i]);
			System.out.println("");
			temp = str.split(delimeter, 2);
			for (int j = 0; j < temp.length; j++) {
				System.out.println(temp[j]);
			}
		}
		
		Date date = new Date();
		String strDateFormat = "HH:mm:ss a";
		SimpleDateFormat sdf = new SimpleDateFormat(strDateFormat);
		System.out.println(sdf.format(date));
	}
}
