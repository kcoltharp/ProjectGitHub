
import java.awt.GridLayout;
import java.io.File;
import java.io.FilenameFilter;
import javax.swing.JFrame;
import javax.swing.JList;
import javax.swing.JPanel;
import javax.swing.JScrollPane;


public class TestFrame extends JFrame {
	public void foldersPanel() {

		JPanel folderScreen = new JPanel();
		folderScreen.setLayout(new GridLayout(1, 1));
		direFilter = new FilenameFilter() {
			public boolean accept(File file, String string) {
				if (file.isDirectory()) {
					return file.isDirectory();
				} else {
					return false;
				}
			}
		};
		File directory = new File(System.getProperty("user.dir"));
		File[] listOfFiles = directory.listFiles(direFilter);
		String[] allFiles = directory.list();

		if (directory.isDirectory()) {
			int x = 1;

			for (int i = 0; i < listOfFiles.length; i++) // displays all the files
			{
				if (listOfFiles[i].isDirectory()) {
					folderList = new JList(listOfFiles[i].list(direFilter));
					System.out.println(
						   x + ") Directory = " + listOfFiles[i].getName());
					x++;
					folderList.setSelectedIndex(1);
				} else {
					System.out.println("is file");
				}
				folderScreen.add(new JScrollPane(folderList));

			}

		} else {
			System.out.println(
				   "This is a file, not a directory, so we will move to the parent folder");
			directory = directory.getParentFile();
			updateLabels();
			System.out.println("The new directory is : " + directory.
				   toString());
		}
	}
}
