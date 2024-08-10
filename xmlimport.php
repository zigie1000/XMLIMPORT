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
        $this->author = 'Marco Zagato';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('XML Import');
        $this->description = $this->l('Import products via XML feed.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('actionAdminControllerSetMedia');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookActionAdminControllerSetMedia()
    {
        $this->context->controller->addCSS($this->_path.'views/css/xmlimport.css');
        $this->context->controller->addJS($this->_path.'views/js/xmlimport.js');
    }

    public function getContent()
    {
        // Generate the URL for the configuration page
        $configLink = $this->context->link->getAdminLink('AdminXmlImport');

        // Redirect to the configuration page
        Tools::redirectAdmin($configLink);
    }
}
