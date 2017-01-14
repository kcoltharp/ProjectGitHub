package org.myorg.myeditor;

import java.beans.PropertyEditorSupport;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import org.openide.explorer.propertysheet.ExPropertyEditor;
import org.openide.explorer.propertysheet.InplaceEditor;
import org.openide.explorer.propertysheet.PropertyEnv;
import org.openide.nodes.PropertyEditorRegistration;

@PropertyEditorRegistration(targetType = Date.class)
public class DatePropertyEditor extends PropertyEditorSupport implements ExPropertyEditor, InplaceEditor.Factory {

    @Override
    public void attachEnv(PropertyEnv env) {
        env.registerInplaceEditorFactory(this);
    }

    private InplaceEditor ed = null;

    @Override
    public InplaceEditor getInplaceEditor() {
        if (ed == null) {
            ed = new Inplace();
        }
        return ed;
    }

    @Override
    public String getAsText() {
        Date d = (Date) getValue();
        if (d == null) {
            return "No Date Set";
        }
        return new SimpleDateFormat("MM/dd/yy HH:mm:ss").format(d);
    }

    @Override
    public void setAsText(String s) {
        try {
            setValue(new SimpleDateFormat("MM/dd/yy HH:mm:ss").parse(s));
        } catch (ParseException pe) {
            IllegalArgumentException iae = new IllegalArgumentException("Could not parse date");
            throw iae;
        }
    }

}
