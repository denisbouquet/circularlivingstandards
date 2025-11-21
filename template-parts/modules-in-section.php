<?php 
while (have_rows('content')) {
	the_row();
	if (get_row_layout() == "copy") {
		$wysiwyg = get_sub_field('copy');
		echo $wysiwyg;
	}

	elseif (get_row_layout() == "title") {
		include(locate_template('template-parts/cpt-title.php'));
	}

	elseif (get_row_layout() == "cta") {
		include(locate_template('template-parts/cpt-cta.php'));
	}

	elseif (get_row_layout() == "short_text") {
		include(locate_template('template-parts/cpt-short-text.php'));
	}

	elseif (get_row_layout() == "wysiwyg") {
		include(locate_template('template-parts/cpt-wysiwyg.php'));
	}

	elseif (get_row_layout() == "video") {
		include(locate_template('template-parts/cpt-video.php'));
	}

	elseif (get_row_layout() == "image") {
		include(locate_template('template-parts/cpt-image.php'));
	}

	elseif (get_row_layout() == "logo_list") {
		include(locate_template('template-parts/cpt-logo-list.php'));
	}

	elseif (get_row_layout() == "stat") {
		include(locate_template('template-parts/cpt-stat.php'));
	}

	
}
?>