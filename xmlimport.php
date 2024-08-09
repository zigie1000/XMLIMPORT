<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class XmlImport extends Module
{
    public function __construct()
    {
        $this->name = 'xmlimport';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Your Name';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('XML Import');
        $this->description = $this->l('This module imports data from XML files.');

        $this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        return parent::install();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }
}
?>
