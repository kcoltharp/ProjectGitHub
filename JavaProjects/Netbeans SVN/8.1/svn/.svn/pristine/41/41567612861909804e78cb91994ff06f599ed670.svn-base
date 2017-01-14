/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.ceylon.nbparser;
import com.redhat.ceylon.compiler.typechecker.parser.CeylonLexer;
import com.redhat.ceylon.compiler.typechecker.parser.CeylonParser;
import java.io.Reader;
import java.io.StringReader;
import java.util.Collections;
import java.util.List;
import javax.swing.event.ChangeListener;
import org.antlr.runtime.ANTLRStringStream;
import org.antlr.runtime.CommonTokenStream;
import org.antlr.runtime.RecognitionException;
import org.netbeans.modules.csl.api.Error;
import org.netbeans.modules.csl.spi.ParserResult;
import org.netbeans.modules.parsing.api.Snapshot;
import org.netbeans.modules.parsing.api.Task;
import org.netbeans.modules.parsing.spi.ParseException;
import org.netbeans.modules.parsing.spi.Parser;
import org.netbeans.modules.parsing.spi.Parser.Result;
import org.netbeans.modules.parsing.spi.SourceModificationEvent;
import org.openide.util.Exceptions;
public class NBCeylonParser extends Parser {
    private Snapshot snapshot;
    private CeylonParser ceylonParser;
    @Override
    public void parse(Snapshot snapshot, Task task, SourceModificationEvent event) {
        this.snapshot = snapshot;
        ANTLRStringStream input = new ANTLRStringStream(snapshot.getText().toString());
        CeylonLexer ceylonLexer = new CeylonLexer(input);
        CommonTokenStream cts = new CommonTokenStream(ceylonLexer);
        ceylonParser = new CeylonParser(cts);
        try {
            ceylonParser.compilationUnit();
        } catch (RecognitionException ex) {
            Exceptions.printStackTrace(ex);
        }
    }
    @Override
    public Result getResult(Task task) {
        return new CeylonParserResult(snapshot, ceylonParser);
    }
    @Override
    public void cancel() {
    }
    @Override
    public void addChangeListener(ChangeListener changeListener) {
    }
    @Override
    public void removeChangeListener(ChangeListener changeListener) {
    }
    public static class CeylonParserResult extends ParserResult {
        private CeylonParser ceylonParser;
        private boolean valid = true;
        CeylonParserResult(Snapshot snapshot, CeylonParser ceylonParser) {
            super(snapshot);
            this.ceylonParser = ceylonParser;
        }
        public CeylonParser getCeylonParser() throws org.netbeans.modules.parsing.spi.ParseException {
            if (!valid) {
                throw new org.netbeans.modules.parsing.spi.ParseException();
            }
            return ceylonParser;
        }
        @Override
        protected void invalidate() {
            valid = false;
        }
        @Override
        public List<? extends Error> getDiagnostics() {
            return Collections.EMPTY_LIST;
        }
    }
}
