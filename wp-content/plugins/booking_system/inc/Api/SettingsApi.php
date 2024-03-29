<?php

namespace Inc\Api;

class SettingsApi
{
    public $admin_pages = array();
    public $admin_subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();
    public $customPostTypes = array();


    public function register()
    {
        if (!empty($this->admin_pages)) {
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }

        if (!empty($this->settings)) {
            add_action('admin_init', array($this, 'registerCustomFields'));
        }
        // if (!empty($this->customPostTypes)) {

        add_action('admin_init', array($this, 'registerCustomPostTypes'));
        // }
    }

    public function addCustomPostTypes(array $postTypes)
    {
        $this->customPostTypes = $postTypes;
    }
    public function addPages(array $pages)
    {
        $this->admin_pages = $pages;

        return $this;
    }

    public function withSubPage(string $title = null)
    {
        if (empty($this->admin_pages)) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $sub_page = [

            [
                'parent_slug' => $admin_page['menu_slug'],
                'page_title' => $admin_page['page_title'],
                'menu_title' => ($title) ? $title : $admin_page['menu_title'],
                'capibility' => $admin_page['capibility'],
                'menu_slug' => $admin_page['menu_slug'],
                'callback' => $admin_page['callback'],
            ],
        ];

        $this->admin_subpages = $sub_page;

        return $this;
    }

    public function addSubPages(array $pages)
    {
        $this->admin_subpages = array_merge($this->admin_subpages, $pages);

        return $this;
    }

    public function addAdminMenu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page($page['menu_title'], $page['menu_title'], $page['capibility'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }
        foreach ($this->admin_subpages as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capibility'], $page['menu_slug'], $page['callback']);
        }
    }
    public function setSettings(array $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    public function setSections(array $sections)
    {
        $this->sections = $sections;

        return $this;
    }

    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function registerCustomFields()
    {
        foreach ($this->settings as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], (isset($setting['callback']) ? $setting['callback'] : ''));
        }
        foreach ($this->sections as $section) {
            add_settings_section($section['id'], $section['title'], (isset($section['callback']) ? $section['callback'] : ''), $section['page']);
        }
        foreach ($this->fields as $field) {
            add_settings_field($field['id'], $field['title'], (isset($field['callback']) ? $field['callback'] : ''), $field['page'], $field['section'], $field['args']);
        }
    }

    public function registerCustomPostTypes()
    {
        // Our custom post type function
        foreach ($this->customPostTypes as $customPostType) {
            register_post_type(
                $customPostType['name'],
                // CPT Options
                array(
                    'labels' => array(
                        'name' => __($customPostType['label']),
                        'singular_name' => __($customPostType['singularName'])
                    ),
                    'public' => true,
                    'has_archive' => true,
                    'rewrite' => array('slug' => $customPostType['slug']),
                    'show_in_rest' => true,

                )
            );
        }
    }
}
