<?php
class VMware_VCloud_API_FileUploadSocketType extends VMware_VCloud_API_VCloudExtensibleType {
    protected $uploadLocation = null;
    protected $Task = null;
    protected $namespace = array();
    protected $namespacedef = null;
    protected $tagName = null;
    public static $defaultNS = 'http://www.vmware.com/vcloud/v1.5';

   /**
    * @param array $VCloudExtension - [optional] an array of VMware_VCloud_API_VCloudExtensionType objects
    * @param string $uploadLocation - [optional] an attribute, 
    * @param VMware_VCloud_API_TaskType $Task - [optional]
    */
    public function __construct($VCloudExtension=null, $uploadLocation=null, $Task=null) {
        parent::__construct($VCloudExtension);
        $this->uploadLocation = $uploadLocation;
        $this->Task = $Task;
        $this->tagName = '';
        $this->namespacedef = ' xmlns:vcloud="http://www.vmware.com/vcloud/v1.5" xmlns:ns12="http://www.vmware.com/vcloud/v1.5" xmlns:ovf="http://schemas.dmtf.org/ovf/envelope/1" xmlns:ovfenv="http://schemas.dmtf.org/ovf/environment/1" xmlns:vmext="http://www.vmware.com/vcloud/extension/v1.5" xmlns:cim="http://schemas.dmtf.org/wbem/wscim/1/common" xmlns:rasd="http://schemas.dmtf.org/wbem/wscim/1/cim-schema/2/CIM_ResourceAllocationSettingData" xmlns:vssd="http://schemas.dmtf.org/wbem/wscim/1/cim-schema/2/CIM_VirtualSystemSettingData" xmlns:vmw="http://www.vmware.com/schema/ovf" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
    }
    public function getTask() {
        return $this->Task;
    }
    public function setTask($Task) { 
        $this->Task = $Task;
    }
    public function get_uploadLocation(){
        return $this->uploadLocation;
    }
    public function set_uploadLocation($uploadLocation) {
        $this->uploadLocation = $uploadLocation;
    }
    public function get_tagName() { return $this->tagName; }
    public function set_tagName($tagName) { $this->tagName = $tagName; }
    public function export($name=null, $out='', $level=0, $namespacedef=null, $namespace=null, $rootNS=null) {
        if (!isset($name)) {
            $name = $this->tagName;
        }
        $out = VMware_VCloud_API_Helper::showIndent($out, $level);
        if (is_null($namespace)) {
            $namespace = self::$defaultNS;
        }
        if (is_null($rootNS)) {
            $rootNS = self::$defaultNS;
        }
        if (NULL === $namespacedef) {
            $namespacedef = $this->namespacedef;
            if (0 >= strpos($namespacedef, 'xmlns=')) {
                $namespacedef = ' xmlns="' . self::$defaultNS . '"' . $namespacedef;
            }
        }
        $ns = VMware_VCloud_API_Helper::getNamespaceTag($this->namespace, $name, self::$defaultNS, $namespace, $rootNS);
        $out = VMware_VCloud_API_Helper::addString($out, '<' . $ns . $name . $namespacedef);
        $out = $this->exportAttributes($out, $level, $name, $namespacedef, $namespace, $rootNS);
        if ($this->hasContent()) {
            $out = VMware_VCloud_API_Helper::addString($out, ">\n");
            $out = $this->exportChildren($out, $level + 1, $name, $namespace, $rootNS);
            $out = VMware_VCloud_API_Helper::showIndent($out, $level);
            $out = VMware_VCloud_API_Helper::addString($out, "</" . $ns . $name . ">\n");
        } else {
            $out = VMware_VCloud_API_Helper::addString($out, "/>\n");
        }
        return $out;
    }
    protected function exportAttributes($out, $level, $name, $namespace, $rootNS) {
        $namespace = self::$defaultNS;
        $out = parent::exportAttributes($out, $level, $name, $namespace, $rootNS);
        if (!is_null($this->uploadLocation)) {
            $ns = VMware_VCloud_API_Helper::getAttributeNamespaceTag($this->namespace, 'uploadLocation', self::$defaultNS, $namespace, $rootNS);
            $out = VMware_VCloud_API_Helper::addString($out, ' ' . $ns . 'uploadLocation=' . VMware_VCloud_API_Helper::quote_attrib(VMware_VCloud_API_Helper::format_string(mb_convert_encoding($this->uploadLocation, VMware_VCloud_API_Helper::$ExternalEncoding, "auto"), $input_name='uploadLocation')));
        }
        return $out;
    }
    protected function exportChildren($out, $level, $name, $namespace, $rootNS) {
        $namespace = self::$defaultNS;
        $out = parent::exportChildren($out, $level, $name, $namespace, $rootNS);
        if (!is_null($this->Task)) {
            $out = $this->Task->export('Task', $out, $level, '', $namespace, $rootNS);
        }
        return $out;
    }
    protected function hasContent() {
        if (
            !is_null($this->Task) ||
            parent::hasContent()
            ) {
            return true;
        } else {
            return false;
        }
    }
    public function build($node, $namespaces='') {
        $tagName = $node->tagName;
        $this->tagName = $tagName;
        if (strpos($tagName, ':') > 0) {
            list($namespace, $tagName) = explode(':', $tagName);
            $this->tagName = $tagName;
            $this->namespace[$tagName] = $namespace;
        }
        $this->buildAttributes($node, $namespaces);
        $children = $node->childNodes;
        foreach ($children as $child) {
            if ($child->nodeType == XML_ELEMENT_NODE || $child->nodeType == XML_TEXT_NODE) {
                $namespace = '';
                $nodeName = $child->nodeName;
                if (strpos($nodeName, ':') > 0) {
                    list($namespace, $nodeName) = explode(':', $nodeName);
                }
                $this->buildChildren($child, $nodeName, $namespace);
            }
        }
    }
    protected function buildAttributes($node, $namespaces='') {
        $attrs = $node->attributes;
        if (!empty($namespaces)) {
            $this->namespacedef = VMware_VCloud_API_Helper::constructNS($attrs, $namespaces, $this->namespacedef) . $this->namespacedef;
        }
        $nsUri = self::$defaultNS;
        $nduploadLocation = $attrs->getNamedItem('uploadLocation');
        if (!is_null($nduploadLocation)) {
            $this->uploadLocation = $nduploadLocation->value;
            if (isset($nduploadLocation->prefix)) {
                $this->namespace['uploadLocation'] = $nduploadLocation->prefix;
                $nsUri = $nduploadLocation->lookupNamespaceURI($nduploadLocation->prefix);
            }
            $node->removeAttributeNS($nsUri, 'uploadLocation');
        } else {
            $this->uploadLocation = null;
        }
        parent::buildAttributes($node, $namespaces);
    }
    protected function buildChildren($child, $nodeName, $namespace='') {
        if ($child->nodeType == XML_ELEMENT_NODE && $nodeName == 'Task') {
            $obj = new VMware_VCloud_API_TaskType();
            $obj->build($child);
            $obj->set_tagName('Task');
            $this->setTask($obj);
            if (!empty($namespace)) {
                $this->namespace['Task'] = $namespace;
            }
        }
        parent::buildChildren($child, $nodeName, $namespace);
    }
}