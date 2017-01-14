package org.ceylon.nblexer;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import javax.swing.text.Document;
import org.ceylon.nbparser.NBCeylonParser.CeylonParserResult;
import org.netbeans.modules.csl.api.OffsetRange;
import org.netbeans.modules.csl.api.StructureItem;
import org.netbeans.modules.csl.api.StructureScanner;
import org.netbeans.modules.csl.api.StructureScanner.Configuration;
import org.netbeans.modules.csl.spi.ParserResult;
public class CeylonStructureScanner implements StructureScanner {
    public static final String CODE_FOLDS = "codeblocks";
    @Override
    public List<? extends StructureItem> scan(ParserResult pr) {
        return new ArrayList<StructureItem>();
    }
    @Override
    public Map<String, List<OffsetRange>> folds(ParserResult pr) {
        HashMap<String, List<OffsetRange>> folds = new HashMap<String, List<OffsetRange>>();
//        CeylonParserResult cpr = (CeylonParserResult) pr;
//        Document document = pr.getSnapshot().getSource().getDocument(false);
//        cpr.getCeylonParser().getErrors()
        return folds;
    }
    private static class IdentRegion {
        int start;
        int indent;
        public IdentRegion(int start, int indent) {
            this.start = start;
            this.indent = indent;
        }
    }
    @Override
    public Configuration getConfiguration() {
        return null;
    }
}
