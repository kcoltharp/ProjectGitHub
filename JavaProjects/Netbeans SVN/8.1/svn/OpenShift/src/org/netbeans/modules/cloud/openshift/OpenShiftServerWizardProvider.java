package org.netbeans.modules.cloud.openshift;
import org.netbeans.modules.cloud.openshift.ui.OpenShiftWizardIterator;
import org.netbeans.spi.server.ServerWizardProvider;
public class OpenShiftServerWizardProvider implements ServerWizardProvider {
    @Override
    public String getDisplayName() {
        return "Red Hat OpenShift";
    }
    @Override
    public org.openide.WizardDescriptor.InstantiatingIterator getInstantiatingIterator() {
        return new OpenShiftWizardIterator();
    }
}
