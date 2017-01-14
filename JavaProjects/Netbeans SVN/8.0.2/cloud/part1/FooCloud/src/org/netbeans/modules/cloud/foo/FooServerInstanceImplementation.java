package org.netbeans.modules.cloud.foo;
import javax.swing.JComponent;
import javax.swing.JPanel;
import org.netbeans.spi.server.ServerInstanceImplementation;
import org.openide.nodes.AbstractNode;
import org.openide.nodes.Children;
import org.openide.nodes.Node;
public class FooServerInstanceImplementation implements ServerInstanceImplementation {
    private final FooInstance fooInstance;
    public FooServerInstanceImplementation(FooInstance fooInstance) {
        this.fooInstance = fooInstance;
    }
    @Override
    public String getDisplayName() {
        return fooInstance.getName();
    }
    @Override
    public String getServerDisplayName() {
        return fooInstance.getName();
    }
    @Override
    public Node getFullNode() {
        return getBasicNode();
    }
    @Override
    public Node getBasicNode() {
        Node node = new AbstractNode(Children.LEAF);
        node.setDisplayName(fooInstance.getName());
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
