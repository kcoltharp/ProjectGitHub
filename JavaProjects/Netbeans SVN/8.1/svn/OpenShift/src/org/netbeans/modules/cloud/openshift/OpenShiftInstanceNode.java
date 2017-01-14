package org.netbeans.modules.cloud.openshift;
import org.openide.nodes.AbstractNode;
import org.openide.nodes.Children;
class OpenShiftInstanceNode extends AbstractNode {
    public OpenShiftInstanceNode(OpenShiftInstance ai) {
        super(Children.LEAF);
        setDisplayName("Red Hat OpenShift");
        setShortDescription("Red Hat OpenShift");
        setIconBaseWithExtension("org/netbeans/modules/cloud/openshift/resources/logo.jpg");
    }
}
