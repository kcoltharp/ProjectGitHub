package org.demo.wizard;

import java.util.HashSet;
import java.util.Iterator;
import java.util.Set;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
import javax.swing.event.DocumentEvent;
import javax.swing.event.DocumentListener;
import org.openide.WizardDescriptor;
import org.openide.WizardValidationException;
import org.openide.util.HelpCtx;
import org.openide.util.NbPreferences;

public final class DemoWizardPanel1 implements WizardDescriptor.ValidatingPanel<WizardDescriptor>, DocumentListener {

    private Set<ChangeListener> listeners = new HashSet<ChangeListener>(1);
    private boolean isValid = true;

    /**
     * The visual component that displays this panel. If you need to access the
     * component from this class, just use getComponent().
     */
    private DemoVisualPanel1 component;

    public DemoWizardPanel1() {
        isValid = false;
    }

    // Get the visual component for the panel. In this template, the component
    // is kept separate. This can be more efficient: if the wizard is created
    // but never displayed, or not all panels are displayed, it is better to
    // create only those which really need to be visible.
    @Override
    public DemoVisualPanel1 getComponent() {
        if (component == null) {
            component = new DemoVisualPanel1();
            component.getNameField().getDocument().addDocumentListener(this);
        }
        return component;
    }

    @Override
    public HelpCtx getHelp() {
        // Show no Help button for this panel:
        return HelpCtx.DEFAULT_HELP;
        // If you have context help:
        // return new HelpCtx("help.key.here");
    }

    @Override
    public boolean isValid() {
        // If it is always OK to press Next or Finish, then:
        //return true;
        // If it depends on some condition (form filled out...) and
        // this condition changes (last form field filled in...) then
        // use ChangeSupport to implement add/removeChangeListener below.
        // WizardDescriptor.ERROR/WARNING/INFORMATION_MESSAGE will also be useful.
        return isValid;
    }

    public final void addChangeListener(ChangeListener l) {
        synchronized (listeners) {
            listeners.add(l);
        }
    }

    public final void removeChangeListener(ChangeListener l) {
        synchronized (listeners) {
            listeners.remove(l);
        }
    }

    protected final void fireChangeEvent() {
        Iterator<ChangeListener> it;
        synchronized (listeners) {
            it = new HashSet<ChangeListener>(listeners).iterator();
        }
        ChangeEvent ev = new ChangeEvent(this);
        while (it.hasNext()) {
            it.next().stateChanged(ev);
        }
    }

    public void insertUpdate(DocumentEvent e) {
        change();
    }

    public void removeUpdate(DocumentEvent e) {
        change();
    }

    public void changedUpdate(DocumentEvent e) {
        change();
    }

    private void change() {
        String currentText = component.getNameField().getText();
        boolean isValidInput = currentText != null && currentText.length() > 0;
        if (isValidInput) {
            setValid(true);
        } else {
            setValid(false);
        }
    }

    private void setValid(boolean val) {
        if (isValid != val) {
            isValid = val;
            fireChangeEvent();  // must do this to enable next/finish button
        }
    }

    @Override
    public void readSettings(WizardDescriptor wiz) {
        component.getNameField().setText(NbPreferences.forModule(DemoWizardPanel1.class).get("namePreference", ""));
    }

    @Override
    public void storeSettings(WizardDescriptor wiz) {
        wiz.putProperty("name", getComponent().getNameField().getText());
        wiz.putProperty("address", getComponent().getAddressField().getText());
        NbPreferences.forModule(DemoWizardPanel1.class).put("namePreference", component.getNameField().getText());
    }

    @Override
    public void validate() throws WizardValidationException {
        String name = component.getNameField().getText();
        if (name.equals("")) {
            isValid = false;
            throw new WizardValidationException(null, "Invalid Name", null);
        }
    }

}
