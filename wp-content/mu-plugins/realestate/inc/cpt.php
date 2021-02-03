<?php
add_action( 'init', 'res_cpt_real', 0 );
add_action( 'init', 'res_cpt_location' );
add_action( 'init', 'res_tax_est_type', 0 );

function res_cpt_real() {

	$labels = array(
		'name'                  => _x( 'Недвижимость', 'Post Type General Name', 'realestate' ),
		'singular_name'         => _x( 'Объект', 'Post Type Singular Name', 'realestate' ),
		'menu_name'             => __( 'Недвижимость', 'realestate' ),
		'name_admin_bar'        => __( 'Недвижимость', 'realestate' ),
		'archives'              => __( 'Объекты', 'realestate' ),
		'attributes'            => __( 'Item Attributes', 'realestate' ),
		'parent_item_colon'     => __( 'Parent Item:', 'realestate' ),
		'all_items'             => __( 'Все объекты', 'realestate' ),
		'add_new_item'          => __( 'Добавить новый объект', 'realestate' ),
		'add_new'               => __( 'Добавить', 'realestate' ),
		'new_item'              => __( 'Новый', 'realestate' ),
		'edit_item'             => __( 'Ред. объект', 'realestate' ),
		'update_item'           => __( 'Обновить', 'realestate' ),
		'view_item'             => __( 'Смотреть', 'realestate' ),
		'view_items'            => __( 'Смотреть', 'realestate' ),
		'search_items'          => __( 'Искать', 'realestate' ),
		'not_found'             => __( 'Не найдено', 'realestate' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'realestate' ),
		'featured_image'        => __( 'Изображение объекта', 'realestate' ),
		'set_featured_image'    => __( 'Установить изображение', 'realestate' ),
		'remove_featured_image' => __( 'Удалить изображение', 'realestate' ),
		'use_featured_image'    => __( 'Использовать как изобр. объекта', 'realestate' ),
		'insert_into_item'      => __( 'Вставить в объект', 'realestate' ),
		'uploaded_to_this_item' => __( 'Загружено для этого объекта', 'realestate' ),
		'items_list'            => __( 'Список объектов', 'realestate' ),
		'items_list_navigation' => __( 'Список объектов', 'realestate' ),
		'filter_items_list'     => __( 'Фильтр списка объектов', 'realestate' ),
	);
	$capabilities = array(
		'edit_post'             => 'edit_estate',
		'read_post'             => 'read_estate',
		'delete_post'           => 'delete_estate',
		'edit_posts'            => 'edit_estates',
		'edit_others_posts'     => 'edit_others_estates',
		'publish_posts'         => 'publish_estate',
		'read_private_posts'    => 'read_private_estate',
	);
	$args = array(
		'label'                 => __( 'Объект', 'realestate' ),
		'description'           => __( 'Объекты недвижимости', 'realestate' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'est_type' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-multisite',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capabilities'          => $capabilities,
	);
	register_post_type( 'estate', $args );
}

function res_cpt_location() {

	$labels = array(
		'name'                  => _x( 'Города', 'Post Type General Name', 'realestate' ),
		'singular_name'         => _x( 'Город', 'Post Type Singular Name', 'realestate' ),
		'menu_name'             => __( 'Города', 'realestate' ),
		'name_admin_bar'        => __( 'Города', 'realestate' ),
		'archives'              => __( 'Города', 'realestate' ),
		'attributes'            => __( 'Item Attributes', 'realestate' ),
		'parent_item_colon'     => __( 'Parent Item:', 'realestate' ),
		'all_items'             => __( 'Все города', 'realestate' ),
		'add_new_item'          => __( 'Добавить новый город', 'realestate' ),
		'add_new'               => __( 'Добавить', 'realestate' ),
		'new_item'              => __( 'Новый', 'realestate' ),
		'edit_item'             => __( 'Ред. город', 'realestate' ),
		'update_item'           => __( 'Обновить', 'realestate' ),
		'view_item'             => __( 'Смотреть', 'realestate' ),
		'view_items'            => __( 'Смотреть', 'realestate' ),
		'search_items'          => __( 'Искать', 'realestate' ),
		'not_found'             => __( 'Не найдено', 'realestate' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'realestate' ),
		'featured_image'        => __( 'Изображение города', 'realestate' ),
		'set_featured_image'    => __( 'Установить изображение', 'realestate' ),
		'remove_featured_image' => __( 'Удалить изображение', 'realestate' ),
		'use_featured_image'    => __( 'Использовать как изобр. города', 'realestate' ),
		'insert_into_item'      => __( 'Вставить в объект', 'realestate' ),
		'uploaded_to_this_item' => __( 'Загружено для этого объекта', 'realestate' ),
		'items_list'            => __( 'Список городов', 'realestate' ),
		'items_list_navigation' => __( 'Список городов', 'realestate' ),
		'filter_items_list'     => __( 'Фильтр списка городов', 'realestate' ),
	);
	$capabilities = array(
		'edit_post'             => 'edit_location',
		'read_post'             => 'read_location',
		'delete_post'           => 'delete_location',
		'edit_posts'            => 'edit_location',
		'edit_others_posts'     => 'edit_others_location',
		'publish_posts'         => 'publish_location',
		'read_private_posts'    => 'read_private_location',
	);
	$args = array(
		'label'                 => __( 'Город', 'realestate' ),
		'description'           => __( 'Города объектов', 'realestate' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'est_type' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-location',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capabilities'          => $capabilities,
	);
	register_post_type( 'location', $args );
}


// Register Custom Taxonomy
function res_tax_est_type() {

	$labels = array(
		'name'                       => _x( 'Типы', 'Taxonomy General Name', 'realestate' ),
		'singular_name'              => _x( 'Тип', 'Taxonomy Singular Name', 'realestate' ),
		'menu_name'                  => __( 'Типы', 'realestate' ),
		'all_items'                  => __( 'Все типы', 'realestate' ),
		'parent_item'                => __( 'Родительский тип', 'realestate' ),
		'parent_item_colon'          => __( 'Родительский тип', 'realestate' ),
		'new_item_name'              => __( 'Имя нового типа', 'realestate' ),
		'add_new_item'               => __( 'Добавить новый тип', 'realestate' ),
		'edit_item'                  => __( 'Ред. тип', 'realestate' ),
		'update_item'                => __( 'Обновить', 'realestate' ),
		'view_item'                  => __( 'Смотреть', 'realestate' ),
		'separate_items_with_commas' => __( 'Разделяя запятыми', 'realestate' ),
		'add_or_remove_items'        => __( 'Добавить/удалить типы', 'realestate' ),
		'choose_from_most_used'      => __( 'Выбрать из популярных', 'realestate' ),
		'popular_items'              => __( 'Популярные типы', 'realestate' ),
		'search_items'               => __( 'Искать типы', 'realestate' ),
		'not_found'                  => __( 'Не найдено', 'realestate' ),
		'no_terms'                   => __( 'Нет типов', 'realestate' ),
		'items_list'                 => __( 'Список типов', 'realestate' ),
		'items_list_navigation'      => __( 'Список типов', 'realestate' ),
	);
	$capabilities = array(
		'manage_terms'               => 'manage_est_type',
		'edit_terms'                 => 'edit_est_type',
		'delete_terms'               => 'manage_est_type',
		'assign_terms'               => 'edit_est_type',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_in_menu'               => true,
		'show_tagcloud'              => true,
		//'capabilities'               => $capabilities,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'est_type', array( 'estate' ), $args );
}
