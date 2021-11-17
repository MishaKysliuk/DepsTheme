<?php 

// taxonomy Casino Types
add_action( 'init', 'create_casino_types_taxonomy');
function create_casino_types_taxonomy() {

  $labels = array(
    'name' => _x( 'Casino Types', '' ),
    'singular_name' => __( 'Casino Types' ),
    'search_items' =>  __( 'Search Casino Type' ),
    'all_items' => __( 'All Casino Types' ),
    'parent_item' => __( 'Parent Casino Type' ),
    'parent_item_colon' => __( 'Parent Casino Type:' ),
    'edit_item' => __( 'Edit Casino Type' ), 
    'update_item' => __( 'Update Casino Type' ),
    'add_new_item' => __( 'Add New Casino Type' ),
    'new_item_name' => __( 'New Casino Type Name' ),
    'menu_name' => __( 'Casino Types' ),
  ); 	

  register_taxonomy('casino-types', array('casinos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'with_front' => false ),
  ));
}

// taxonomy Payment Methods
add_action( 'init', 'create_payment_methods_taxonomy');
function create_payment_methods_taxonomy() {

  $labels = array(
    'name' => __( 'Payment Methods' ),
    'singular_name' => __( 'Payment Methods' ),
    'search_items' =>  __( 'Search Payment Method' ),
    'all_items' => __( 'All Payment Methods' ),
    'parent_item' => __( 'Parent Payment Method' ),
    'parent_item_colon' => __( 'Parent Payment Method:' ),
    'edit_item' => __( 'Edit Payment Method' ), 
    'update_item' => __( 'Update Payment Method' ),
    'add_new_item' => __( 'Add New Payment Method' ),
    'new_item_name' => __( 'New Payment Method Name' ),
    'menu_name' => __( 'Payment Methods' ),
  ); 	
 
  register_taxonomy('payment-methods', array('casinos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'rewrite' => array( 'with_front' => false ),
  ));
}

// taxonomy Currencies
add_action( 'init', 'create_currencies_taxonomy');
function create_currencies_taxonomy() {

  $labels = array(
    'name' => __( 'Currencies' ),
    'singular_name' => __( 'Currencies' ),
    'search_items' =>  __( 'Search Currencies' ),
    'all_items' => __( 'All Currencies' ),
    'parent_item' => __( 'Parent Сurrency' ),
    'parent_item_colon' => __( 'Parent Сurrency:' ),
    'edit_item' => __( 'Edit Сurrency' ), 
    'update_item' => __( 'Update Сurrency' ),
    'add_new_item' => __( 'Add New Сurrency' ),
    'new_item_name' => __( 'New Сurrency Name' ),
    'menu_name' => __( 'Currencies' ),
  ); 	

  register_taxonomy('currencies', array('casinos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'rewrite' => array( 'with_front' => false ),
  ));
}

// taxonomy Minimum Deposit
add_action( 'init', 'create_minimum_deposit_taxonomy');
function create_minimum_deposit_taxonomy() {

  $labels = array(
    'name' => _x( 'Minimum Deposit', '' ),
    'singular_name' => __( 'Minimum Deposit' ),
    'search_items' =>  __( 'Search Minimum Deposit' ),
    'all_items' => __( 'All Minimum Deposit' ),
    'parent_item' => __( 'Parent Minimum Deposit' ),
    'parent_item_colon' => __( 'Parent Minimum Deposit:' ),
    'edit_item' => __( 'Edit Minimum Deposit' ), 
    'update_item' => __( 'Update Minimum Deposit' ),
    'add_new_item' => __( 'Add New Minimum Deposit' ),
    'new_item_name' => __( 'New Minimum Deposit Name' ),
    'menu_name' => __( 'Minimum Deposit' ),
  ); 	

  register_taxonomy('minimum-deposit', array('casinos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'rewrite' => array( 'with_front' => false ),
  ));
}

// taxonomy Casino Games
add_action( 'init', 'create_casino_games_taxonomy');
function create_casino_games_taxonomy() {

  $labels = array(
    'name' => __( 'Casino Games' ),
    'singular_name' => __( 'Casino Games' ),
    'search_items' =>  __( 'Search Casino Games' ),
    'all_items' => __( 'All Casino Games' ),
    'parent_item' => __( 'Parent Casino Games' ),
    'parent_item_colon' => __( 'Parent Casino Games:' ),
    'edit_item' => __( 'Edit Casino Games' ), 
    'update_item' => __( 'Update Casino Games' ),
    'add_new_item' => __( 'Add New Casino Games' ),
    'new_item_name' => __( 'New Casino Games Name' ),
  ); 	

  register_taxonomy('casino-games', array('casinos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'with_front' => false ),
  ));
}

// taxonomy Casino Softwares
add_action( 'init', 'create_casino_softwares_taxonomy');
function create_casino_softwares_taxonomy() {

  $labels = array(
    'name' => __( 'Casino Softwares' ),
    'singular_name' => __( 'Casino Softwares' ),
    'search_items' =>  __( 'Search Casino Softwares' ),
    'all_items' => __( 'All Casino Softwares' ),
    'parent_item' => __( 'Parent Casino Softwares' ),
    'parent_item_colon' => __( 'Parent Casino Softwares:' ),
    'edit_item' => __( 'Edit Casino Softwares' ), 
    'update_item' => __( 'Update Casino Softwares' ),
    'add_new_item' => __( 'Add New Casino Softwares' ),
    'new_item_name' => __( 'New Casino Softwares Name' ),
  ); 	

  register_taxonomy('casino-softwares', array('casinos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'rewrite' => array( 'with_front' => false ),
  ));
}

// taxonomy Licenses
add_action( 'init', 'create_licenses_taxonomy');
function create_licenses_taxonomy() {

  $labels = array(
    'name' => __( 'Licenses' ),
    'singular_name' => __( 'Licenses' ),
    'search_items' =>  __( 'Search Licenses' ),
    'all_items' => __( 'All Licenses' ),
    'parent_item' => __( 'Parent Licenses' ),
    'parent_item_colon' => __( 'Parent Licenses:' ),
    'edit_item' => __( 'Edit Licenses' ), 
    'update_item' => __( 'Update Licenses' ),
    'add_new_item' => __( 'Add New Licenses' ),
    'new_item_name' => __( 'New Licenses Name' ),
  ); 	

  register_taxonomy('licenses', array('casinos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'rewrite' => array( 'with_front' => false ),
  ));
}

// taxonomy Owners
add_action( 'init', 'create_owners_taxonomy');
function create_owners_taxonomy() {

  $labels = array(
    'name' => __( 'Owners' ),
    'singular_name' => __( 'Owners' ),
    'search_items' =>  __( 'Search Owners' ),
    'all_items' => __( 'All Owners' ),
    'parent_item' => __( 'Parent Owners' ),
    'parent_item_colon' => __( 'Parent Owners:' ),
    'edit_item' => __( 'Edit Owners' ), 
    'update_item' => __( 'Update Owners' ),
    'add_new_item' => __( 'Add New Owners' ),
    'new_item_name' => __( 'New Owners Name' ),
  ); 	

  register_taxonomy('owners', array('casinos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'rewrite' => array( 'with_front' => false ),
  ));
}


// taxonomy Main Bonus Types
add_action( 'init', 'create_main_bonus_types_taxonomy');
function create_main_bonus_types_taxonomy() {

  $labels = array(
    'name' => __( 'Main Bonus Types' ),
    'singular_name' => __( 'Main Bonus Types' ),
    'search_items' =>  __( 'Search Main Bonus Types' ),
    'all_items' => __( 'All Main Bonus Types' ),
    'parent_item' => __( 'Parent Main Bonus Types' ),
    'parent_item_colon' => __( 'Parent Main Bonus Types:' ),
    'edit_item' => __( 'Edit Main Bonus Types' ), 
    'update_item' => __( 'Update Main Bonus Types' ),
    'add_new_item' => __( 'Add New Main Bonus Types' ),
    'new_item_name' => __( 'New Main Bonus Types Name' ),
  ); 	

  register_taxonomy('main_bonus_types', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}

// taxonomy Welcome Match Bonuses
add_action( 'init', 'create_welcome_match_bonuses_taxonomy');
function create_welcome_match_bonuses_taxonomy() {

  $labels = array(
    'name' => __( 'Welcome Match Bonuses' ),
    'singular_name' => __( 'Welcome Match Bonuses' ),
    'search_items' =>  __( 'Search Welcome Match Bonuses' ),
    'all_items' => __( 'All Welcome Match Bonuses' ),
    'parent_item' => __( 'Parent Welcome Match Bonuses' ),
    'parent_item_colon' => __( 'Parent Welcome Match Bonuses:' ),
    'edit_item' => __( 'Edit Welcome Match Bonuses' ), 
    'update_item' => __( 'Update Welcome Match Bonuses' ),
    'add_new_item' => __( 'Add New Welcome Match Bonuses' ),
    'new_item_name' => __( 'New Welcome Match Bonuses Name' ),
  ); 	

  register_taxonomy('welcome-match-bonuses', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
		'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}

// taxonomy No Deposit Bonuses
add_action( 'init', 'create_no_deposit_bonuses_taxonomy');
function create_no_deposit_bonuses_taxonomy() {

  $labels = array(
    'name' => __( 'No Deposit Bonuses' ),
    'singular_name' => __( 'No Deposit Bonuses' ),
    'search_items' =>  __( 'Search No Deposit Bonuses' ),
    'all_items' => __( 'All No Deposit Bonuses' ),
    'parent_item' => __( 'Parent No Deposit Bonuses' ),
    'parent_item_colon' => __( 'Parent No Deposit Bonuses:' ),
    'edit_item' => __( 'Edit No Deposit Bonuses' ), 
    'update_item' => __( 'Update No Deposit Bonuses' ),
    'add_new_item' => __( 'Add New No Deposit Bonuses' ),
    'new_item_name' => __( 'New No Deposit Bonuses Name' ),
  ); 	

  register_taxonomy('no-deposit-bonuses', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}

// taxonomy Free Spins Bonuses
add_action( 'init', 'create_free_spins_bonuses_taxonomy');
function create_free_spins_bonuses_taxonomy() {

  $labels = array(
    'name' => __( 'Free Spins Bonuses' ),
    'singular_name' => __( 'Free Spins Bonuses' ),
    'search_items' =>  __( 'Search Free Spins Bonuses' ),
    'all_items' => __( 'All Free Spins Bonuses' ),
    'parent_item' => __( 'Parent Free Spins Bonuses' ),
    'parent_item_colon' => __( 'Parent Free Spins Bonuses:' ),
    'edit_item' => __( 'Edit Free Spins Bonuses' ), 
    'update_item' => __( 'Update Free Spins Bonuses' ),
    'add_new_item' => __( 'Add New Free Spins Bonuses' ),
    'new_item_name' => __( 'New Free Spins Bonuses Name' ),
  ); 	

  register_taxonomy('free-spins-bonuses', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}

// taxonomy Minimum Deposit Bonuses
add_action( 'init', 'create_minimum_deposit_bonuses_taxonomy');
function create_minimum_deposit_bonuses_taxonomy() {

  $labels = array(
    'name' => __( 'Minimum Deposit Bonuses' ),
    'singular_name' => __( 'Minimum Deposit Bonuses' ),
    'search_items' =>  __( 'Search Minimum Deposit Bonuses' ),
    'all_items' => __( 'All Minimum Deposit Bonuses' ),
    'parent_item' => __( 'Parent Minimum Deposit Bonuses' ),
    'parent_item_colon' => __( 'Parent Minimum Deposit Bonuses:' ),
    'edit_item' => __( 'Edit Minimum Deposit Bonuses' ), 
    'update_item' => __( 'Update Minimum Deposit Bonuses' ),
    'add_new_item' => __( 'Add New Minimum Deposit Bonuses' ),
    'new_item_name' => __( 'New Minimum Deposit Bonuses Name' ),
  ); 	

  register_taxonomy('minimum-deposit-bonuses', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}

// taxonomy Software Bonuses
add_action( 'init', 'create_software_bonuses_bonuses_taxonomy');
function create_software_bonuses_bonuses_taxonomy() {

  $labels = array(
    'name' => __( 'Software Bonuses' ),
    'singular_name' => __( 'Software Bonuses' ),
    'search_items' =>  __( 'Search Software Bonuses' ),
    'all_items' => __( 'All Software Bonuses' ),
    'parent_item' => __( 'Parent Software Bonuses' ),
    'parent_item_colon' => __( 'Parent Software Bonuses:' ),
    'edit_item' => __( 'Edit Software Bonuses' ), 
    'update_item' => __( 'Update Software Bonuses' ),
    'add_new_item' => __( 'Add New Software Bonuses' ),
    'new_item_name' => __( 'New Software Bonuses Name' ),
  ); 	

  register_taxonomy('software-bonuses', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}

// taxonomy Game Bonuses
add_action( 'init', 'create_game_bonuses_bonuses_taxonomy');
function create_game_bonuses_bonuses_taxonomy() {

  $labels = array(
    'name' => __( 'Game Bonuses' ),
    'singular_name' => __( 'Game Bonuses' ),
    'search_items' =>  __( 'Search Game Bonuses' ),
    'all_items' => __( 'All Game Bonuses' ),
    'parent_item' => __( 'Parent Game Bonuses' ),
    'parent_item_colon' => __( 'Parent Game Bonuses:' ),
    'edit_item' => __( 'Edit Game Bonuses' ), 
    'update_item' => __( 'Update Game Bonuses' ),
    'add_new_item' => __( 'Add New Game Bonuses' ),
    'new_item_name' => __( 'New Game Bonuses Name' ),
  ); 	

  register_taxonomy('game-bonuses', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}

// taxonomy Pokies Bonuses
add_action( 'init', 'create_pokies_bonuses_taxonomy');
function create_pokies_bonuses_taxonomy() {

  $labels = array(
    'name' => __( 'Pokies Bonuses' ),
    'singular_name' => __( 'Pokies Bonuses' ),
    'search_items' =>  __( 'Search Pokies Bonuses' ),
    'all_items' => __( 'All Pokies Bonuses' ),
    'parent_item' => __( 'Parent Pokies Bonuses' ),
    'parent_item_colon' => __( 'Parent Pokies Bonuses:' ),
    'edit_item' => __( 'Edit Pokies Bonuses' ), 
    'update_item' => __( 'Update Pokies Bonuses' ),
    'add_new_item' => __( 'Add New Pokies Bonuses' ),
    'new_item_name' => __( 'New Pokies Bonuses Name' ),
  ); 	

  register_taxonomy('pokies-bonuses', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}

// taxonomy Wagering Requirements
add_action( 'init', 'create_wagering_requirements_taxonomy');
function create_wagering_requirements_taxonomy() {

  $labels = array(
    'name' => __( 'Wagering Requirements' ),
    'singular_name' => __( 'Wagering Requirements' ),
    'search_items' =>  __( 'Search Wagering Requirements' ),
    'all_items' => __( 'All Wagering Requirements' ),
    'parent_item' => __( 'Parent Wagering Requirements' ),
    'parent_item_colon' => __( 'Parent Wagering Requirements:' ),
    'edit_item' => __( 'Edit Wagering Requirements' ), 
    'update_item' => __( 'Update Wagering Requirements' ),
    'add_new_item' => __( 'Add New Wagering Requirements' ),
    'new_item_name' => __( 'New Wagering Requirements Name' ),
  ); 	

  register_taxonomy('wagering-requirements', array('casino-bonuses'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 
      'slug' => 'best-casino-bonuses',
      'with_front' => true,
    ),
  ));
}
