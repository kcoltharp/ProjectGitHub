package org.netbeans.modules.cloud.foo.serverplugin;
import org.netbeans.modules.cloud.foo.*;
import javax.swing.JComponent;
import javax.swing.JPanel;
import org.netbeans.modules.cloud.foo.utils.OpenShiftChildFactory;
import org.netbeans.spi.server.ServerInstanceImplementation;
import org.openide.nodes.AbstractNode;
import org.openide.nodes.Children;
import org.openide.nodes.Node;
public class FooServerInstanceImplementation implements ServerInstanceImplementation {
    private final FooCloudInstance fooInstance;
    private final String userName;
    private final String password;
    public FooServerInstanceImplementation(FooServerInstance fooServerInstance) {
        this.fooInstance = fooServerInstance.getFooInstance();
        this.userName = fooInstance.getUserName();
        this.password = fooInstance.getPassword();
    }
    @Override
    public String getDisplayName() {
        return fooInstance.getDisplayText();
    }
    @Override
    public String getServerDisplayName() {
        return FooCloudInstance.TYPE;
    }
    @Override
    public Node getFullNode() {
        return getBasicNode();
    }
    @Override
    public Node getBasicNode() {
        AbstractNode node = new AbstractNode(Children.create(new OpenShiftChildFactory(userName,password), true));
        node.setDisplayName(fooInstance.getDisplayText());
        node.setIconBaseWithExtension(FooCloudInstance.ICON);
        return node;
    }
    @Override
    public JComponent getCustomizer() {
        return new JPanel();
    }
    @Override
    public void remove() {
    }
    @Override
    public boolean isRemovable() {
        return false;
    }
}
