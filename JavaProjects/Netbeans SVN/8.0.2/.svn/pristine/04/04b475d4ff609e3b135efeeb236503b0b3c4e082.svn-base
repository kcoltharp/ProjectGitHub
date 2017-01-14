package org.netbeans.modules.cloud.foo.project;
import java.awt.Component;
import java.io.IOException;
import java.text.MessageFormat;
import java.util.Collections;
import java.util.NoSuchElementException;
import java.util.Set;
import javax.swing.JComponent;
import javax.swing.event.ChangeListener;
import org.netbeans.api.progress.ProgressHandle;
import org.netbeans.api.templates.TemplateRegistration;
import org.netbeans.modules.cloud.common.spi.support.serverplugin.ProgressObjectImpl;
import org.netbeans.modules.cloud.foo.FooCloudInstance;
import org.netbeans.modules.cloud.foo.ui.FooCloudWizardPanel;
import org.openide.WizardDescriptor;
import org.openide.util.NbBundle;
@TemplateRegistration(folder = "Project/Web", displayName = FooCloudInstance.TYPE, description = "FooDescription.html", iconBase = FooCloudInstance.ICON)
public class FooProjectWizardIterator implements WizardDescriptor.ProgressInstantiatingIterator {
    private int index;
    private WizardDescriptor.Panel[] panels;
    private WizardDescriptor wizard;
    public FooProjectWizardIterator() {
    }
    public static FooProjectWizardIterator createIterator() {
        return new FooProjectWizardIterator();
    }
    private WizardDescriptor.Panel[] createPanels() {
        return new WizardDescriptor.Panel[]{
            new FooCloudWizardPanel(),
            new FooNewAppPanel()
        };
    }
    private String[] createSteps() {
        return new String[]{
            NbBundle.getMessage(FooProjectWizardIterator.class, "LBL_SignInStep"),
            NbBundle.getMessage(FooProjectWizardIterator.class, "LBL_CreateProjectStep")
        };
    }
    @Override
    public Set/*<FileObject>*/ instantiate(ProgressHandle handle) throws IOException {
        String userName = (String) wizard.getProperty(FooCloudWizardPanel.USERNAME);
        String password = (String) wizard.getProperty(FooCloudWizardPanel.PASSWORD);
        FooCloudInstance.getDefault(userName, password);
//        FooCloudInstance instance = new FooCloudInstance(userName, password);
//        FooCloudInstanceManager.getDefault().add(instance);
        String applicationName = (String) wizard.getProperty(FooNewAppPanel.APPLICATIONNAME);
        String cartridgeName = (String) wizard.getProperty(FooNewAppPanel.CARTRIDGENAME);
//        wizard.getProperties();
        ProgressObjectImpl po = new ProgressObjectImpl("Starting distribution...", false);
        FooCloudInstance.deployAsync(userName, password, applicationName, cartridgeName, po);
        return Collections.EMPTY_SET;
    }
    @Override
    public Set instantiate() throws IOException {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
    @Override
    public void initialize(WizardDescriptor wiz) {
        this.wizard = wiz;
        index = 0;
        if (FooCloudInstance.userName == null && FooCloudInstance.password == null) {
            panels = createPanels();
        } else {
            panels = new WizardDescriptor.Panel[]{new FooNewAppPanel()};
        }
        // Make sure list of steps is accurate.
        String[] steps = createSteps();
        for (int i = 0; i < panels.length; i++) {
            Component c = panels[i].getComponent();
            if (steps[i] == null) {
                // Default step name to component name of panel.
                // Mainly useful for getting the name of the target
                // chooser to appear in the list of steps.
                steps[i] = c.getName();
            }
            if (c instanceof JComponent) { // assume Swing components
                JComponent jc = (JComponent) c;
                // Step #.
                // TODO if using org.openide.dialogs >= 7.8, can use WizardDescriptor.PROP_*:
                jc.putClientProperty("WizardPanel_contentSelectedIndex", new Integer(i));
                // Step name (actually the whole list for reference).
                jc.putClientProperty("WizardPanel_contentData", steps);
            }
        }
    }
    @Override
    public void uninitialize(WizardDescriptor wiz) {
        this.wizard.putProperty("projdir", null);
        this.wizard.putProperty("name", null);
        this.wizard = null;
        panels = null;
    }
    @Override
    public String name() {
        return MessageFormat.format("{0} of {1}",
                new Object[]{new Integer(index + 1), new Integer(panels.length)});
    }
    @Override
    public boolean hasNext() {
        return index < panels.length - 1;
    }
    @Override
    public boolean hasPrevious() {
        return index > 0;
    }
    @Override
    public void nextPanel() {
        if (!hasNext()) {
            throw new NoSuchElementException();
        }
        index++;
    }
    @Override
    public void previousPanel() {
        if (!hasPrevious()) {
            throw new NoSuchElementException();
        }
        index--;
    }
    @Override
    public WizardDescriptor.Panel current() {
        return panels[index];
    }
    // If nothing unusual changes in the middle of the wizard, simply:
    @Override
    public final void addChangeListener(ChangeListener l) {
    }
    @Override
    public final void removeChangeListener(ChangeListener l) {
    }
}
