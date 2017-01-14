package org.netbeans.modules.cloud.foo.ui;
import java.io.IOException;
import java.util.Collections;
import java.util.Set;
import javax.swing.event.ChangeListener;
import org.netbeans.modules.cloud.foo.FooCloudInstance;
import org.netbeans.modules.cloud.foo.FooCloudInstanceManager;
import org.openide.WizardDescriptor;
import org.openide.WizardDescriptor.Panel;
import org.openide.util.ChangeSupport;
public class FooCloudWizardIterator implements WizardDescriptor.InstantiatingIterator {
    private final ChangeSupport listeners;
    private WizardDescriptor wizard;
    private FooCloudWizardPanel panel;
    boolean first = true;
    public FooCloudWizardIterator() {
        listeners = new ChangeSupport(this);
    }
    @Override
    public Set instantiate() throws IOException {
        String displayText = (String) wizard.getProperty(FooCloudWizardPanel.DISPLAY_TEXT);
        String userName = (String) wizard.getProperty(FooCloudWizardPanel.USERNAME);
        String password = (String) wizard.getProperty(FooCloudWizardPanel.PASSWORD);
        FooCloudInstance instance = new FooCloudInstance(displayText,userName,password);
        FooCloudInstanceManager.getDefault().add(instance);
        return Collections.singleton(instance.getServerInstance());
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
            panel = new FooCloudWizardPanel();
        }
        return panel;
    }
    @Override
    public String name() {
        return "XXX";
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
