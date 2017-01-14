package org.netbeans.modules.cloud.foo;
import javax.swing.JComponent;
import javax.swing.JPanel;
import org.netbeans.spi.server.ServerInstanceImplementation;
import org.openide.nodes.AbstractNode;
import org.openide.nodes.Children;
import org.openide.nodes.Node;
public class FooCloudInstanceImplementation implements ServerInstanceImplementation {
    private final FooCloudInstance fooInstance;
    public FooCloudInstanceImplementation(FooCloudInstance fooInstance) {
        this.fooInstance = fooInstance;
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
        AbstractNode node = new AbstractNode(Children.LEAF);
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
