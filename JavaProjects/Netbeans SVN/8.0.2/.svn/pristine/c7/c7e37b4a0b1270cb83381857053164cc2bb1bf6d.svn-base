package org.netbeans.modules.cloud.foo.ui;
import java.io.IOException;
import java.util.Collections;
import java.util.Set;
import javax.swing.event.ChangeListener;
import org.netbeans.modules.cloud.foo.FooInstance;
import org.netbeans.modules.cloud.foo.FooServerInstanceManager;
import org.openide.WizardDescriptor;
import org.openide.WizardDescriptor.Panel;
import org.openide.util.ChangeSupport;
public class FooWizardIterator implements WizardDescriptor.InstantiatingIterator {
    private final ChangeSupport listeners;
    private WizardDescriptor wizard;
    private FooWizardPanel panel;
    boolean first = true;
    public FooWizardIterator() {
        listeners = new ChangeSupport(this);
    }
    @Override
    public Set instantiate() throws IOException {
        String username = (String) wizard.getProperty(FooWizardPanel.USERNAME);
        FooInstance instance = new FooInstance(username);
        FooServerInstanceManager.getDefault().add(instance);
        return Collections.EMPTY_SET;
    }
    @Override
    public void initialize(WizardDescriptor wizard) {
        this.wizard = wizard;
    }
    @Override
    public void uninitialize(WizardDescriptor wizard) {
        panel = null;
    }
    @Override
    public Panel current() {
        if (panel == null) {
            panel = new FooWizardPanel();
        }
        return panel;
    }
    @Override
    public String name() {
        return Bundle.CTL_DISPLAYNAME();
    }
    @Override
    public boolean hasNext() {
        return false;
    }
    @Override
    public boolean hasPrevious() {
        return !first;
    }
    @Override
    public void nextPanel() {
        first = false;
    }
    @Override
    public void previousPanel() {
        first = true;
    }
    @Override
    public void addChangeListener(ChangeListener l) {
        listeners.addChangeListener(l);
    }
    @Override
    public void removeChangeListener(ChangeListener l) {
        listeners.removeChangeListener(l);
    }
}
