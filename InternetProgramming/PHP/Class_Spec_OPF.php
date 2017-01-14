<?php
/**
 * This file is part of ePubLib.
 *
 * ePubLib is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ePubLib is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ePubLib.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * OPF mapping class
 *
 * Class to map OPF Spec in PHP. It is based on OPF 2.0 v1.0 final spec.
 *
 * @link http://www.idpf.org/2007/opf/OPF_2.0_final_spec.html OPF specification
 * @see SimpleXMLElement
 * @author Pierre-Yves Gillier <pierre-yves@gillier.name>
 * @package ePubLib
 * @subpackage Spec
 */
class Spec_OPF extends SimpleXMLElement
{
    /**
     * Returns title from this OPF document
     *
     * This method will return first encountered title in underlying XML tree.
     * <br/>
     * 
     * @todo Manages languages & various titles
     * @return string Document's title
     */
    public function getTitle()
    {
        $this->registerNamespaces();
        $query = '//dc:title[1]';
        $title = $this->getOneXpathItem($query);
        return($title->__toString());
    }

    /**
     * Returns an identifier entry from this OPF document
     *
     * @param boolean Returns "unique-identifier" entry (default: true)
     * @param array $opts Options
     * @return string Content of selected identifier
     * @todo Finish with opfScheme & custom ID.
     */
    public function getIdentifier( $opts = null )
    {
        // Settings options with defaults
        $defaultsOpts = array(
            'opfScheme' => null,
            'id' => null,
            'uniqueIdentifier' => true
        );
        $opts = $this->checkOptions($defaultsOpts, $opts);

        $query = '//dc:identifier';
        $this->registerNamespaces();

        
        if ( true === $opts['uniqueIdentifier']) {
            $attrs = $this->attributes();
            if(is_null($attrs["unique-identifier"]->__toString()))
                throw new ePubException("No unique-identifier attribute found");
            $query.="[@id='".$attrs["unique-identifier"]->__toString()."']";
        }
        else

        
        $result = $this->getOneXpathItem($query);
        return($result);
    }

    /**
     * Return guide for this OPF document
     * @param string $type Reference type (default: null)
     */
    public function getGuide($type = null)
    {
        $guide = $arr = array();
        
        if ($this->guide->count() >0) {
            foreach ($this->guide->reference as $reference) {
                $refArray = $reference->attributes();
                $offset = $refArray->type->__toString();
                $arr[$offset] = array(
                    'title' => $refArray->title->__toString(),
                    'href'  => $refArray->href->__toString(),
                );
                array_push($guide, $arr);
            }
        }
        return($guide);
    }

    /**
     * Returns subjects contained in this OPF document.
     *
     * This method retrieves all "dc:subject" entries from underlying XML and
     * cast them to an array.<br/>
     * It will return an array even with zero or only one entry.
     * 
     * @return array List of subjects
     * @todo provide a way to sort subjects.
     */
    public function getSubjects()
    {
        $subjects = array();
        $this->registerNamespaces();
        
        foreach($this->xpath("//dc:subject") as $k=>$subject)
            array_push($subjects, $subject->__toString());

        return($subjects);
    }

    /**
     * Returns an item from manifest
     *
     * Given an ID, this method will return corresponding item if found in
     * the manifest of this OPF Document.<br/>
     * List of IDs can be retrieved with {@link getGuide()} method.
     * 
     * @param int|string $itemId ID of item
     * @return array Selected item (or NULL if none found matching)
     */
    public function getItem($itemId)
    {
        $this->registerNamespaces();

        var_dump($this->xpath("/"));
    }

    /**
     * Returns description from this document.
     * 
     * @return mixed Document's description (or NULL if not available)
     */
    public function getDescription()
    {
        $description = null;
        $description = $this->getOneXpathItem('//dc:description[1]');
        return trim($description->__toString());
    }

    /**
     * Returns selected creator
     *
     * Options:
     * <ul>
     * <li>role: Selected role code (default: "aut")
     * </ul>
     * <b>Note:</b> An exception will be thrown if role is not found
     * in MARC list.
     *
     * @link http://www.loc.gov/marc/relators/ MARC21 Code List for Relators
     * @param array $opts  List of options
     * @return array Selected creator with associated fulltext role
     * @todo Return "file-as" attribute
     */
    public function getCreator($opts = null)
    {
        $creator = null;
        $defaultOpts = array(
            'role' => 'aut',
        );
        $opts = $this->checkOptions($defaultOpts, $opts);

        // Tests if code is valid
        if(!Spec_OPF_Marc::testCode($opts['role']))
            throw new Exception("Provided role isn't a valid MARC one.");

        $query = "//dc:creator[@opf:role='".$opts['role']."']";

        $result = $this->getOneXpathItem($query);
        
        $creator = array(
            'name' => trim($result->__toString()),
            'role' => Spec_OPF_Marc::getTerm($opts['role'])
            );
        return($creator);
    }

    public function getPublisher()
    {
        $publisher = null;
        $this->registerNamespaces();
        $publisher = $this->getOneXpathItem("//dc:publisher");
        return($publisher->__toString());
    }

    /** PRIVATE FUNCTIONS **/
    
    /**
     * Register customs namespaces defined in document
     *
     * @param boolean $recursive Whether or not recurse in document's NS.
     */
    private function registerNamespaces($recursive = true)
    {
        //Fetch all namespaces
        $namespaces = $this->getNamespaces($recursive);

        //Register them with their prefixes
        foreach ($namespaces as $prefix => $ns) {
            $this->registerXPathNamespace($prefix, $ns);
        }
    }

    private function checkOptions($defaultsOpts, $opts)
    {
        if(!is_null($opts) && !is_array($opts))
            throw new ePubException("Method expects an array or NULL value");
        if(is_array($opts))
            return array_merge($defaultsOpts, $opts);

        return($defaultsOpts);

    }

    private function getOneXpathItem($query)
    {
        $this->registerNamespaces();
        $node = $this->xpath($query);
        if (count($node) != 1) {
            throw new ePubException(
                    "More than one item has been retrieved for query [$query]"
            );
        }
        var_dump($node);
        return($node[0]);
    }
}