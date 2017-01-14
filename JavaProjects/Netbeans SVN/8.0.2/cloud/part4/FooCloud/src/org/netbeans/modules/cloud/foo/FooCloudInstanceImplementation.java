package org.netbeans.modules.cloud.foo;
import java.awt.event.ActionEvent;
import javax.swing.AbstractAction;
import javax.swing.Action;
import javax.swing.JComponent;
import javax.swing.JPanel;
import org.netbeans.modules.cloud.foo.serverplugin.FooServerInstanceProvider;
import org.netbeans.spi.server.ServerInstanceImplementation;
import org.openide.filesystems.FileUtil;
import org.openide.nodes.AbstractNode;
import org.openide.nodes.Children;
import org.openide.nodes.Node;
import org.openide.util.lookup.Lookups;
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
        AbstractNode node = new AbstractNode(Children.LEAF, Lookups.singleton(fooInstance)) {
            @Override
            public Action[] getActions(boolean context) {
                return new Action[]{
                    new AbstractAction("Refresh") {
                        @Override
                        public void actionPerformed(ActionEvent e) {
                            FooServerInstanceProvider.getProvider().refreshServers();
                        }
                    },
                    null,
                    new AbstractAction("Remove") {
                        @Override
                        public void actionPerformed(ActionEvent e) {
                            fooInstance.getServerInstance().remove();
                        }
                    },
                    null,
                    new AbstractAction("Properties") {
                        @Override
                        public void actionPerformed(ActionEvent e) {
                            Action serverManagerAction = FileUtil.getConfigObject("Actions/Tools/org-netbeans-modules-server-ui-manager-CloudManagerAction.instance", Action.class);
                            serverManagerAction.actionPerformed(e);
                        }
                    }
                };
            }
        };
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
