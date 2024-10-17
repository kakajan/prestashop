<?php

class AdminHomeCategoriesController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
    }

    public function initContent()
    {
        parent::initContent();

        $this->context->smarty->assign(array(
            'some_variable' => 'value',
        ));

        $this->setTemplate('module:homecategories/views/templates/admin/configure.tpl');
    }
}
