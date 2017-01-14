package org.ceylon.nblexer;
import org.ceylon.nbparser.NBCeylonParser;
import com.redhat.ceylon.compiler.typechecker.parser.CeylonParser;
import org.netbeans.api.lexer.Language;
import org.netbeans.modules.csl.api.StructureScanner;
import org.netbeans.modules.csl.spi.DefaultLanguageConfig;
import org.netbeans.modules.csl.spi.LanguageRegistration;
import org.netbeans.modules.parsing.spi.Parser;
@LanguageRegistration(mimeType = "text/x-ceylon")
public class CeylonLanguage extends DefaultLanguageConfig {
    @Override
    public Language<CeylonTokenId> getLexerLanguage() {
        return CeylonTokenId.getLanguage();
    }
    @Override
    public String getDisplayName() {
        return "Ceylon";
    }
    @Override
    public Parser getParser() {
        return new NBCeylonParser();
    }
    @Override
    public StructureScanner getStructureScanner() {
        return new CeylonStructureScanner();
    }
    @Override
    public boolean hasStructureScanner() {
        return true;
    }
}
