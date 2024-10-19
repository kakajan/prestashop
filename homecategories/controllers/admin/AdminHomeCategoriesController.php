<?php

class AdminHomeCategoriesController extends ModuleAdminController
{
    public $name = 'AdminHomeCategories';

    public function __construct()
    {
        $this->bootstrap = true; // Enables Bootstrap styles

        $this->table = 'homecategories'; // Sets the database table
        $this->className = 'HomeCategories'; // Sets the class name
        $this->lang = false; // Disables multi-language support (change to true if necessary)

        parent::__construct();

        $this->fields_list = array(
            'id_category' => array(
                'title' => $this->l('Category ID'),
                'align' => 'center',
                'class' => 'fixed-width-xs',
            ),
            'name' => array(
                'title' => $this->l('Category Name'),
            ),
        );
    }

    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:homecategories/views/templates/admin/configure.tpl');
    }

    public function postProcess()
    {
        if (Tools::isSubmit('submitHomeCategories')) {
            $selectedCategories = Tools::getValue('CATEGORIES');
            Configuration::updateValue('HOME_CATEGORIES', implode(',', $selectedCategories));
            $this->confirmations[] = $this->l('Settings updated');
        }
    }

    public function renderForm()
    {
        $categories = Category::getCategories($this->context->language->id, true);
        $selectedCategories = explode(',', Configuration::get('HOME_CATEGORIES'));

        $this->fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Home Categories Settings'),
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Select Categories'),
                        'name' => 'CATEGORIES[]',
                        'multiple' => true,
                        'options' => array(
                            'query' => $categories,
                            'id' => 'id_category',
                            'name' => 'name',
                        ),
                        'default_value' => $selectedCategories,
                        'desc' => $this->l('Select categories to display on the homepage.'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'name' => 'submitHomeCategories',
                ),
            ),
        );

        return parent::renderForm();
    }

}
