package org.myorg.myeditor;

import java.awt.Component;
import java.awt.event.ActionListener;
import java.beans.PropertyEditor;
import java.util.Date;
import javax.swing.JComponent;
import javax.swing.KeyStroke;
import org.jdesktop.swingx.JXDatePicker;
import org.openide.explorer.propertysheet.InplaceEditor;
import org.openide.explorer.propertysheet.PropertyEnv;
import org.openide.explorer.propertysheet.PropertyModel;

class Inplace implements InplaceEditor {

    private final JXDatePicker picker = new JXDatePicker();
    private PropertyEditor editor = null;

    @Override
    public void connect(PropertyEditor propertyEditor, PropertyEnv env) {
        editor = propertyEditor;
        reset();
    }

    @Override
    public JComponent getComponent() {
        return picker;
    }

    @Override
    public void clear() {
        //avoid memory leaks:
        editor = null;
        model = null;
    }

    @Override
    public Object getValue() {
        return picker.getDate();
    }

    @Override
    public void setValue(Object object) {
        picker.setDate((Date) object);
    }

    @Override
    public boolean supportsTextEntry() {
        return true;
    }

    @Override
    public void reset() {
        Date d = (Date) editor.getValue();
        if (d != null) {
            picker.setDate(d);
        }
    }

    @Override
    public KeyStroke[] getKeyStrokes() {
        return new KeyStroke[0];
    }

    @Override
    public PropertyEditor getPropertyEditor() {
        return editor;
    }

    @Override
    public PropertyModel getPropertyModel() {
        return model;
    }

    private PropertyModel model;

    @Override
    public void setPropertyModel(PropertyModel propertyModel) {
        this.model = propertyModel;
    }

    @Override
    public boolean isKnownComponent(Component component) {
        return component == picker || picker.isAncestorOf(component);
    }

    @Override
    public void addActionListener(ActionListener actionListener) {
        //do nothing - not needed for this component
    }

    @Override
    public void removeActionListener(ActionListener actionListener) {
        //do nothing - not needed for this component
    }

}
