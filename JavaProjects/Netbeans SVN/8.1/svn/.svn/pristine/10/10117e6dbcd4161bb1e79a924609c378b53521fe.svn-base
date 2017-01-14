package org.netbeans.modules.cloud.openshift.ui;
import java.io.IOException;
import java.util.Collections;
import java.util.Set;
import javax.swing.JPanel;
import javax.swing.event.ChangeListener;
import org.netbeans.modules.cloud.openshift.OpenShiftInstance;
import org.netbeans.modules.cloud.openshift.OpenShiftInstanceManager;
import org.openide.WizardDescriptor;
import org.openide.WizardDescriptor.Panel;
import org.openide.util.ChangeSupport;
public class OpenShiftWizardIterator implements WizardDescriptor.InstantiatingIterator {
    private ChangeSupport listeners;
    private WizardDescriptor wizard;
    private OpenShiftWizardPanel1 panel;
    private JPanel panel2;
    boolean first = true;
    public OpenShiftWizardIterator() {
        listeners = new ChangeSupport(this);
    }
    public static final String PROP_DISPLAY_NAME = "ServInstWizard_displayName"; // NOI18N
    @Override
    public Set instantiate() throws IOException {
        OpenShiftInstanceManager.getDefault().add(new OpenShiftInstance());
        return Collections.emptySet();
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
        return new OpenShiftWizardPanel1();
    }
    @Override
    public String name() {
        return "Red Hat OpenShift";
    }
    @Override
    public boolean hasNext() {
        return first;
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
