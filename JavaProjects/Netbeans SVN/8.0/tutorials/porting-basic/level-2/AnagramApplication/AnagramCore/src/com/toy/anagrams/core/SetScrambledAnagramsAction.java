package com.toy.anagrams.core;

import com.toy.anagrams.lib.StaticWordLibrary;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.text.BadLocationException;
import javax.swing.text.StyledDocument;
import org.openide.awt.ActionID;
import org.openide.awt.ActionReference;
import org.openide.awt.ActionReferences;
import org.openide.awt.ActionRegistration;
import org.openide.cookies.EditorCookie;
import org.openide.util.Exceptions;
import org.openide.util.NbBundle.Messages;
import org.openide.windows.TopComponent;
import org.openide.windows.WindowManager;

@ActionID(id="com.toy.anagrams.core.SetScrambledAnagramsAction",category="Window")
@ActionRegistration(displayName = "#CTL_SetScrambledAnagramsAction")
@ActionReferences({
    @ActionReference(path = "Editors/text/x-manifest/Popup", position = 10)
})
@Messages("CTL_SetScrambledAnagramsAction=Set Scrambled Words")
public final class SetScrambledAnagramsAction implements ActionListener {

    private final EditorCookie context;

    public SetScrambledAnagramsAction(EditorCookie context) {
        this.context = context;
    }

    @Override
    public void actionPerformed(ActionEvent ev) {
        try {
            //Get the EditorCookie's document:
            StyledDocument doc = context.getDocument();
            //Get the complete textual content:
            String all = doc.getText(0, doc.getLength());
            //Make words from the content:
            String[] tokens = all.split(" ");
            //Pass the words to the WordLibrary class:
            StaticWordLibrary.setScrambledWordList(tokens);
            //Open the TopComponent:
            TopComponent win = WindowManager.getDefault().findTopComponent("AnagramTopComponent");
            win.open();
            win.requestActive();
        } catch (BadLocationException ex) {
            Exceptions.printStackTrace(ex);
        }
    }

}