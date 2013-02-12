<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Piwi
 * Date: 08.02.13
 * Time: 22:54
 * To change this template use File | Settings | File Templates.
 */

class GastroPostType
{
    private $postType = 'meals';
    private $taxonomy = 'course';
    private $postLabels = array();
    private $postArgs = array();
    private $taxonomyLabels = array();
    private $taxonomyArgs = array();

    public function setPostType($postType)
    {
        $this->postType = $postType;
    }

    public function getPostType()
    {
        return $this->postType;
    }

    public function setPostArgs($args)
    {
        $this->postArgs = $args;
    }

    public function getPostArgs()
    {
        return $this->postArgs;
    }

    public function setPostLabels($labels)
    {
        $this->postLabels = $labels;
    }

    public function getPostLabels()
    {
        return $this->postLabels;
    }

    public function setTaxonomyArgs($taxonomyArgs)
    {
        $this->taxonomyArgs = $taxonomyArgs;
    }

    public function getTaxonomyArgs()
    {
        return $this->taxonomyArgs;
    }

    public function setTaxonomyLabels($taxonomyLabels)
    {
        $this->taxonomyLabels = $taxonomyLabels;
    }

    public function getTaxonomyLabels()
    {
        return $this->taxonomyLabels;
    }

    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    public function getTaxonomy()
    {
        return $this->taxonomy;
    }


    function __construct()
    {
        $this->labels();
        $this->args();
        $this->createPostType();
    }


    private function createPostType()
    {
        register_post_type($this->getPostType(), $this->getPostArgs());
        register_taxonomy($this->getTaxonomy(), $this->getPostType(), $this->getTaxonomyArgs());
    }

    private function labels()
    {
        $this->setPostLabels(array(
            'name' => __('posttype.name', 'gastro'),
            'singular_name' => __('posttype.singular_name', 'gastro'),
            'add_new' => __('posttype.add_new', 'gastro'),
            'add_new_item' => __('posttype.add_new_item', 'gastro'),
            'edit_item' => __('posttype.edit_item', 'gastro'),
            'new_item' => __('posttype.new_item', 'gastro'),
            'all_items' => __('posttype.all_items', 'gastro'),
            'view_item' => __('posttype.view_item', 'gastro'),
            'search_items' => __('posttype.search_items', 'gastro'),
            'not_found' => __('posttype.not_found', 'gastro'),
            'not_found_in_trash' => __('posttype.not_found_in_trash', 'gastro'),
            'parent_item_colon' => '',
            'menu_name' => __('posttype.menu', 'gastro')
        ));

        $this->setTaxonomyLabels(array(
            'name' => __('taxonomy.name', 'gastro'),
            'singular_name' => __('taxonomy.singluar_name', 'gastro'),
            'search_items' => __('taxonomy.search_items', 'gastro'),
            'all_items' => __('taxonomy.all_items', 'gastro'),
            'parent_item' => __('taxonomy.parent_items', 'gastro'),
            'parent_item_colon' => __('taxonomy.parent_item_colon', 'gastro'),
            'edit_item' => __('taxonomy.edit_item', 'gastro'),
            'update_item' => __('taxonomy.update_item', 'gastro'),
            'add_new_item' => __('taxonomy.add_new_item', 'gastro'),
            'new_item_name' => __('taxonomy.new_item_name', 'gastro'),
            'menu_name' => 'test'
        ));
    }

    private function args()
    {
        $this->setTaxonomyArgs(array(
            'labels' => array(
                'name' => __('taxonomy.name', 'gastro'),
                'singular_name' => __('taxonomy.singluar_name', 'gastro'),
                'search_items' => __('taxonomy.search_items', 'gastro'),
                'all_items' => __('taxonomy.all_items', 'gastro'),
                'parent_item' => __('taxonomy.parent_items', 'gastro'),
                'parent_item_colon' => __('taxonomy.parent_item_colon', 'gastro'),
                'edit_item' => __('taxonomy.edit_item', 'gastro'),
                'update_item' => __('taxonomy.update_item', 'gastro'),
                'add_new_item' => __('taxonomy.add_new_item', 'gastro'),
                'new_item_name' => __('taxonomy.new_item_name', 'gastro'),
                'menu_name' => __('taxonomy.menu', 'gastro')
            ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => false,
        ));

        $this->setPostArgs(array(
            'labels' => $this->getPostLabels(),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => false,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            //'menu_icon' => plugins_url( 'images/image.png', __FILE__ ,
            'taxonomies' => array($this->getTaxonomy()),
            'supports' => array(
                'title',
                'editor',
                'thumbnail'
            )
        ));
    }

}

$GastroPostType = new GastroPostType();