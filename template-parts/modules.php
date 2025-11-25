<?php 
while (have_rows('modules')) {
	the_row();
	
	
	if (get_row_layout() == "faq") {
		

		include(locate_template('template-parts/cpt-faq.php'));

		// unset($title, $shortcode);
	}

	elseif (get_row_layout() == "page_hero") {

		include(locate_template('template-parts/cpt-page-hero.php'));
	}

	elseif (get_row_layout() == "form") {
		include(locate_template('template-parts/cpt-form.php'));
	}

	elseif (get_row_layout() == "form") {
		include(locate_template('template-parts/cpt-form.php'));
	}

	elseif (get_row_layout() == "section") {
		include(locate_template('template-parts/cpt-section.php'));
	}

	elseif (get_row_layout() == "standards_list") {
		include(locate_template('template-parts/cpt-standard-list.php'));
	}
	
	elseif (get_row_layout() == "how_to_get_certified") {
		include(locate_template('template-parts/cpt-how-to-get-certified.php'));
	}

	elseif (get_row_layout() == "ways_to_get_involved") {
		include(locate_template('template-parts/cpt-ways-to-get-involved.php'));
	}

	elseif (get_row_layout() == "eligible_products") {
		include(locate_template('template-parts/cpt-eligible-products.php'));
	}

	elseif (get_row_layout() == "single_card") {
		include(locate_template('template-parts/cpt-single-card.php'));
	}

	elseif (get_row_layout() == "related_standards") {
		include(locate_template('template-parts/cpt-related-standards.php'));
	}



}
?>