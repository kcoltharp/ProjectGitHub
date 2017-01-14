
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.zip.GZIPOutputStream;
import javax.swing.JOptionPane;

public class MyGZip{
	public void doGzip(String filePath){
		
		FileOutputStream fos = null;
		GZIPOutputStream gos = null;
		FileInputStream fis = null;
		String path = JOptionPane.showInputDialog("Enter the location where to save the file, including the filename.\n"
			   + "Example: C\\Users\\Kenny\\myGzip.gzip");
		try {
			fos = new FileOutputStream(path);
			gos = new GZIPOutputStream(fos);
			fis = new FileInputStream(filePath);
			byte[] tmp = new byte[4 * 1024];
			int size = 0;
			while ((size = fis.read(tmp)) != -1) {
				gos.write(tmp, 0, size);
			}
			gos.finish();
			System.out.println("Done with GZip...");
		} catch (IOException e) {
			
		} finally {
			try {
				if (fis != null) {
					fis.close();
				}
				if (gos != null) {
					gos.close();
				}
			} catch (Exception ex) {
			
			}
		}
	}

	public static void main(String a[]) {

		MyGZip mfg = new MyGZip();
		String path = JOptionPane.showInputDialog("Enter the path of the directory or file to compress.\n"
			   + "Example: C\\text.txt");
		mfg.doGzip(path);
	}
}
