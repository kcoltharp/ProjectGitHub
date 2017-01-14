package org.netbeans.modules.cloud.openshift;
import javax.swing.JComponent;
import org.netbeans.modules.cloud.openshift.ui.OpenShiftVisualPanel1;
import org.netbeans.spi.server.ServerInstanceImplementation;
import org.openide.nodes.Node;
/**
 * Representation of single OpenShift cloud account under "Cloud" node.
 */
public class OpenShiftServerInstanceImplementation implements ServerInstanceImplementation {
    private OpenShiftInstance ai;
    public OpenShiftServerInstanceImplementation(OpenShiftInstance ai) {
        this.ai = ai;
    }
    @Override
    public String getDisplayName() {
        return ai.getName();
    }
    @Override
    public String getServerDisplayName() {
        return "OpenShift";
    }
    @Override
    public Node getFullNode() {
        return getBasicNode();
    }
    @Override
    public Node getBasicNode() {
        return new OpenShiftInstanceNode(ai);
    }
    @Override
    public JComponent getCustomizer() {
        return new OpenShiftVisualPanel1();
    }
    @Override
    public void remove() {
        OpenShiftInstanceManager.getDefault().remove(ai);
    }
    @Override
    public boolean isRemovable() {
        return true;
    }
}
