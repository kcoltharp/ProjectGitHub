package org.word.editor.lowercase;

import org.openide.util.lookup.ServiceProvider;
import org.word.editor.api.WordFilter;

@ServiceProvider(service=WordFilter.class)
public class LowercaseFilter implements WordFilter {

    @Override
    public String process(String s) {
        return s.toLowerCase();
    }

}