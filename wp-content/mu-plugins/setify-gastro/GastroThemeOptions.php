<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Piwi
 * Date: 10.02.13
 * Time: 15:58
 * To change this template use File | Settings | File Templates.
 */

class GastroThemeOptions
{

    private $headlineTypoDefaults = array();

    static private $instance = null;

    public function setHeadlineTypoDefaults($headlineTypoDefaults)
    {
        $this->headlineTypoDefaults = $headlineTypoDefaults;
    }

    public function getHeadlineTypoDefaults()
    {
        return $this->headlineTypoDefaults;
    }


    static public function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->setup();
    }

    private function __clone()
    {
    }


    private function setup()
    {
        $this->setHeadlineTypoDefaults(array(
                'size' => '15px',
                'face' => 'georgia',
                'style' => 'bold',
                'color' => '#bada55')
        );
    }


    public function optionName()
    {
        // This gets the theme name from the stylesheet (lowercase and without spaces)
        $themename = get_option('stylesheet');
        $themename = preg_replace("/\W/", "_", strtolower($themename));

        $optionsframework_settings = get_option('optionsframework');
        $optionsframework_settings['id'] = $themename;
        update_option('optionsframework', $optionsframework_settings);
    }

    public function options()
    {

        $options = array();

        $options[] = array(
            'name' => 'Allgemein',
            'type' => 'heading');

        $options[] = array(
            'name' => 'Kopfzeile',
            'desc' => 'Beschreibung',
            'type' => 'info');

        $options[] = array(
            'name' => 'Hintergrundfarbe',
            'desc' => __('No color selected by default.', 'options_check'),
            'id' => 'example_colorpicker',
            'std' => '',
            'type' => 'color' );

        $options[] = array(
            'name' => 'Überschriften',
            'desc' => 'Stellen Sie die Schriften für Überschriften ein.',
            'id' => "headlines",
            'std' => $this->getHeadlineTypoDefaults(),
            'type' => 'typography');

        $options[] = array(
            'name' => 'Fusszeile',
            'type' => 'heading');

        $wp_editor_settings = array(
            'wpautop' => true, // Default
            'textarea_rows' => 5,
            'tinymce' => array('plugins' => 'wordpress')
        );

        $options[] = array(
            'name' => __('Default Text Editor', 'options_check'),
            'desc' => sprintf(__('You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_check'), 'http://codex.wordpress.org/Function_Reference/wp_editor'),
            'id' => 'example_editor',
            'type' => 'editor',
            'settings' => $wp_editor_settings);

        return $options;
    }
}

$gastroThemeOptions = GastroThemeOptions::getInstance();

function optionsframework_option_name()
{
    $gastro = GastroThemeOptions::getInstance();
    return $gastro->optionName();
}

function optionsframework_options()
{
    $gastro = GastroThemeOptions::getInstance();
    return $gastro->options();
}