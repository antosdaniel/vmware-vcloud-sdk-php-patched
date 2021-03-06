<?php
class VMware_VCloud_API_FirewallServiceType extends VMware_VCloud_API_NetworkServiceType {
    protected $DefaultAction = null;
    protected $LogDefaultAction = null;
    protected $FirewallRule = array();
    protected $namespace = array();
    protected $namespacedef = null;
    protected $tagName = null;
    public static $defaultNS = 'http://www.vmware.com/vcloud/v1.5';

   /**
    * @param array $VCloudExtension - [optional] an array of VMware_VCloud_API_VCloudExtensionType objects
    * @param boolean $IsEnabled - [optional] 
    * @param string $DefaultAction - [optional] 
    * @param boolean $LogDefaultAction - [optional] 
    * @param array $FirewallRule - [optional] an array of VMware_VCloud_API_FirewallRuleType objects
    */
    public function __construct($VCloudExtension=null, $IsEnabled=null, $DefaultAction=null, $LogDefaultAction=null, $FirewallRule=null) {
        parent::__construct($VCloudExtension, $IsEnabled);
        $this->DefaultAction = $DefaultAction;
        $this->LogDefaultAction = $LogDefaultAction;
        if (!is_null($FirewallRule)) {
            $this->FirewallRule = $FirewallRule;
        }
        $this->tagName = 'FirewallService';
        $this->namespacedef = ' xmlns:vcloud="http://www.vmware.com/vcloud/v1.5" xmlns:ns12="http://www.vmware.com/vcloud/v1.5" xmlns:ovf="http://schemas.dmtf.org/ovf/envelope/1" xmlns:ovfenv="http://schemas.dmtf.org/ovf/environment/1" xmlns:vmext="http://www.vmware.com/vcloud/extension/v1.5" xmlns:cim="http://schemas.dmtf.org/wbem/wscim/1/common" xmlns:rasd="http://schemas.dmtf.org/wbem/wscim/1/cim-schema/2/CIM_ResourceAllocationSettingData" xmlns:vssd="http://schemas.dmtf.org/wbem/wscim/1/cim-schema/2/CIM_VirtualSystemSettingData" xmlns:vmw="http://www.vmware.com/schema/ovf" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"';
    }
    public function getDefaultAction() {
        return $this->DefaultAction;
    }
    public function setDefaultAction($DefaultAction) { 
        $this->DefaultAction = $DefaultAction;
    }
    public function getLogDefaultAction() {
        return $this->LogDefaultAction;
    }
    public function setLogDefaultAction($LogDefaultAction) { 
        $this->LogDefaultAction = $LogDefaultAction;
    }
    public function getFirewallRule() {
        return $this->FirewallRule;
    }
    public function setFirewallRule($FirewallRule) { 
        $this->FirewallRule = $FirewallRule;
    }
    public function addFirewallRule($value) { array_push($this->FirewallRule, $value); }
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
        return $out;
    }
    protected function exportChildren($out, $level, $name, $namespace, $rootNS) {
        $namespace = self::$defaultNS;
        $out = parent::exportChildren($out, $level, $name, $namespace, $rootNS);
        if (!is_null($this->DefaultAction)) {
            $out = VMware_VCloud_API_Helper::showIndent($out, $level);
            $ns = VMware_VCloud_API_Helper::getNamespaceTag($this->namespace, 'DefaultAction', self::$defaultNS, $namespace, $rootNS);
            $out = VMware_VCloud_API_Helper::addString($out, "<" . $ns . "DefaultAction>" . VMware_VCloud_API_Helper::quote_xml(VMware_VCloud_API_Helper::format_string(mb_convert_encoding($this->DefaultAction, VMware_VCloud_API_Helper::$ExternalEncoding, "auto"), $input_name='DefaultAction')) . "</" . $ns . "DefaultAction>\n");
        }
        if (!is_null($this->LogDefaultAction)) {
            $out = VMware_VCloud_API_Helper::showIndent($out, $level);
            $ns = VMware_VCloud_API_Helper::getNamespaceTag($this->namespace, 'LogDefaultAction', self::$defaultNS, $namespace, $rootNS);
            $out = VMware_VCloud_API_Helper::addString($out, "<" . $ns . "LogDefaultAction>" . VMware_VCloud_API_Helper::format_boolean($this->LogDefaultAction, $input_name='LogDefaultAction') . "</" . $ns . "LogDefaultAction>\n");
        }
        if (isset($this->FirewallRule)) {
            foreach ($this->FirewallRule as $FirewallRule) {
                $out = $FirewallRule->export('FirewallRule', $out, $level, '', $namespace, $rootNS);
            }
        }
        return $out;
    }
    protected function hasContent() {
        if (
            !is_null($this->DefaultAction) ||
            !is_null($this->LogDefaultAction) ||
            !empty($this->FirewallRule) ||
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
        parent::buildAttributes($node, $namespaces);
    }
    protected function buildChildren($child, $nodeName, $namespace='') {
        if ($child->nodeType == XML_ELEMENT_NODE && $nodeName == 'DefaultAction') {
            $sval = $child->nodeValue;
            $this->DefaultAction = $sval;
            if (!empty($namespace)) {
                $this->namespace['DefaultAction'] = $namespace;
            }
        }
        elseif ($child->nodeType == XML_ELEMENT_NODE && $nodeName == 'LogDefaultAction') {
            $sval = VMware_VCloud_API_Helper::get_boolean($child->nodeValue);
            $this->LogDefaultAction = $sval;
            if (!empty($namespace)) {
                $this->namespace['LogDefaultAction'] = $namespace;
            }
        }
        elseif ($child->nodeType == XML_ELEMENT_NODE && $nodeName == 'FirewallRule') {
            $obj = new VMware_VCloud_API_FirewallRuleType();
            $obj->build($child);
            $obj->set_tagName('FirewallRule');
            array_push($this->FirewallRule, $obj);
            if (!empty($namespace)) {
                $this->namespace['FirewallRule'] = $namespace;
            }
        }
        parent::buildChildren($child, $nodeName, $namespace);
    }
}