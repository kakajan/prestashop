<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class HomeCategories extends Module
{
    public function __construct()
    {
        $this->name = 'homecategories';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Your Name';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Home Categories Showcase');
        $this->description = $this->l('Displays selected categories with their images on the homepage.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        return parent::install() &&
        $this->registerHook('displayHome') &&
        $this->installTab('AdminParentModulesSf', 'AdminHomeCategories', 'Home Categories');
    }

    public function uninstall()
    {
        return parent::uninstall() && $this->uninstallTab('AdminHomeCategories');
    }

    public function hookDisplayHome($params)
    {
        $categories = Category::getHomeCategories((int) $this->context->language->id);
        $this->context->smarty->assign('categories', $categories);

        return $this->display(__FILE__, 'views/templates/hook/homecategories.tpl');
    }

    protected function installTab($parent, $class_name, $name)
    {
        $tab = new Tab();
        $tab->id_parent = (int) Tab::getIdFromClassName($parent);
        $tab->name = array_fill_keys(Language::getIDs(false), $name);
        $tab->class_name = $class_name;
        $tab->module = $this->name;
        return $tab->add();
    }

    protected function uninstallTab($class_name)
    {
        $id_tab = (int) Tab::getIdFromClassName($class_name);
        $tab = new Tab($id_tab);
        return $tab->delete();
    }
}
