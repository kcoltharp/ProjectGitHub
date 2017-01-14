package org.netbeans.modules.cloud.foo.ui;
import org.netbeans.modules.cloud.foo.FooCloudInstance;
import org.netbeans.spi.server.ServerWizardProvider;
import org.openide.WizardDescriptor.InstantiatingIterator;
public class FooCloudWizardProvider implements ServerWizardProvider {
    @Override
    public String getDisplayName() {
        return FooCloudInstance.TYPE;
    }
    @Override
    public InstantiatingIterator getInstantiatingIterator() {
        return new FooCloudWizardIterator();
    }
}
