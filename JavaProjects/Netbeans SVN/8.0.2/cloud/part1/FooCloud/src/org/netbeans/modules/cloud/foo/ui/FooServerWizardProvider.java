package org.netbeans.modules.cloud.foo.ui;
import org.netbeans.spi.server.ServerWizardProvider;
import org.openide.WizardDescriptor.InstantiatingIterator;
import org.openide.util.NbBundle;
public class FooServerWizardProvider implements ServerWizardProvider {
    @NbBundle.Messages("CTL_DISPLAYNAME=Foo")
    @Override
    public String getDisplayName() {
        return Bundle.CTL_DISPLAYNAME();
    }
    @Override
    public InstantiatingIterator getInstantiatingIterator() {
        return new FooWizardIterator();
    }
}
