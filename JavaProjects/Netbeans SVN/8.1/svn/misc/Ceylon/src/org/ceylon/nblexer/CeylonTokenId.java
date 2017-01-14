/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.ceylon.nblexer;
import javax.swing.JOptionPane;
import org.netbeans.api.lexer.Language;
import org.netbeans.api.lexer.TokenId;
/**
 *
 * @author geertjan
 */
public class CeylonTokenId implements TokenId {
    private final String name;
    private final String primaryCategory;
    private final int id;
    CeylonTokenId(
            String name,
            String primaryCategory,
            int id) {
        this.name = name;
        this.primaryCategory = primaryCategory;
        this.id = id;
    }
    @Override
    public String primaryCategory() {
        return primaryCategory;
    }
    @Override
    public int ordinal() {
        return id;
    }
    @Override
    public String name() {
        return name;
    }
    public static Language<CeylonTokenId> getLanguage() {
        Language<CeylonTokenId> language = null;
        try {
            language = new CeylonTokenHierarchy().language();
        } catch (java.lang.ArrayIndexOutOfBoundsException e) {
//            System.out.println("e = " + e);
        }
        return language;
    }
}
