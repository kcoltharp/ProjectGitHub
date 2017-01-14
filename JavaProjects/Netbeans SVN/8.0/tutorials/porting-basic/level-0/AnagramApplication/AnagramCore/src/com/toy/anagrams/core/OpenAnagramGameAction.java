package com.toy.anagrams.core;

import com.toy.anagrams.ui.Anagrams;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import org.openide.awt.ActionID;
import org.openide.awt.ActionReference;
import org.openide.awt.ActionReferences;
import org.openide.awt.ActionRegistration;
import org.openide.util.NbBundle.Messages;

@ActionID(id="com.toy.anagrams.core.OpenAnagramGameAction",category="Window")
@ActionRegistration(displayName = "#CTL_OpenAnagramGameAction")
@ActionReferences({
    @ActionReference(path = "Menu/Window", position = 10)
})
@Messages("CTL_OpenAnagramGameAction=Open Anagram Game")
public class OpenAnagramGameAction implements ActionListener {

    @Override
    public void actionPerformed(ActionEvent e) {
        new Anagrams().setVisible(true);
    }

}