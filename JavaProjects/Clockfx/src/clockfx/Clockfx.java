package clockfx;

import javafx.application.Application;
import javafx.geometry.Rectangle2D;
import javafx.scene.Group;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.HBox;
import javafx.scene.paint.Color;
import javafx.stage.Stage;
import javafx.stage.StageStyle;

public class Clockfx extends Application {

	@Override
	public void start(Stage stage) {
		// load the image
		Image image = new Image("Clock.png");
		Image hourHand = new Image("hourHand");
		Image minuteHand = new Image("minuteHand");
		Image secondsHand = new Image("secondsHand");

		// simple displays ImageView the image as is
		ImageView iv1 = new ImageView();
		iv1.setImage(image);
		iv1.setImage(hourHand);
		iv1.setImage(minuteHand);
		iv1.setImage(secondsHand);
		
		
		Group root = new Group();
		Scene scene = new Scene(root);
		scene.setFill(Color.BLACK);
		HBox box = new HBox();
		box.getChildren().add(iv1);	
		root.getChildren().add(box);

		stage.setTitle("Kenny's Steampunk Clock");
		stage.initStyle(StageStyle.TRANSPARENT);
		stage.setWidth(515);
		stage.setHeight(300);
		stage.setScene(scene);
		stage.sizeToScene();
		stage.show();
	}

	public static void main(String[] args) {
		Application.launch(args);
	}
}
