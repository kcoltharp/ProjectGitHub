package org.netbeans.modules.cloud.foo.ui;
import java.awt.Component;
import javax.swing.event.ChangeListener;
import org.openide.WizardDescriptor;
import org.openide.WizardValidationException;
import org.openide.util.HelpCtx;
public class FooWizardPanel implements WizardDescriptor.AsynchronousValidatingPanel<WizardDescriptor> {
    private FooVisualComponent component;
    public static final String USERNAME = "username"; // String
    @Override
    public Component getComponent() {
        if (component == null) {
            component = new FooVisualComponent();
            component.putClientProperty(WizardDescriptor.PROP_CONTENT_DATA, new String[]{"Settings"});            
            component.putClientProperty(WizardDescriptor.PROP_CONTENT_SELECTED_INDEX, Integer.valueOf(0));
        }
        return component;
    }
    @Override
    public void storeSettings(WizardDescriptor settings) {
        if (component != null) {
            settings.putProperty(USERNAME, component.getUsername());
        }
    }
    @Override
    public boolean isValid() {
        return true;
    }
    @Override
    public void addChangeListener(ChangeListener cl) {
    }
    @Override
    public void removeChangeListener(ChangeListener cl) {
    }
    @Override
    public void prepareValidation() {
    }
    @Override
    public void validate() throws WizardValidationException {
    }
    @Override
    public void readSettings(WizardDescriptor data) {
    }
    @Override
    public HelpCtx getHelp() {
        return HelpCtx.DEFAULT_HELP;
    }
}
