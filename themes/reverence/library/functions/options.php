<?php

/** Reverence Options Page **/

$theme_name = 'Reverence';
$shortname = 'al';
$theme_version = '1.1';
$path = get_stylesheet_directory_uri();
$styles = array();
$background_options = array();
$skins = array();

if (is_dir(TEMPLATEPATH . "/css/")) {
	if ($open_dir = opendir(TEMPLATEPATH . "/css/")) {
		while (($style = readdir($open_dir)) !== false) {
			if (stristr($style, ".css") !== false) {
				$styles[] = $style;
			}
		}
	}
}


$html_desc = 'Enter HTML text';
$html_desc_p = 'Enter HTML text NOTE: Text must be between "p" tags';
$text_desc = 'Enter text';
$long_text = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et dignissim ipsum. Nam ac interdum sem. Pellentesque diam lacus, dictum in dapibus id, hendrerit eget felis. Nunc nec turpis libero</p>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas euismod condimentum mollis. In non congue orci. Nulla nunc velit, volutpat vestibulum congue vitae, tincidunt at sem. Pellentesque tincidunt molestie mi, eu aliquam quam fringilla nec. Sed suscipit adipiscing urna, et varius libero commodo eget.</p>';

$upload_desc = 'Upload image for your theme, or specify an existing url';

// Array added for 3D Rotator
$tween_types = array(
	array("value"=>"linear", "text"=>"linear"),
	array("value"=>"easeInSine", "text"=>"easeInSine"),
	array("value"=>"easeInSine", "text"=>"easeInSine"),
	array("value"=>"easeInOutSine", "text"=>"easeInOutSine"),
	array("value"=>"easeInCubic", "text"=>"easeInCubic"), 
	array("value"=>"easeOutCubic", "text"=>"easeOutCubic"),
	array("value"=>"easeInOutCubic", "text"=>"easeInOutCubic"), 
	array("value"=>"easeOutInCubic", "text"=>"easeOutInCubic"), 
	array("value"=>"easeInQuint", "text"=>"easeInQuint"), 
	array("value"=>"easeOutQuint", "text"=>"easeOutQuint"),
	array("value"=>"easeInOutQuint", "text"=>"easeInOutQuint"),
	array("value"=>"easeOutInQuint", "text"=>"easeOutInQuint"),
	array("value"=>"easeInCirc", "text"=>"easeInCirc"),
	array("value"=>"easeOutCirc", "text"=>"easeOutCirc"), 
	array("value"=>"easeInOutCirc", "text"=>"easeInOutCirc"),
	array("value"=>"easeOutInCirc", "text"=>"easeOutInCirc"),
	array("value"=>"easeInBack", "text"=>"easeInBack"), 
	array("value"=>"easeOutBack", "text"=>"easeOutBack"), 
	array("value"=>"easeInOutBack", "text"=>"easeInOutBack"), 
	array("value"=>"easeOutInBack", "text"=>"easeOutInBack"),
	array("value"=>"easeInQuad", "text"=>"easeInQuad"),
	array("value"=>"easeOutQuad", "text"=>"easeOutQuad"),
	array("value"=>"easeInOutQuad", "text"=>"easeInOutQuad"),
	array("value"=>"easeOutInQuad", "text"=>"easeOutInQuad"), 
	array("value"=>"easeInQuart", "text"=>"easeInQuart"), 
	array("value"=>"easeOutQuart", "text"=>"easeOutQuart"),
	array("value"=>"easeInOutQuart", "text"=>"easeInOutQuart"), 
	array("value"=>"easeOutInQuart", "text"=>"easeOutInQuart"),
	array("value"=>"easeInExpo", "text"=>"easeInExpo"), 
	array("value"=>"easeOutExpo", "text"=>"easeOutExpo"), 
	array("value"=>"easeInOutExpo", "text"=>"easeInOutExpo"),
	array("value"=>"easeOutInExpo", "text"=>"easeOutInExpo"),
	array("value"=>"easeInElastic", "text"=>"easeInElastic"), 
	array("value"=>"easeOutElastic", "text"=>"easeOutElastic"), 
	array("value"=>"easeInOutElastic", "text"=>"easeInOutElastic"), 
	array("value"=>"easeOutInElastic", "text"=>"easeOutInElastic"), 
	array("value"=>"easeInBounce", "text"=>"easeInBounce"), 
	array("value"=>"easeOutBounce", "text"=>"easeOutBounce"),
	array("value"=>"easeInOutBounce", "text"=>"easeInOutBounce"),
	array("value"=>"easeOutInBounce", "text"=>"easeOutInBounce")
);

$fonts = array(
	array('value'=>'off', 'text'=>'None / Default'),
	array('value'=>'Abel', 'text'=>'Abel'),
	array('value'=>'Abril Fatface', 'text'=>'Abril Fatface'),
	array('value'=>'Aclonica', 'text'=>'Aclonica'),
	array('value'=>'Acme', 'text'=>'Acme'),
	array('value'=>'Actor', 'text'=>'Actor'),
	array('value'=>'Adamina', 'text'=>'Adamina'),
	array('value'=>'Advent Pro', 'text'=>'Advent Pro'),
	array('value'=>'Aguafina Script', 'text'=>'Aguafina Script'),
	array('value'=>'Aladin', 'text'=>'Aladin'),
	array('value'=>'Aldrich', 'text'=>'Aldrich'),
	array('value'=>'Alegreya', 'text'=>'Alegreya'),
	array('value'=>'Alegreya SC', 'text'=>'Alegreya SC'),
	array('value'=>'Alex Brush', 'text'=>'Alex Brush'),
	array('value'=>'Alfa Slab One', 'text'=>'Alfa Slab One'),
	array('value'=>'Alice', 'text'=>'Alice'),
	array('value'=>'Alike', 'text'=>'Alike'),
	array('value'=>'Alike Angular', 'text'=>'Alike Angular'),
	array('value'=>'Allan', 'text'=>'Allan'),
	array('value'=>'Allerta', 'text'=>'Allerta'),
	array('value'=>'Allerta Stencil', 'text'=>'Allerta Stencil'),
	array('value'=>'Allura', 'text'=>'Allura'),
	array('value'=>'Almendra', 'text'=>'Almendra'),
	array('value'=>'Almendra SC', 'text'=>'Almendra SC'),
	array('value'=>'Amaranth', 'text'=>'Amaranth'),
	array('value'=>'Amatic SC', 'text'=>'Amatic SC'),
	array('value'=>'Amethysta', 'text'=>'Amethysta'),
	array('value'=>'Andada', 'text'=>'Andada'),
	array('value'=>'Andika', 'text'=>'Andika'),
	array('value'=>'Annie Use Your Telescope', 'text'=>'Annie Use Your Telescope'),
	array('value'=>'Anonymous Pro', 'text'=>'Anonymous Pro'),
	array('value'=>'Antik', 'text'=>'Antik'),
	array('value'=>'Antic Didone', 'text'=>'Antic Didone'),
	array('value'=>'Antic Slab', 'text'=>'Antic Slab'),
	array('value'=>'Anton', 'text'=>'Anton'),
	array('value'=>'Arapey', 'text'=>'Arapey'),
	array('value'=>'Arbutus', 'text'=>'Arbutus'),
	array('value'=>'Architects Daughter', 'text'=>'Architects Daughter'),
	array('value'=>'Arimo', 'text'=>'Arimo'),
	array('value'=>'Arimo:regular,italic,bold,bolditalic', 'text'=>'Arimo (plus italic, bold, and bold italic)'),
	array('value'=>'Arizonia', 'text'=>'Arizonia'),
	array('value'=>'Armata', 'text'=>'Armata'),
	array('value'=>'Artifika', 'text'=>'Artifika'),
	array('value'=>'Arvo', 'text'=>'Arvo'),
	array('value'=>'Arvo:regular,italic,bold,bolditalic', 'text'=>'Arvo (plus italic, bold, and bold italic)'),
	array('value'=>'Asap', 'text'=>'Asap'),
	array('value'=>'Asset', 'text'=>'Asset'),
	array('value'=>'Astloch', 'text'=>'Astloch'),
	array('value'=>'Astloch:regular,bold', 'text'=>'Astloch (plus bold)'),
	array('value'=>'Asul', 'text'=>'Asul'),
	array('value'=>'Atomic Age', 'text'=>'Atomic Age'),
	array('value'=>'Aubrey', 'text'=>'Aubrey'),
	array('value'=>'Audiowide', 'text'=>'Audiowide'),
	array('value'=>'Average', 'text'=>'Average'),
	array('value'=>'Averia Gruesa Libre', 'text'=>'Averia Gruesa Libre'),
	array('value'=>'Averia Libre', 'text'=>'Averia Libre'),
	array('value'=>'Averia Sans Libre', 'text'=>'Averia Sans Libre'),
	array('value'=>'Averia Serif Libre', 'text'=>'Averia Serif Libre'),
	array('value'=>'Bad Script', 'text'=>'Bad Script'),
	array('value'=>'Balthazar', 'text'=>'Balthazar'),
	array('value'=>'Bangers', 'text'=>'Bangers'),
	array('value'=>'Basic', 'text'=>'Basic'),
	array('value'=>'Baumans', 'text'=>'Baumans'),
	array('value'=>'Belgrano', 'text'=>'Belgrano'),
	array('value'=>'Belleza', 'text'=>'Belleza'),
	array('value'=>'Bentham', 'text'=>'Bentham'),
	array('value'=>'Berkshire Swash', 'text'=>'Berkshire Swash'),
	array('value'=>'Bevan', 'text'=>'Bevan'),
	array('value'=>'Bigshot One', 'text'=>'Bigshot One'),	
	array('value'=>'Bilbo', 'text'=>'Bilbo'),
	array('value'=>'Bilbo Swash Caps', 'text'=>'Bilbo Swash Caps'),
	array('value'=>'Bitter', 'text'=>'Bitter'),
	array('value'=>'Black Ops One', 'text'=>'Black Ops One'),
	array('value'=>'Bonbon', 'text'=>'Bonbon'),
	array('value'=>'Boogaloo', 'text'=>'Boogaloo'),
	array('value'=>'Bowlby One', 'text'=>'Bowlby One'),
	array('value'=>'Bowlby One SC', 'text'=>'Bowlby One SC'),
	array('value'=>'Brawler', 'text'=>'Brawler'),	
	array('value'=>'Bree Serif', 'text'=>'Bree Serif'),
	array('value'=>'Bubblegum Sans', 'text'=>'Bubblegum Sans'),
	array('value'=>'Buda:light', 'text'=>'Buda'),
	array('value'=>'Buenard', 'text'=>'Buenard'),
	array('value'=>'Butcherman', 'text'=>'Butcherman'),
	array('value'=>'Butterfly Kids', 'text'=>'Butterfly Kids'),	
	array('value'=>'Cabin', 'text'=>'Cabin'),
	array('value'=>'Cabin:regular,500,600,bold', 'text'=>'Cabin (plus 500, 600, and bold)'),
	array('value'=>'Cabin Sketch:bold', 'text'=>'Cabin Sketch'),
	array('value'=>'Caesar Dressing', 'text'=>'Caesar Dressing'),
	array('value'=>'Cagliostro', 'text'=>'Cagliostro'),
	array('value'=>'Calligraffitti', 'text'=>'Calligraffitti'),
	array('value'=>'Cambo', 'text'=>'Cambo'),
	array('value'=>'Candal', 'text'=>'Candal'),
	array('value'=>'Cantarell', 'text'=>'Cantarell'),
	array('value'=>'Cantarell:regular,italic,bold,bolditalic', 'text'=>'Cantarell (plus italic, bold, and bold italic)'),
	array('value'=>'Cantata One', 'text'=>'Cantata One'),
	array('value'=>'Cardo', 'text'=>'Cardo'),
	array('value'=>'Carme', 'text'=>'Carme'),
	array('value'=>'Carter One', 'text'=>'Carter One'),
	array('value'=>'Caudex', 'text'=>'Caudex'),
	array('value'=>'Cedarville Cursive', 'text'=>'Cedarville Cursive'),
	array('value'=>'Ceviche One', 'text'=>'Ceviche One'),
	array('value'=>'Changa One', 'text'=>'Changa One'),
	array('value'=>'Chango', 'text'=>'Chango'),
	array('value'=>'Chau Philomene One', 'text'=>'Chau Philomene One'),
	array('value'=>'Chelsea Market', 'text'=>'Chelsea Market'),
	array('value'=>'Cherry Cream Soda', 'text'=>'Cherry Cream Soda'),
	array('value'=>'Chewy', 'text'=>'Chewy'),
	array('value'=>'Chicle', 'text'=>'Chicle'),
	array('value'=>'Chivo', 'text'=>'Chivo'),
	array('value'=>'Coda', 'text'=>'Coda'),
	array('value'=>'Coda Caption', 'text'=>'Coda Caption'),
	array('value'=>'Codystar', 'text'=>'Codystar'),
	array('value'=>'Comfortaa', 'text'=>'Comfortaa'),
	array('value'=>'Coming Soon', 'text'=>'Coming Soon'),
	array('value'=>'Concert One', 'text'=>'Concert One'),
	array('value'=>'Condiment', 'text'=>'Condiment'),
	array('value'=>'Contrail One', 'text'=>'Contrail One'),
	array('value'=>'Convergence', 'text'=>'Convergence'),
	array('value'=>'Cookie', 'text'=>'Cookie'),
	array('value'=>'Copse', 'text'=>'Copse'),
	array('value'=>'Corben:bold', 'text'=>'Corben'),
	array('value'=>'Cousine', 'text'=>'Cousine'),
	array('value'=>'Cousine:regular,italic,bold,bolditalic', 'text'=>'Cousine (plus italic, bold, and bold italic)'),
	array('value'=>'Coustard', 'text'=>'Coustard'),
	array('value'=>'Covered By Your Grace', 'text'=>'Covered By Your Grace'),
	array('value'=>'Crafty Girls', 'text'=>'Crafty Girls'),
	array('value'=>'Creepster', 'text'=>'Creepster'),
	array('value'=>'Crete Round', 'text'=>'Crete Round'),
	array('value'=>'Crimson Text', 'text'=>'Crimson Text'),
	array('value'=>'Crushed', 'text'=>'Crushed'),
	array('value'=>'Cuprum', 'text'=>'Cuprum'),
	array('value'=>'Cutive', 'text'=>'Cutive'),
	array('value'=>'Damion', 'text'=>'Damion'),
	array('value'=>'Dancing Script', 'text'=>'Dancing Script'),
	array('value'=>'Dawning of a New Day', 'text'=>'Dawning of a New Day'),
	array('value'=>'Days One', 'text'=>'Days One'),
	array('value'=>'Delius', 'text'=>'Delius'),
	array('value'=>'Delius Swash Caps', 'text'=>'Delius Swash Caps'),
	array('value'=>'Delius Unicase', 'text'=>'Delius Unicase'),
	array('value'=>'Della Respira', 'text'=>'Della Respira'),
	array('value'=>'Devonshire', 'text'=>'Devonshire'),
	array('value'=>'Didact Gothic', 'text'=>'Didact Gothic'),
	array('value'=>'Diplomata', 'text'=>'Diplomata'),
	array('value'=>'Diplomata SC', 'text'=>'Diplomata SC'),
	array('value'=>'Doppio One', 'text'=>'Doppio One'),
	array('value'=>'Dorsa', 'text'=>'Dorsa'),
	array('value'=>'Dosis', 'text'=>'Dosis'),
	array('value'=>'Dr Sugiyama', 'text'=>'Dr Sugiyama'),
	array('value'=>'Droid Sans', 'text'=>'Droid Sans'),		
	array('value'=>'Droid Sans:regular,bold', 'text'=>'Droid Sans (plus bold)'),
	array('value'=>'Droid Sans Mono', 'text'=>'Droid Sans Mono'),
	array('value'=>'Droid Serif', 'text'=>'Droid Serif'),
	array('value'=>'Droid Serif:regular,italic,bold,bolditalic', 'text'=>'Droid Serif (plus italic, bold, and bold italic)'),
	array('value'=>'Duru Sans', 'text'=>'Duru Sans'),
	array('value'=>'Dynalight', 'text'=>'Dynalight'),
	array('value'=>'EB Garamond', 'text'=>'EB Garamond'),
	array('value'=>'Eater', 'text'=>'Eater'),
	array('value'=>'Economica', 'text'=>'Economica'),
	array('value'=>'Electrolize', 'text'=>'Electrolize'),
	array('value'=>'Emblema One', 'text'=>'Emblema One'),
	array('value'=>'Emilys Candy', 'text'=>'Emilys Candy'),
	array('value'=>'Engagement', 'text'=>'Engagement'),
	array('value'=>'Enriqueta', 'text'=>'Enriqueta'),
	array('value'=>'Erica One', 'text'=>'Erica One'),
	array('value'=>'Esteban', 'text'=>'Esteban'),
	array('value'=>'Euphoria Script', 'text'=>'Euphoria Script'),
	array('value'=>'Ewert', 'text'=>'Ewert'),
	array('value'=>'Exo', 'text'=>'Exo'),
	array('value'=>'Expletus Sans', 'text'=>'Expletus Sans'),
	array('value'=>'Expletus Sans:regular,500,600,bold', 'text'=>'Expletus Sans (plus 500, 600, and bold)'),
	array('value'=>'Fanwood Text', 'text'=>'Fanwood Text'),
	array('value'=>'Fascinate', 'text'=>'Fascinate'),
	array('value'=>'Fascinate Inline', 'text'=>'Fascinate Inline'),
	array('value'=>'Federant', 'text'=>'Federant'),
	array('value'=>'Federo', 'text'=>'Federo'),
	array('value'=>'Felipa', 'text'=>'Felipa'),
	array('value'=>'Fjord One', 'text'=>'Fjord One'),
	array('value'=>'Flamenco', 'text'=>'Flamenco'),
	array('value'=>'Flavors', 'text'=>'Flavors'),
	array('value'=>'Fondamento', 'text'=>'Fondamento'),
	array('value'=>'Fontdiner Swanky', 'text'=>'Fontdiner Swanky'),
	array('value'=>'Forum', 'text'=>'Forum'),
	array('value'=>'Francois One', 'text'=>'Francois One'),
	array('value'=>'Fredericka the Great', 'text'=>'Fredericka the Great'),
	array('value'=>'Fredoka One', 'text'=>'Fredoka One'),
	array('value'=>'Fresca', 'text'=>'Fresca'),
	array('value'=>'Frijole', 'text'=>'Frijole'),
	array('value'=>'Fugaz One', 'text'=>'Fugaz One'),
	array('value'=>'Galdeano', 'text'=>'Galdeano'),
	array('value'=>'Gentium Basic', 'text'=>'Gentium Basic'),
	array('value'=>'Gentium Book Basic', 'text'=>'Gentium Book Basic'),
	array('value'=>'Geo', 'text'=>'Geo'),	
	array('value'=>'Geostar', 'text'=>'Geostar'),
	array('value'=>'Geostar Fill', 'text'=>'Geostar Fill'),
	array('value'=>'Germania One', 'text'=>'Germania One'),
	array('value'=>'Give You Glory', 'text'=>'Give You Glory'),
	array('value'=>'Glass Antiqua', 'text'=>'Glass Antiqua'),
	array('value'=>'Glegoo', 'text'=>'Glegoo'),
	array('value'=>'Gloria Hallelujah', 'text'=>'Gloria Hallelujah'),
	array('value'=>'Goblin One', 'text'=>'Goblin One'),
	array('value'=>'Gochi Hand', 'text'=>'Gochi Hand'),
	array('value'=>'Gorditas', 'text'=>'Gorditas'),
	array('value'=>'Goudy Bookletter 1911', 'text'=>'Goudy Bookletter 1911'),
	array('value'=>'Graduate', 'text'=>'Graduate'),
	array('value'=>'Gravitas One', 'text'=>'Gravitas One'),
	array('value'=>'Great Vibes', 'text'=>'Great Vibes'),
	array('value'=>'Gruppo', 'text'=>'Gruppo'),
	array('value'=>'Gudea', 'text'=>'Gudea'),
	array('value'=>'Habibi', 'text'=>'Habibi'),
	array('value'=>'Hammersmith One', 'text'=>'Hammersmith One'),
	array('value'=>'Handlee', 'text'=>'Handlee'),
	array('value'=>'Happy Monkey', 'text'=>'Happy Monkey'),
	array('value'=>'Henny Penny', 'text'=>'Henny Penny'),
	array('value'=>'Herr Von Muellerhoff', 'text'=>'Herr Von Muellerhoff'),
	array('value'=>'Holtwood One SC', 'text'=>'Holtwood One SC'),
	array('value'=>'Homemade Apple', 'text'=>'Homemade Apple'),
	array('value'=>'Homenaje', 'text'=>'Homenaje'),
	array('value'=>'IM Fell DW Pica', 'text'=>'IM Fell DW Pica'),
	array('value'=>'IM Fell DW Pica:regular,italic', 'text'=>'IM Fell DW Pica (plus italic)'),
	array('value'=>'IM Fell DW Pica SC', 'text'=>'IM Fell DW Pica SC'),
	array('value'=>'IM Fell Double Pica', 'text'=>'IM Fell Double Pica'),
	array('value'=>'IM Fell English', 'text'=>'IM Fell English'),
	array('value'=>'IM Fell English:regular,italic', 'text'=>'IM Fell English (plus italic)'),	
	array('value'=>'IM Fell English SC', 'text'=>'IM Fell English SC'),
	array('value'=>'IM Fell French Canon', 'text'=>'IM Fell French Canon'),
	array('value'=>'IM Fell French Canon:regular,italic', 'text'=>'IM Fell French Canon (plus italic)'),
	array('value'=>'IM Fell French Canon SC', 'text'=>'IM Fell French Canon SC'),
	array('value'=>'IM Fell Great Primer', 'text'=>'IM Fell Great Primer'),
	array('value'=>'IM Fell Great Primer:regular,italic', 'text'=>'IM Fell Great Primer (plus italic)'),
	array('value'=>'IM Fell Great Primer SC', 'text'=>'IM Fell Great Primer SC'),
	array('value'=>'Iceberg', 'text'=>'Iceberg'),
	array('value'=>'Iceland', 'text'=>'Iceland'),
	array('value'=>'Imprima', 'text'=>'Imprima'),
	array('value'=>'Inconsolata', 'text'=>'Inconsolata'),
	array('value'=>'Inder', 'text'=>'Inder'),
	array('value'=>'Indie Flower', 'text'=>'Indie Flower'),
	array('value'=>'Inika', 'text'=>'Inika'),
	array('value'=>'Irish Grover', 'text'=>'Irish Grover'),
	array('value'=>'Istok Web', 'text'=>'Istok Web'),
	array('value'=>'Italiana', 'text'=>'Italiana'),
	array('value'=>'Italianno', 'text'=>'Italianno'),
	array('value'=>'Jim Nightshade', 'text'=>'Jim Nightshade'),
	array('value'=>'Jockey One', 'text'=>'Jockey One'),
	array('value'=>'Jolly Lodger', 'text'=>'Jolly Lodger'),
	array('value'=>'Josefin Sans:100,100italic', 'text'=>'Josefin Sans 100 (plus italic)'),
	array('value'=>'Josefin Sans:light,lightitalic', 'text'=>'Josefin Sans Light 300 (plus italic)'),
	array('value'=>'Josefin Sans:regular,regularitalic', 'text'=>'Josefin Sans Regular 400 (plus italic)'),
	array('value'=>'Josefin Sans:bold,bolditalic', 'text'=>'Josefin Sans Bold 700 (plus italic)'),
	array('value'=>'Josefin Slab:100,100italic', 'text'=>'Josefin Slab 100 (plus italic)'),		
	array('value'=>'Josefin Slab:light,lightitalic', 'text'=>'Josefin Slab Light 300 (plus italic)'),
	array('value'=>'Josefin Slab:600,600italic', 'text'=>'Josefin Slab 600 (plus italic)'),
	array('value'=>'Josefin Slab:bold,bolditalic', 'text'=>'Josefin Slab Bold 700 (plus italic)'),
	array('value'=>'Judson', 'text'=>'Judson'),
	array('value'=>'Judson:regular,regularitalic,bold', 'text'=>'Judson (plus bold)'),
	array('value'=>'Julee', 'text'=>'Julee'),
	array('value'=>'Junge', 'text'=>'Junge'),
	array('value'=>'Jura', 'text'=>'Jura'),
	array('value'=>'Just Another Hand', 'text'=>'Just Another Hand'),
	array('value'=>'Just Me Again Down Here', 'text'=>'Just Me Again Down Here'),
	array('value'=>'Kameron', 'text'=>'Kameron'),
	array('value'=>'Karla', 'text'=>'Karla'),
	array('value'=>'Kaushan Script', 'text'=>'Kaushan Script'),
	array('value'=>'Kelly Slab', 'text'=>'Kelly Slab'),
	array('value'=>'Kenia', 'text'=>'Kenia'),
	array('value'=>'Knewave', 'text'=>'Knewave'),
	array('value'=>'Kotta One', 'text'=>'Kotta One'),
	array('value'=>'Kranky', 'text'=>'Kranky'),
	array('value'=>'Kreon:light,regular,bold', 'text'=>'Kreon (plus light and bold)'),
	array('value'=>'Kristi', 'text'=>'Kristi'),
	array('value'=>'Krona One', 'text'=>'Krona One'),
	array('value'=>'La Belle Aurore', 'text'=>'La Belle Aurore'),
	array('value'=>'Lancelot', 'text'=>'Lancelot'),
	array('value'=>'Lato:100,100italic', 'text'=>'Lato Light 100 (plus italic)'),
	array('value'=>'Lato:regular,regularitalic', 'text'=>'Lato Regular 400 (plus italic)'),
	array('value'=>'Lato:bold,bolditalic', 'text'=>'Lato Bold 700 (plus italic)'),
	array('value'=>'Lato:900,900italic', 'text'=>'Lato 900 (plus italic)'),
	array('value'=>'League Script', 'text'=>'League Script'),
	array('value'=>'Leckerli On', 'text'=>'Leckerli On'),
	array('value'=>'Ledger', 'text'=>'Ledger'),
	array('value'=>'Lekton', 'text'=>'Lekton'),
	array('value'=>'Lekton:regular,italic,bold', 'text'=>'Lekton (plus italic and bold)'),
	array('value'=>'Lemon', 'text'=>'Lemon'),
	array('value'=>'Lilita One', 'text'=>'Lilita One'),
	array('value'=>'Limelight', 'text'=>'Limelight'),
	array('value'=>'Linden Hill', 'text'=>'Linden Hill'),
	array('value'=>'Lobster', 'text'=>'Lobster'),
	array('value'=>'Lobster Two', 'text'=>'Lobster Two'),
	array('value'=>'Londrina Outline', 'text'=>'Londrina Outline'),
	array('value'=>'Londrina Shadow', 'text'=>'Londrina Shadow'),
	array('value'=>'Londrina Sketch', 'text'=>'Londrina Sketch'),
	array('value'=>'Londrina Solid', 'text'=>'Londrina Solid'),
	array('value'=>'Lora', 'text'=>'Lora'),
	array('value'=>'Love Ya Like A Sister', 'text'=>'Love Ya Like A Sister'),
	array('value'=>'Loved by the King', 'text'=>'Loved by the King'),
	array('value'=>'Lovers Quarrel', 'text'=>'Lovers Quarrel'),
	array('value'=>'Luckiest Guy', 'text'=>'Luckiest Guy'),
	array('value'=>'Lusitana', 'text'=>'Lusitana'),
	array('value'=>'Lustria', 'text'=>'Lustria'),
	array('value'=>'Macondo', 'text'=>'Macondo'),
	array('value'=>'Macondo Swash Caps', 'text'=>'Macondo Swash Caps'),
	array('value'=>'Magra', 'text'=>'Magra'),
	array('value'=>'Maiden Orange', 'text'=>'Maiden Orange'),
	array('value'=>'Mako', 'text'=>'Mako'),
	array('value'=>'Marck Script', 'text'=>'Marck Script'),
	array('value'=>'Marko One', 'text'=>'Marko One'),
	array('value'=>'Marmelad', 'text'=>'Marmelad'),
	array('value'=>'Marvel', 'text'=>'Marvel'),
	array('value'=>'Mate', 'text'=>'Mate'),
	array('value'=>'Mate SC', 'text'=>'Mate SC'),
	array('value'=>'Maven Pro', 'text'=>'Maven Pro'),
	array('value'=>'Meddon', 'text'=>'Meddon'),
	array('value'=>'MedievalSharp', 'text'=>'MedievalSharp'),
	array('value'=>'Medula One', 'text'=>'Medula One'),
	array('value'=>'Megrim', 'text'=>'Megrim'),
	array('value'=>'Merriweather', 'text'=>'Merriweather'),
	array('value'=>'Metamorphous', 'text'=>'Metamorphous'),
	array('value'=>'Metrophobic', 'text'=>'Metrophobic'),
	array('value'=>'Michroma', 'text'=>'Michroma'),
	array('value'=>'Miltonian Tattoo', 'text'=>'Miltonian Tattoo'),
	array('value'=>'Miltonian', 'text'=>'Miltonian'),
	array('value'=>'Miniver', 'text'=>'Miniver'),
	array('value'=>'Miss Fajardose', 'text'=>'Miss Fajardose'),
	array('value'=>'Modern Antiqua', 'text'=>'Modern Antiqua'),
	array('value'=>'Molengo', 'text'=>'Molengo'),
	array('value'=>'Monofett', 'text'=>'Monofett'),
	array('value'=>'Monoton', 'text'=>'Monoton'),
	array('value'=>'Monsieur La Doulaise', 'text'=>'Monsieur La Doulaise'),
	array('value'=>'Montaga', 'text'=>'Montaga'),
	array('value'=>'Montez', 'text'=>'Montez'),
	array('value'=>'Montserrat', 'text'=>'Montserrat'),
	array('value'=>'Mountains of Christmas', 'text'=>'Mountains of Christmas'),
	array('value'=>'Mr Bedfort', 'text'=>'Mr Bedfort'),
	array('value'=>'Mr Dafoe', 'text'=>'Mr Dafoe'),
	array('value'=>'Mr De Haviland', 'text'=>'Mr De Haviland'),
	array('value'=>'Mrs Saint Delafield', 'text'=>'Mrs Saint Delafield'),
	array('value'=>'Mrs Sheppards', 'text'=>'Mrs Sheppards'),
	array('value'=>'Muli', 'text'=>'Muli'),
	array('value'=>'Mystery Quest', 'text'=>'Mystery Quest'),
	array('value'=>'Neucha', 'text'=>'Neucha'),
	array('value'=>'Neuton', 'text'=>'Neuton'),
	array('value'=>'News Cycle', 'text'=>'News Cycle'),
	array('value'=>'Niconne', 'text'=>'Niconne'),
	array('value'=>'Nixie One', 'text'=>'Nixie One'),
	array('value'=>'Nobile', 'text'=>'Nobile'),
	array('value'=>'Nobile:regular,italic,bold,bolditalic', 'text'=>'Nobile (plus italic, bold, and bold italic)'),
	array('value'=>'Norican', 'text'=>'Norican'),
	array('value'=>'Nosifer', 'text'=>'Nosifer'),
	array('value'=>'Nothing You Could Do', 'text'=>'Nothing You Could Do'),
	array('value'=>'Noticia Text', 'text'=>'Noticia Text'),
	array('value'=>'Nova Cut', 'text'=>'Nova Cut'),
	array('value'=>'Nova Flat', 'text'=>'Nova Flat'),
	array('value'=>'Nova Mono', 'text'=>'Nova Mono'),
	array('value'=>'Nova Oval', 'text'=>'Nova Oval'),
	array('value'=>'Nova Round', 'text'=>'Nova Round'),
	array('value'=>'Nova Script', 'text'=>'Nova Script'),
	array('value'=>'Nova Slim', 'text'=>'Nova Slim'),
	array('value'=>'Nova Square', 'text'=>'Nova Square'),
	array('value'=>'Numans', 'text'=>'Numans'),
	array('value'=>'Nunito:light,regular,bold', 'text'=>'Nunito'),
	array('value'=>'Old Standard TT', 'text'=>'Old Standard TT'),
	array('value'=>'Old Standard TT:regular,italic,bold', 'text'=>'Old Standard TT (plus italic and bold)'),
	array('value'=>'Oldenburg', 'text'=>'Oldenburg'),
	array('value'=>'Oleo Script', 'text'=>'Oleo Script'),
	array('value'=>'Open Sans:light,lightitalic', 'text'=>'Open Sans light'),
	array('value'=>'Open Sans:regular,regularitalic', 'text'=>'Open Sans regular'),
	array('value'=>'Open Sans:light,lightitalic,regular,regularitalic,600,600italic,bold,bolditalic,800,800italic', 'text'=>'Open Sans (all types)'),
	array('value'=>'Open Sans Condensed:light,lightitalic', 'text'=>'Open Sans Condensed'),
	array('value'=>'Orbitron', 'text'=>'Orbitron Regular (400)'),
	array('value'=>'Orbitron:bold', 'text'=>'Orbitron (Bold)'),
	array('value'=>'Oswald', 'text'=>'Oswald'),
	array('value'=>'Original Surfer', 'text'=>'Original Surfer'),
	array('value'=>'Over the Rainbow', 'text'=>'Over the Rainbow'),
	array('value'=>'Overlock', 'text'=>'Overlock'),
	array('value'=>'Overlock SC', 'text'=>'Overlock SC'),
	array('value'=>'Ovo', 'text'=>'Ovo'),
	array('value'=>'Oxygen', 'text'=>'Oxygen'),
	array('value'=>'PT Mono', 'text'=>'PT Mono'),
	array('value'=>'PT Sans', 'text'=>'PT Sans'),
	array('value'=>'PT Sans:regular,italic,bold,bolditalic', 'text'=>'PT Sans (plus itlic, bold, and bold italic)'),
	array('value'=>'PT Sans Caption:regular,bold', 'text'=>'PT Sans Caption (plus bold)'),
	array('value'=>'PT Sans Narrow:regular,bold', 'text'=>'PT Sans Narrow (plus bold)'),
	array('value'=>'PT Serif:regular,italic,bold,bolditalic', 'text'=>'PT Serif (plus italic, bold, and bold italic)'),
	array('value'=>'PT Serif Caption:regular,italic', 'text'=>'PT Serif Caption (plus italic)'),
	array('value'=>'Pacifico', 'text'=>'Pacifico'),
	array('value'=>'Parisienne', 'text'=>'Parisienne'),
	array('value'=>'Passero One', 'text'=>'Passero One'),
	array('value'=>'Passion One', 'text'=>'Passion One'),
	array('value'=>'Patrick Hand,', 'text'=>'Patrick Hand,'),
	array('value'=>'Patua One', 'text'=>'Patua One'),
	array('value'=>'Paytone One', 'text'=>'Paytone One'),
	array('value'=>'Permanent Marker', 'text'=>'Permanent Marker'),
	array('value'=>'Pertona', 'text'=>'Pertona'),
	array('value'=>'Philosopher', 'text'=>'Philosopher'),
	array('value'=>'Piedra', 'text'=>'Piedra'),
	array('value'=>'Pinyon Script', 'text'=>'Pinyon Script'),
	array('value'=>'Plaster', 'text'=>'Plaster'),
	array('value'=>'Play:regular,bold', 'text'=>'Play (plus bold)'),
	array('value'=>'Playball', 'text'=>'Playball'),
	array('value'=>'Playfair Display', 'text'=>'Playfair Display'),
	array('value'=>'Podkova', 'text'=>'Podkova'),
	array('value'=>'Poiret One', 'text'=>'Poiret One'),
	array('value'=>'Poller One', 'text'=>'Poller One'),
	array('value'=>'Poly', 'text'=>'Poly'),
	array('value'=>'Pompiere', 'text'=>'Pompiere'),
	array('value'=>'Pontano Sans', 'text'=>'Pontano Sans'),
	array('value'=>'Port Lligat Sans', 'text'=>'Port Lligat Sans'),
	array('value'=>'Port Lligat Slab', 'text'=>'Port Lligat Slab'),
	array('value'=>'Prata', 'text'=>'Prata'),
	array('value'=>'Press Start 2P', 'text'=>'Press Start 2P'),
	array('value'=>'Princess Sofia', 'text'=>'Princess Sofia'),
	array('value'=>'Prociono', 'text'=>'Prociono'),
	array('value'=>'Prosto One', 'text'=>'Prosto One'),
	array('value'=>'Puritan:regular,italic,bold,bolditalic', 'text'=>'>Puritan (plus italic, bold, and bold italic)'),
	array('value'=>'Quantico', 'text'=>'Quantico'),
	array('value'=>'Quattrocento', 'text'=>'Quattrocento'),
	array('value'=>'Quattrocento Sans', 'text'=>'Quattrocento Sans'),
	array('value'=>'Questrial', 'text'=>'Questrial'),
	array('value'=>'Quicksand', 'text'=>'Quicksand'),
	array('value'=>'Qwigley', 'text'=>'Qwigley'),
	array('value'=>'Radley', 'text'=>'Radley'),
	array('value'=>'Raleway', 'text'=>'Raleway'),
	array('value'=>'Rammetto One', 'text'=>'Rammetto One'),
	array('value'=>'Rancho', 'text'=>'Rancho'),
	array('value'=>'Rationale', 'text'=>'Rationale'),
	array('value'=>'Redressed', 'text'=>'Redressed'),
	array('value'=>'Reenie Beanie', 'text'=>'Reenie Beanie'),
	array('value'=>'Revalia', 'text'=>'Revalia'),
	array('value'=>'Ribeye', 'text'=>'Ribeye'),
	array('value'=>'Ribeye Marrow', 'text'=>'Ribeye Marrow'),
	array('value'=>'Righteous', 'text'=>'Righteous'),
	array('value'=>'Rochester', 'text'=>'Rochester'),
	array('value'=>'Rock Salt', 'text'=>'Rock Salt'),
	array('value'=>'Rokkitt', 'text'=>'Rokkitt'),
	array('value'=>'Ropa Sans', 'text'=>'Ropa Sans'),
	array('value'=>'Rosario', 'text'=>'Rosario'),
	array('value'=>'Rosarivo', 'text'=>'Rosarivo'),
	array('value'=>'Rouge Script', 'text'=>'Rouge Script'),
	array('value'=>'Ruda', 'text'=>'Ruda'),
	array('value'=>'Ruge Boogie', 'text'=>'Ruge Boogie'),
	array('value'=>'Ruluko', 'text'=>'Ruluko'),
	array('value'=>'Ruslan Display', 'text'=>'Ruslan Display'),
	array('value'=>'Russo One', 'text'=>'Russo One'),
	array('value'=>'Ruthie', 'text'=>'Ruthie'),
	array('value'=>'Sail', 'text'=>'Sail'),
	array('value'=>'Sancreek', 'text'=>'Sancreek'),
	array('value'=>'Sansita One', 'text'=>'Sansita One'),
	array('value'=>'Sarina', 'text'=>'Sarina'),
	array('value'=>'Satisfy', 'text'=>'Satisfy'),
	array('value'=>'Schoolbell', 'text'=>'Schoolbell'),	
	array('value'=>'Seaweed Script', 'text'=>'Seaweed Script'),
	array('value'=>'Sevillana', 'text'=>'Sevillana'),
	array('value'=>'Shadows Into Light', 'text'=>'Shadows Into Light'),
	array('value'=>'Shadows Into Light Two', 'text'=>'Shadows Into Light Two'),
	array('value'=>'Shanti', 'text'=>'Shanti'),
	array('value'=>'Share', 'text'=>'Share'),
	array('value'=>'Shojumaru', 'text'=>'Shojumaru'),
	array('value'=>'Short Stack', 'text'=>'Short Stack'),
	array('value'=>'Sigmar One', 'text'=>'Sigmar One'),
	array('value'=>'Signika', 'text'=>'Signika'),
	array('value'=>'Signika Negative', 'text'=>'Signika Negative'),
	array('value'=>'Simonetta', 'text'=>'Simonetta'),
	array('value'=>'Sirin Stencil', 'text'=>'Sirin Stencil'),
	array('value'=>'Six Caps', 'text'=>'Six Caps'),
	array('value'=>'Slackey', 'text'=>'Slackey'),
	array('value'=>'Smokum', 'text'=>'Smokum'),
	array('value'=>'Smythe', 'text'=>'Smythe'),
	array('value'=>'Sniglet 800', 'text'=>'Sniglet'),
	array('value'=>'Snippet', 'text'=>'Snippet'),
	array('value'=>'Sofia', 'text'=>'Sofia'),
	array('value'=>'Sonsie One', 'text'=>'Sonsie One'),
	array('value'=>'Sorts Mill Goudy', 'text'=>'Sorts Mill Goudy'),
	array('value'=>'Special Elite', 'text'=>'Special Elite'),
	array('value'=>'Spicy Rice', 'text'=>'Spicy Rice'),
	array('value'=>'Spinnaker', 'text'=>'Spinnaker'),
	array('value'=>'Spirax', 'text'=>'Spirax'),
	array('value'=>'Squada One', 'text'=>'Squada One'),
	array('value'=>'Stardos Stencil', 'text'=>'Stardos Stencil'),
	array('value'=>'Stint Ultra Condensed', 'text'=>'Stint Ultra Condensed'),
	array('value'=>'Stint Ultra Expanded', 'text'=>'Stint Ultra Expanded'),
	array('value'=>'Stoke', 'text'=>'Stoke'),
	array('value'=>'Sue Ellen Francisco', 'text'=>'Sue Ellen Francisco'),
	array('value'=>'Sunshiney', 'text'=>'Sunshiney'),
	array('value'=>'Supermercado One', 'text'=>'Supermercado One'),
	array('value'=>'Swanky and Moo Moo', 'text'=>'Swanky and Moo Moo'),
	array('value'=>'Syncopate', 'text'=>'Syncopate'),
	array('value'=>'Tangerine', 'text'=>'Tangerine'),
	array('value'=>'Telex', 'text'=>'Telex'),
	array('value'=>'Tenor Sans', 'text'=>'Tenor Sans'),
	array('value'=>'The Girl Next Door', 'text'=>'The Girl Next Door'),
	array('value'=>'Tienne', 'text'=>'Tienne'),
	array('value'=>'Tinos', 'text'=>'Tinos'),
	array('value'=>'Tinos:regular,italic,bold,bolditalic', 'text'=>'Tinos (plus italic, bold, and bold italic)'),
	array('value'=>'Titan One', 'text'=>'Titan One'),
	array('value'=>'Trade Winds', 'text'=>'Trade Winds'),
	array('value'=>'Trocchi', 'text'=>'Trocchi'),
	array('value'=>'Trochut', 'text'=>'Trochut'),
	array('value'=>'Trykker', 'text'=>'Trykker'),
	array('value'=>'Tulpen One', 'text'=>'Tulpen One'),
	array('value'=>'Ubuntu', 'text'=>'Ubuntu'),
	array('value'=>'Ubuntu:regular,italic,bold,bolditalic', 'text'=>'Ubuntu (plus italic, bold, and bold italic)'),
	array('value'=>'Ubuntu Condensed', 'text'=>'Ubuntu Condensed'),
	array('value'=>'Ubuntu Mono', 'text'=>'Ubuntu Mono'),
	array('value'=>'Ultra', 'text'=>'Ultra'),
	array('value'=>'Uncial Antiqua', 'text'=>'Uncial Antiqua'),
	array('value'=>'UnifrakturCook', 'text'=>'UnifrakturCook'),
	array('value'=>'UnifrakturMaguntia', 'text'=>'UnifrakturMaguntia'),
	array('value'=>'Unkempt', 'text'=>'Unkempt'),	
	array('value'=>'Unlock', 'text'=>'Unlock'),
	array('value'=>'Unna', 'text'=>'Unna'),
	array('value'=>'Varela', 'text'=>'Varela'),
	array('value'=>'Varela Round', 'text'=>'Varela Round'),
	array('value'=>'Vast Shadow', 'text'=>'Vast Shadow'),
	array('value'=>'Vibur', 'text'=>'Vibur'),
	array('value'=>'Vidaloka', 'text'=>'Vidaloka'),
	array('value'=>'Viga', 'text'=>'Viga'),
	array('value'=>'Voces', 'text'=>'Voces'),
	array('value'=>'Volkhov', 'text'=>'Volkhov'),
	array('value'=>'Vollkorn', 'text'=>'Vollkorn'),
	array('value'=>'Vollkorn:regular,italic,bold,bolditalic', 'text'=>'Vollkorn (plus italic, bold, and bold italic)'),
	array('value'=>'Voltaire', 'text'=>'Voltaire'),
	array('value'=>'VT323', 'text'=>'VT323'),
	array('value'=>'Waiting for the Sunrise', 'text'=>'Waiting for the Sunrise'),
	array('value'=>'Wallpoet', 'text'=>'Wallpoet'),
	array('value'=>'Walter Turncoat', 'text'=>'Walter Turncoat'),
	array('value'=>'Wellfleet', 'text'=>'Wellfleet'),
	array('value'=>'Wire One', 'text'=>'Wire One'),
	array('value'=>'Yanone Kaffeesatz', 'text'=>'Yanone Kaffeesatz'),
	array('value'=>'Yanone Kaffeesatz:700', 'text'=>'Yanone Kaffeesatz (Bold)'),
	array('value'=>'Yellowtail', 'text'=>'Yellowtail'),
	array('value'=>'Yeseva One', 'text'=>'Yeseva One'),
	array('value'=>'Yesteryear', 'text'=>'Yesteryear'),
	array('value'=>'Zeyada', 'text'=>'Zeyada')
);


$options = array(
	
	array(
		'type' => 'open',
		'tab_name' => 'General settings',
		'tab_id' => 'general-settings'
	) ,
	
	array(
		'name' => 'Logo image',
		'id' => $shortname . '_logo',
		'type' => 'upload',
		'img_w' => '400',
		'img_h' => '250',
		'std' => '',
		'desc' => 'Upload a logo from your hard drive or specify an existing url (Recommended size: 200x46)'
	),

	array(
		'name' => 'Logo Text',
		'id' => $shortname . '_logotext',
		'type' => 'text',
		'std' => '',
		'desc' => 'Logo Image alt text'
	) ,
	
	array(
		'name' => 'Body Font',
		'id' => $shortname.'_body_font',
		'type' => 'select',
		'std' => '',
		'desc' => 'Applies to all elements (except headings, if specified in the next field).',
		'options' => $fonts
	),
	
	array(
		'name' => 'Headings Font',
		'id' => $shortname.'_headings_font',
		'type' => 'select',
		'std' => '',
		'desc' => 'Applies to all headings (h1, h2, h3, h4, h5, h6).',
		'options' => $fonts
	) ,
	
	array(
		'name' => 'Menu Font',
		'id' => $shortname.'_menu_font',
		'type' => 'select',
		'std' => '',
		'desc' => 'Applies to main menu\'s top items (not dropdowns).',
		'options' => $fonts
	),
		
	array(
		'name' => 'Favicon',
		'id' => $shortname . '_favicon',
		'type' => 'upload',
		'img_w' => '400',
		'img_h' => '250',
		'std' => '',
		'desc' => 'Upload a favicon.'
	),		
	
	array(
		'type' => 'close'
	) ,
	
	/*************** HEADER ***************/
	array(
		'type' => 'open',
		'tab_name' => 'Header',
		'tab_id' => 'header-section'
	) ,
	array(
		'name' => 'Social buttons',
		'id' => $shortname . '_header_social',
		'type' => 'textarea',
		'std' => '',
		'height' => '100',
		'desc' => 'Insert your social icons here using [social_button] shortcode. Example: [social_button name="facebook" url="http://my_fb_profile" title="Facebook" /]'
	 ),
	
		
	array(
		'type' => 'close'
	) ,
	
	/*************** FOOTER ***************/
	array(
		'type' => 'open',
		'tab_name' => 'Footer',
		'tab_id' => 'footer-section'
	) ,
	array(
		'name' => 'Footer Widgets',
		'id' => $shortname . '_footer_widgets_count',
		'type' => 'text',
		'std' => '4',
		'desc' => 'Enter the desired number of footer widgets'	
	) ,
			
	array(
		'name' => 'Copyright Text',
		'id' => $shortname . '_copyright',
		'type' => 'textarea',
		'std' => '',
		'height' => '100',
		'desc' => 'Copyright information on the bottom of site'
	) ,
	
	array(
		'name' => 'Footer menu',
		'id' => $shortname . '_footerinfo',
		'type' => 'textarea',
		'std' => '',
		'height' => '100',
		'desc' => 'Put here any content you find relevant, such as social links'
	),
	
	array(
		'name' => 'Social Buttons',
		'id' => $shortname . '_footer_social',
		'type' => 'textarea',
		'std' => '',
		'height' => '100',
		'desc' => ''
	) ,
		
	array(
		'type' => 'close'
	) ,
	
	

	/****** SKIN Choice and customization ****/
	array(
		'type' => 'open',
		'tab_name' => 'Styles',
		'tab_id' => 'styles'
	) ,
	
	array(
		'type' => 'toggle',
		'item_name' => 'Global styles',
		'toggle_id' => 'global-styles'
	) ,	
		array(
			'name' 	=> 'Main Color',
			'id' 	=> $shortname.'_main_color',
			'type' 	=> 'color',
			'std' 	=> '',
			'desc' 	=> 'Applies to lot of elements. Serves as a skin.'
		),
		
		array(
			'name' 	=> 'Text Color',
			'id' 	=> $shortname.'_text_color',
			'type' 	=> 'color',
			'std' 	=> '',
			'desc' 	=> 'Regular text and paragraphs color'
		),
	
	array(
		'type' => 'toggle_close',
	) ,	
	
	array(
		'type' => 'toggle',
		'item_name' => 'Body styles',
		'toggle_id' => 'body-styles'
	) ,	
		array(
			'name' => 'Body background Image',
			'id' =>   $shortname.'_custom_background',
			'type' => 'upload',
			'std' => '',
			'desc' => 'Site body background. Upload a background from your hard drive or specify an existing url(with absolute path like http://www.yoursite.com/your_background.jpg)'
		),
				
		array( "name" => "Body Background Color",
			"desc" 	=> "Hex value for the background color (e.g. #eeeeee)",
			"id" 	=> $shortname."_background_color",
			"type" 	=> "color",
			"std" 	=> ""
		),
		
		array("name" => "Body Background Repeat",
			'type'	=> 'select',
			"id" 	=> $shortname."_background_repeat",
			'std' 	=> '',
			'desc' 	=> 'Choose if background is repeatable.',
			'options' => array(
				array( "value" => "", "text" => "Repeat" ),
				array( "value" => "repeat-x", "text" => "Repeat X"),
				array( "value" => "repeat-y", "text" => "Repeat Y"),
				array( "value" => "no-repeat", "text" => "No repeat")
			)
		),
	
	array(
		'type' => 'toggle_close',
	) ,	
	
	array(
		'type' => 'toggle',
		'item_name' => 'Header styles',
		'toggle_id' => 'header-styles'
	) ,	
	
		array( "name" => "Header Background Color",
			"desc" 	=> "",
			"id" 	=> $shortname."_header_bg_color",
			"type" 	=> "color",
			"std" 	=> ""
		),
		
		array(
			'name' => 'Header background Image',
			'id' =>   $shortname.'_header_bg',
			'type' => 'upload',
			'std' => '',
			'desc' => 'Header(Menu) background image. Upload an image or specify an existing url.'
		),
		
		array("name" => "Header Background Repeat",
			'type'	=> 'select',
			"id" 	=> $shortname."_header_bg_repeat",
			'std' 	=> '',
			'desc' 	=> 'Choose if header\'s background is repeatable.',
			'options' => array(
				array( "value" => "repeat", "text" => "Repeat" ),		
				array( "value" => "no-repeat", "text" => "No repeat"),
				array( "value" => "repeat-x", "text" => "Repeat X"),
				array( "value" => "repeat-y", "text" => "Repeat Y"),
			)
		),
	
	array(
		'type' => 'toggle_close',
	) ,	
	
	array(
		'type' => 'toggle',
		'item_name' => 'Content styles',
		'toggle_id' => 'content-styles'
	) ,	
		array(
			'name' => 'Content background Image',
			'id' =>   $shortname.'_content_bg',
			'type' => 'upload',
			'std' => '',
			'desc' => 'Content background image. Upload an image or specify an existing url.'
		),
		
		array("name" => "Content Background Repeat",
			'type'	=> 'select',
			"id" 	=> $shortname."_content_bg_repeat",
			'std' 	=> '',
			'desc' 	=> 'Choose if content background is repeatable.',
			'options' => array(
				array( "value" => "no-repeat", "text" => "No repeat"),
				array( "value" => "repeat-x", "text" => "Repeat X"),
				array( "value" => "repeat-y", "text" => "Repeat Y"),
				array( "value" => "repeat", "text" => "Repeat" )		
			)
		),
		
		array(
			'name' => 'Content Background color(Static)',
			'id' =>   $shortname.'_content_bg_static',
			'type' => 'color',
			'std' => '',
			'desc' => 'Static (One Color) background for content.'	
		) ,
	array(
		'type' => 'toggle_close',
	) ,	
	
	array(
		'type' => 'toggle',
		'item_name' => 'Menu styles',
		'toggle_id' => 'menu-styles'
	) ,	
		array(
			'name' => 'Menu Text Color',
			'id' =>   $shortname.'_menu_color',
			'type' => 'color',
			'std' => '',
			'desc' => 'Menu text color.'
		),
		
		array(
			'name' => 'Submenu Background Color',
			'id' =>   $shortname.'_submenu_bg',
			'type' => 'color',
			'std' => '',
			'desc' => ''
		),
		
		array(
			'name' => 'Submenu Text Color',
			'id' =>   $shortname.'_submenu_color',
			'type' => 'color',
			'std' => '',
			'desc' => 'Submenu text color.'
		),
		
		array(
			'name' => 'Menu Hover Text Color',
			'id' =>   $shortname.'_menu_hover_color',
			'type' => 'color',
			'std' => '',
			'desc' => 'Menu text color on hover.'
		),
		
		array(
			'name' => 'Dropdown Menu Background',
			'id' =>   $shortname.'_dropdown_menu_bg',
			'type' => 'color',
			'std' => '',
			'desc' => 'Background color of dropdown menu.'
		),
	
	array(
		'type' => 'toggle_close',
	) ,	
	
	array(
		'type' => 'toggle',
		'item_name' => 'Footer styles',
		'toggle_id' => 'footer-styles'
	) ,	
	
		array(
			'name' => 'Footer Background Image',
			'id' =>   $shortname.'_footer_bg',
			'type' => 'upload',
			'std' => '',
			'desc' => 'Upload a custom footer background.'
		),
		
		array(
			'name' => 'Footer Background Color',
			'id' =>   $shortname.'_footer_bg_color',
			'type' => 'color',
			'std' => '',
			'desc' => ''
		),
		
		array(
			'name' => 'Footer Color',
			'id' =>   $shortname.'_footer_color',
			'type' => 'color',
			'std' => '',
			'desc' => 'Footer elements\' color.'
		),
		
		array("name" => "Footer Background Repeat",
			'type'	=> 'select',
			'id' 	=> 'footer_bg_repeat',
			'std' 	=> '',
			'desc' 	=> 'Choose if footer background is repeatable.',
			'options' => array(
				array( "value" => "no-repeat", "text" => "No repeat"),
				array( "value" => "repeat-x", "text" => "Repeat X"),
				array( "value" => "repeat-y", "text" => "Repeat Y"),
				array( "value" => "repeat", "text" => "Repeat" )
			)
		),
	array(
		'type' => 'toggle_close',
	) ,	
	
	array(
		'type' => 'toggle',
		'item_name' => 'Font sizes',
		'toggle_id' => 'font-sizes'
	) ,	
		array("name" => "Menu font size (Top elements)",
			'type'	=> 'select',
			'id' 	=> $shortname.'_topmenu_font_size',
			'desc' 	=> '',
			'options' => array(
				array( "value" => "20px", "text" => "20px"),
				array( "value" => "19px", "text" => "19px"),
				array( "value" => "18px", "text" => "18px"),
				array( "value" => "17px", "text" => "17px"),
				array( "value" => "16px", "text" => "16px"),
				array( "value" => "15px", "text" => "15px"),
				array( "value" => "14px", "text" => "14px"),
				array( "value" => "13px", "text" => "13px"),
				array( "value" => "12px", "text" => "12px"),			
			)
		),
		
		array("name" => "Menu dropdown font size",
			'type'	=> 'select',
			'id' 	=> $shortname.'_dropdownmenu_font_size',
			'desc' 	=> '',
			'options' => array(
				array( "value" => "", "text" => "13px (Default)"),
				array( "value" => "20px", "text" => "20px"),
				array( "value" => "19px", "text" => "19px"),
				array( "value" => "18px", "text" => "18px"),
				array( "value" => "17px", "text" => "17px"),
				array( "value" => "16px", "text" => "16px"),
				array( "value" => "15px", "text" => "15px"),
				array( "value" => "14px", "text" => "14px"),
				array( "value" => "12px", "text" => "12px"),		
			)
		),
		
		array("name" => "Body font size",
			'type'	=> 'select',
			'id' 	=> $shortname.'_body_font_size',
			'desc' 	=> 'Applies to regular texts and paragraphs <p> font size.',
			'options' => array(
				array( "value" => "", "text" => "13px (Default)"),
				array( "value" => "20px", "text" => "20px"),
				array( "value" => "19px", "text" => "19px"),
				array( "value" => "18px", "text" => "18px"),
				array( "value" => "17px", "text" => "17px"),
				array( "value" => "16px", "text" => "16px"),
				array( "value" => "15px", "text" => "15px"),
				array( "value" => "14px", "text" => "14px"),
				array( "value" => "12px", "text" => "12px"),		
			)
		),
	array(
		'type' => 'toggle_close'
	) ,
	
	array(
		'type' => 'close'
	) ,

	/**************** HOME PAGE ****************/
	array(
		'type' => 'open',
		'tab_name' => 'Homepage',
		'tab_id' => 'home-page'
	) ,
	
	array(
		'name' => 'Slider',
		'id' => $shortname.'_active_slider',
		'type' => 'select',
		'std' => '',
		'desc' => 'Choose one of 7 types of sliders to display on homepage.',
		'options' => array(
			array( "value" => "revolution", "text" => "Revolution (Supports Video)"),
			array( "value" => "flex", "text" => "Flex (Supports Video)"),
			array( "value" => "reverence", "text" => "Reverence"),
			array( "value" => "iview", "text" => "iView(Supports Video)"),
			array( "value" => "camera", "text" => "Camera(Supports Video)"),
			array( "value" => "nivo", "text" => "Nivo"),		
			array( "value" => "3d", "text" => "3D (Not Responsive)"),
			
		)
	),
	

	array(
		'type' => 'close'
	) ,
	
	/*********************************************/
	
	
	/**************** Sliders tab ****************/
	
	
	array(
		'type' => 'open',
		'tab_name' => 'Sliders',
		'tab_id' => 'sliders'
	) ,
	
	
	/********** Revolution Slider Options **********/
	array(
		'type' => 'toggle',
		'item_name' => 'Revolution Slider',
		'toggle_id' => 'revolution-slider'
	) ,
		
		array(
			'name' => 'Sliding interval',
			'id' => $shortname.'_iview_interval',
			'type' => 'text',
			'desc' => 'Set the interval of slides, in milliseconds',
			'std' => 9000
		),	
		
		array(
			'name' => 'Show pagination',
			'id' => $shortname.'_revolution_pagination',
			'type' => 'select',
			'desc' => 'Whether to use pagination links (slides navigation in bottom center of the slider).',
			'options' => array(
				array( "value" => "none", "text" => "Do not show" ),
				array( "value" => "bullet", "text" => "Bullets"),
				array( "value" => "thumb", "text" => "Thumbs")
			),
		),
		
		array(
			'name' => 'Pagination style',
			'id' => $shortname.'_revolution_paginationstyle',
			'type' => 'select',
			'desc' => 'Will take effect if the previous "show pagination" is set to show.',
			'options' => array(
				array( "value" => "round", "text" => "Round" ),
				array( "value" => "square", "text" => "Square"),
				array( "value" => "navbar", "text" => "Navbar")
			),
		),
		
		array(
			'name' => 'Stop timer on hover',
			'id' => $shortname.'_revolution_onhoverstop',
			'type' => 'select',
			'desc' => 'Will stay on same slide as long as the slide is hovered.',
			'options' => array(
				array( "value" => "off", "text" => "No" ),
				array( "value" => "on", "text" => "Yes"),
			),
		),
		
		array(
			'name' => 'Pagination style',
			'id' => $shortname.'_revolution_stoploop',
			'type' => 'select',
			'desc' => 'Whether to stop slides loop at the last slide.',
			'options' => array(
				array( "value" => "on", "text" => "Yes" ),
				array( "value" => "off", "text" => "No"),
			),
		),
	
	
	array(
		'type' => 'toggle_close'
	),	
	
	/**************** Reverence Slider Options ****************/
	
	array(
		'type' => 'toggle',
		'item_name' => 'Reverence Slider',
		'toggle_id' => 'Reverence-slider'
	) ,
	
	array( 
		"name" => "Easing Effect",
		"desc" => "Choose between transition effects of the slider",
		"id" => $shortname."_ei_easing",
		"type" => "select",
		'options' => $tween_types
	),
	
	array( 
		"name" => "Title Easing Effect",
		"desc" => "Choose effect of slider text appearing",
		"id" => $shortname."_ei_titleasing",
		"type" => "select",
		'options' => $tween_types
	),
	
	array(
		'name' => 'Title Speed',
		"id" => $shortname."_ei_titlespeed",
		'type' => 'text',
		'std' => '1200',
		'desc' => 'Title appearance speed.'
	) ,
	
	array(
		'name' => 'Autoplay',
		"id" => $shortname."_ei_autoplay",
		'type' => 'text',
		'std' => 'true',
		'desc' => 'Advance the slides automatically.'
	) ,
	
	array(
		'name' => 'Slideshow Interval',
		"id" => $shortname."_ei_interval",
		'type' => 'text',
		'std' => '3000',
		'desc' => 'Interval for the slideshow.'
	) ,
	
	array(
		'name' => 'Animation speed',
		"id" => $shortname."_ei_anispeed",
		'type' => 'text',
		'std' => '800',
		'desc' => 'Speed for the sliding animation.'
	) ,
	
	
	array('type' => 'toggle_close'),

	/*********************************************/
		
	
	/************ Flex Slider Options ************/
	array(
		'type' => 'toggle',
		'item_name' => 'Flex Slider',
		'toggle_id' => 'flex-slider'
	) ,
	
		array(
			'name' => 'Animation',
			'id' => $shortname.'_flex_animation',
			'type' => 'select',
			'options' => array(
				array( "value" => "fade", "text" => "Fade" ),
				array( "value" => "slide", "text" => "Slide" )			
			),
		),
		
		array(
			'name' => 'Sliding Direction',
			'id' => $shortname.'_flex_slide_direction',
			'type' => 'select',
			'options' => array(
				array( "value" => "horizontal", "text" => "Horizontal" ),
				array( "value" => "vertical", "text" => "Vertical" )			
			),
		),
		
		array(
			'name' => 'Animate slider automatically',
			'id' => $shortname.'_flex_slide_auto',
			'type' => 'select',
			'options' => array(
				array( "value" => "true", "text" => "Yes" ),
				array( "value" => "false", "text" => "No" )			
			),
		),
		
		array(
			'name' => 'Slideshow speed',
			'id' => $shortname.'_flex_slideshow_speed',
			'type' => 'text',
			'desc' => 'Set the speed of the slideshow cycling, in milliseconds',
			'std' => 7000
		),
		
		array(
			'name' => 'Animation Duration',
			'id' => $shortname.'_flex_animation_duration',
			'type' => 'text',
			'desc' => 'Set the speed of animations, in milliseconds.',
			'std' => 600
		),
	
	
	array(
		'type' => 'toggle_close'
	),
	
	/*********************************************/
	
	
	/*********** NIVO Slider Options *************/
	array(
		'type' => 'toggle',
		'item_name' => 'Nivo Slider',
		'toggle_id' => 'nivo-slider'
	) ,
	
	array( 
		"name" => "Effect",
		"desc" => "Choose between 8 transition effects or leave the default to animate randomly",
		"id" => "nivo_effect",
		"type" => "select",
		'options' => array(
			array( "value" => "random", "text" => "Random" ),
			array( "value" => "sliceDown", "text" => "sliceDown"),
			array( "value" => "sliceDownLeft", "text" => "sliceDownLeft"),
			array( "value" => "sliceUp", "text" => "sliceUp"),
			array( "value" => "sliceUpLeft", "text" => "sliceUpLeft"),
			array( "value" => "sliceUpDown", "text" => "sliceUpDown"),
			array( "value" => "sliceUpDownLeft", "text" => "sliceUpDownLeft"),
			array( "value" => "fold", "text" => "fold"),
			array( "value" => "fade", "text" => "fade"),
		)
	),
	
	array(
		'name' => 'Slices',
		'id' => 'nivo_slices',
		'type' => 'text',
		'std' => '15',
		'desc' => 'Number of slices.'
	) ,
	
	array(
		'name' => 'Animation Speed',
		'id' => 'nivo_speed',
		'type' => 'text',
		'std' => '500',
		'desc' => 'Animation speed in miliseconds.'
	) ,
	
	array(
		'name' => 'Interval',
		'id' => 'nivo_pause',
		'type' => 'text',
		'std' => '3000',
		'desc' => 'Time interval between slice changes.'
	) ,
	
	array(
		'name' => 'Hide caption',
		'id' => 'nivo_caption',
		'type' => 'select',
		'options' => array(
			array( "value" => "1", "text" => "Yes"),		
			array( "value" => "", "text" => "No"),
				
		),
		'desc' => 'Show or hide captions (titles) on slides.'
	) ,
	
	array(
		'name' => 'Direction Navigation',
		'id' => 'nivo_direction',
		'type' => 'select',
		'options' => array(
			array( "value" => "true", "text" => "True" ),
			array( "value" => "false", "text" => "False")
		),
		'desc' => 'Next &amp; Previous buttons.'
	) ,
	
	array(
		'name' => 'Control Navigation',
		'id' => 'nivo_controlnav',
		'type' => 'select',
		'options' => array(
			array( "value" => "true", "text" => "True" ),
			array( "value" => "false", "text" => "False")
		),
		'desc' => 'Control Navigation (e.g. 1,2,3...).'
	) ,
	
	array(
		'name' => 'Keyboard Navigation',
		'id' => 'nivo_keynav',
		'type' => 'select',
		'options' => array(
			array( "value" => "true", "text" => "True" ),
			array( "value" => "false", "text" => "False")
		),
		'desc' => 'Enable Keyboard navigation (left and right keys).'
	) ,
	
	
	array(
		'type' => 'toggle_close'
	) ,

	/*********************************************/

	
	/********** Camera Slider Options **********/
	array(
		'type' => 'toggle',
		'item_name' => 'Camera Slider',
		'toggle_id' => 'camera-slider'
	) ,
		
		array(
			'name' => 'Auto advance',
			'id' => $shortname.'_camera_autoadvance',
			'type' => 'select',
			'desc' => 'Auto advance the slides',
			'options' => array(
				array( "value" => "true", "text" => "True" ),
				array( "value" => "false", "text" => "False")
			),
		),	
		
		array(
			'name' => 'Sliding interval',
			'id' => $shortname.'_camera_interval',
			'type' => 'text',
			'desc' => 'Set the interval of slides, in milliseconds',
			'std' => 7000
		),	
		
		array(
			'name' => 'Transition length',
			'id' => $shortname.'_camera_ts',
			'type' => 'text',
			'desc' => 'Length of the sliding effect in milliseconds.',
			'std' => 1500
		),	
		
		array( 
			"name" => "Easing Effect",
			"desc" => "Choose between transition effects of the slider. Choose easeInOutExpo if you want it like in the demo.",
			"id" => $shortname."_camera_easing",
			"type" => "select",
			'options' => $tween_types
		),
		
		array(
			'name' => 'Thumbnails',
			'id' => $shortname.'_camera_thumbnails',
			'type' => 'select',
			'desc' => 'if pagination is enabled, will show thumbnails on hover to those links, if not, will generate a list of thumbnails on bottom of slider.',
			'options' => array(
				array( "value" => "true", "text" => "True" ),
				array( "value" => "false", "text" => "False")
			),
		) ,
		
		array(
			'name' => 'Bar Direction',
			'id' => $shortname.'_camera_bardirection',
			'type' => 'select',
			'desc' => 'Caption bar direction.',
			'options' => array(
				array( "value" => "leftToRight", "text" => "Left to right" ),
				array( "value" => "rightToLeft", "text" => "Right to left"),
				array( "value" => "topToBottom", "text" => "Top to bottom"),
				array( "value" => "bottomToTop", "text" => "Bottom to top")
			),
		) ,
		
		array(
			'name' => 'Bar Position',
			'id' => $shortname.'_camera_barposition',
			'type' => 'select',
			'desc' => 'Caption bar position.',
			'options' => array(
				array( "value" => "bottom", "text" => "Bottom"),
				array( "value" => "top", "text" => "Top"),
				array( "value" => "left", "text" => "Left" ),
				array( "value" => "right", "text" => "Right")
			),
		) ,
		
		array(
			'name' => 'Use Navigation',
			'id' => $shortname.'_camera_navigation',
			'type' => 'select',
			'desc' => 'Whether to use left and right arrows on slides.',
			'options' => array(
				array( "value" => "true", "text" => "True" ),
				array( "value" => "false", "text" => "False")
			),
		) ,

		array(
			'name' => 'Use pagination',
			'id' => $shortname.'_camera_pagination',
			'type' => 'select',
			'desc' => 'Whether to use pagination links.',
			'options' => array(
				array( "value" => "true", "text" => "True" ),
				array( "value" => "false", "text" => "False")
			),
		) ,		
		
		array(
			'name' => 'Skin',
			'id' => $shortname.'_camera_skin',
			'type' => 'select',
			'desc' => 'Chose between various color skins.',
			'options' => array(
				array( "value" => "black", "text" => "Black (default)"),
				array( "value" => "amber", "text" => "Amber" ),
				array( "value" => "ash", "text" => "Ash" ),
				array( "value" => "azure", "text" => "Azure"),
				array( "value" => "beige", "text" => "Beige"),
				array( "value" => "blue", "text" => "Blue"),
				array( "value" => "brown", "text" => "Brown"),
				array( "value" => "burgundy", "text" => "Burgundy"),
				array( "value" => "charcoal", "text" => "Charcoal"),
				array( "value" => "chocolate", "text" => "Chocolate"),
				array( "value" => "coffee", "text" => "Coffee"),
				array( "value" => "cyan", "text" => "Cyan"),
				array( "value" => "fuchsia", "text" => "Fuchsia"),
				array( "value" => "gold", "text" => "Gold"),
				array( "value" => "green", "text" => "Green"),
				array( "value" => "grey", "text" => "Grey"),
				array( "value" => "indigo", "text" => "Indigo"),
				array( "value" => "khaki", "text" => "Khaki"),
				array( "value" => "lime", "text" => "Lime"),
				array( "value" => "magenta", "text" => "Magenta"),
				array( "value" => "maroon", "text" => "Maroon"),
				array( "value" => "orange", "text" => "Orange"),
				array( "value" => "olive", "text" => "Olive"),
				array( "value" => "pink", "text" => "Pink"),
				array( "value" => "pistachio", "text" => "Pistachio"),
				array( "value" => "red", "text" => "Red"),
				array( "value" => "tangerine", "text" => "Tangerine"),
				array( "value" => "turquoise", "text" => "Turquoise"),
				array( "value" => "violet", "text" => "Violet"),
				array( "value" => "white", "text" => "White"),
				array( "value" => "yellow", "text" => "Yellow")
			),
		) ,
	
	array(
		'type' => 'toggle_close'
	),	

	/*********************************************/
	
	
	/********** iView Slider Options **********/
	array(
		'type' => 'toggle',
		'item_name' => 'iView Slider',
		'toggle_id' => 'iview-slider'
	) ,
		
		array(
			'name' => 'Auto advance',
			'id' => $shortname.'_iview_autoadvance',
			'type' => 'select',
			'desc' => 'Auto advance the slides',
			'options' => array(
				array( "value" => "true", "text" => "True" ),
				array( "value" => "false", "text" => "False")
			),
		),	
		
		array(
			'name' => 'Sliding interval',
			'id' => $shortname.'_iview_interval',
			'type' => 'text',
			'desc' => 'Set the interval of slides, in milliseconds',
			'std' => 7000
		),	
		
		array(
			'name' => 'Easing effect',
			'id' => $shortname.'_iview_easing',
			'type' => 'select',
			'desc' => 'transition effects of the slider. Choose easeInOutExpo if you want it like in the demo.',
			'options' => $tween_types
		),	
		
		array(
			'name' => 'Use Navigation',
			'id' => $shortname.'_iview_navigation',
			'type' => 'select',
			'desc' => 'Whether to use left and right arrows on slides.',
			'options' => array(
				array( "value" => "true", "text" => "True" ),
				array( "value" => "false", "text" => "False")
			),
		) ,

		array(
			'name' => 'Use pagination',
			'id' => $shortname.'_iview_pagination',
			'type' => 'select',
			'desc' => 'Whether to use pagination links.',
			'options' => array(
				array( "value" => "true", "text" => "True" ),
				array( "value" => "false", "text" => "False")
			),
		),
	
	array(
		'type' => 'toggle_close'
	),	

	/*********************************************/
	
	/**************** 3D Slider Options ****************/
	array(
		'type' => 'toggle',
		'item_name' => '3D Slider (Piecemaker 2)',
		'toggle_id' => '3d-slider'
	) ,
	
	array( 
		"name" => "Width",
		"desc" => "Width of the slider image in pixels.",
		"id" => $shortname."_slider3dimgw",
		"type" => "text",
		"std" => "980"
	),
	
	array( 
		"name" => "Height",
		"desc" => "Height of the slider image in pixels.",
		"id" => $shortname."_slider3dimgh",
		"type" => "text",
		"std" => "377"
	),
	
	array( 
		"name" => "Loader Color",
		"desc" => "Color of the cubes before the first image appears, also the color of the back sides of the cube, which become visible at some transition types",
		"id" => $shortname."_3D_loadercolor",
		"type" => "text",
		"std" => "0x333333"
	),
	
	array( 
		"name" => "Inner Side Color",
		"desc" => "Color of the inner sides of the cube when sliced.",
		"id" => $shortname."_3D_iscolor",
		"type" => "text",
		"std" => "0x222222"
	),
	
	array( 
		"name" => "Side Shadow Alpha",
		"desc" => "Sides get darker when moved away from the front. This is the degree of darkness - 0 == no change, 1 == 100% black.",
		"id" => $shortname."_3D_SideShadowAlpha",
		"type" => "text",
		"std" => "0.8"
	),
	
	array( 
		"name" => "Drop Shadow Alpha",
		"desc" => "Alpha of the drop shadow - 0 == no shadow, 1 == opaque.",
		"id" => $shortname."_3D_DropShadowAlpha",
		"type" => "text",
		"std" => "0.7"
	),
	
	array( 
		"name" => "Drop Shadow Distance",
		"desc" => "Distance of the shadow from the bottom of the image.",
		"id" => $shortname."_3D_DropShadowDistance",
		"type" => "text",
		"std" => "25"
	),
	
	array( 
		"name" => "Drop Shadow Scale",
		"desc" => "As the shadow is blurred, it appears wider that the actual image, when not resized. Thus its a good idea to make it slightly smaller. - 1 would be no resizing at all..",
		"id" => $shortname."_3D_DropShadowScale",
		"type" => "text",
		"std" => "0.95"
	),
	
	array( 
		"name" => "Drop Shadow Blur X",
		"desc" => "Blur of the drop shadow on the x-axis.",
		"id" => $shortname."_3D_DropShadowBlurX",
		"type" => "text",
		"std" => "40"
	),
	
	array( 
		"name" => "Drop Shadow Blur Y",
		"desc" => "Blur of the drop shadow on the y-axis.",
		"id" => $shortname."_3D_DropShadowBlurY",
		"type" => "text",
		"std" => "4"
	),
	
	array( 
		"name" => "Menu Distance X",
		"desc" => "Distance between two menu items (from center to center).",
		"id" => $shortname."_3D_MDX",
		"type" => "text",
		"std" => "20"
	),
	
	array( 
		"name" => "Menu Distance Y",
		"desc" => "Distance of the menu from the bottom of the image.",
		"id" => $shortname."_3D_MDY",
		"type" => "text",
		"std" => "50"
	),
	
	array( 
		"name" => "Menu Color 1",
		"desc" => "Color of an inactive menu item.",
		"id" => $shortname."_3D_Menu_Color1",
		"type" => "text",
		"std" => "0x999999"
	),
	
	array( 
		"name" => "Menu Color 2",
		"desc" => "Color of an active menu item.",
		"id" => $shortname."_3D_Menu_Color2",
		"type" => "text",
		"std" => "0x333333"
	),
	
	array( 
		"name" => "Menu Color 3",
		"desc" => "Color of the inner circle of an active menu item. Should equal the background color of the whole thing.",
		"id" => $shortname."_3D_Menu_Color3",
		"type" => "text",
		"std" => "0xFFFFFF"
	),
	
	array( 
		"name" => "Control Size",
		"desc" => "Size of the controls, which appear on rollover (play, stop, info, link).",
		"id" => $shortname."_3D_Control_Size",
		"type" => "text",
		"std" => "70"
	),
	
	array( 
		"name" => "Control Distance",
		"desc" => "Distance between the controls (from the borders).",
		"id" => $shortname."_3D_Control_Distance",
		"type" => "text",
		"std" => "20"
	),
	
	array( 
		"name" => "Control Color 1",
		"desc" => "Background color of the controls.",
		"id" => $shortname."_3D_Control_Color1",
		"type" => "text",
		"std" => "0x222222"
	),
	
	array( 
		"name" => "Control Color 2",
		"desc" => "Font color of the controls.",
		"id" => $shortname."_3D_Control_Color2",
		"type" => "text",
		"std" => "0xFFFFFF"
	),
	
	array( 
		"name" => "Control Alpha",
		"desc" => "Alpha of a control, when mouse is not over.",
		"id" => $shortname."_3D_Control_Alpha",
		"type" => "text",
		"std" => "0.8"
	),
	
	array( 
		"name" => "Control Alpha Over",
		"desc" => "Alpha of a control, when mouse is over.",
		"id" => $shortname."_3D_Control_Alpha_Over",
		"type" => "text",
		"std" => "0.95"
	),	
	
	array( 
		"name" => "Controls X",
		"desc" => "X-position of the point, which aligns the controls (measured from [0,0] of the image).",
		"id" => $shortname."_3D_Controls_X",
		"type" => "text",
		"std" => "500"
	),
	
	array( 
		"name" => "Controls Y",
		"desc" => "Y-position of the point, which aligns the controls (measured from [0,0] of the image).",
		"id" => $shortname."_3D_Controls_Y",
		"type" => "text",
		"std" => "250"
	),
	
	array( 
		"name" => "Controls Align",
		"desc" => "Type of alignment from the point [controlsX, controlsY] - can be \"center\", \"left\" or \"right\".",
		"id" => $shortname."_3D_Control_Align",
		"type" => "text",
		"std" => "center"
	),
	
	array( 
		"name" => "Tooltip Height",
		"desc" => "Height of the tooltip surface in the menu.",
		"id" => $shortname."_3D_Tooltip_Height",
		"type" => "text",
		"std" => "31"
	),
	
	array( 
		"name" => "Tooltip Color",
		"desc" => "Color of the tooltip surface in the menu.",
		"id" => $shortname."_3D_Tooltip_Color",
		"type" => "text",
		"std" => "0x222222"
	),
	
	array( 
		"name" => "Tooltip Text Y",
		"desc" => "Y-distance of the tooltip text field from the top of the tooltip.",
		"id" => $shortname."_3D_Tooltip_Text_Y",
		"type" => "text",
		"std" => "5"
	),
	
	array( 
		"name" => "Tooltip Text Style",
		"desc" => "The style of the tooltip text, specified in the CSS file.",
		"id" => $shortname."_3D_Tooltip_Text_Style",
		"type" => "text",
		"std" => "P-Italic"
	),
	
	array( 
		"name" => "Tooltip Text Color",
		"desc" => "Color of the tooltip text.",
		"id" => $shortname."_3D_Tooltip_Text_Color",
		"type" => "text",
		"std" => "0xFFFFFF"
	),
	
	array( 
		"name" => "Tooltip Margin Left",
		"desc" => "Margin of the text to the left end of the tooltip.",
		"id" => $shortname."_3D_Tooltip_Margin_Left",
		"type" => "text",
		"std" => "5"
	),
	
	array( 
		"name" => "Tooltip Margin Right",
		"desc" => "Margin of the text to the right end of the tooltip.",
		"id" => $shortname."_3D_Tooltip_Margin_Right",
		"type" => "text",
		"std" => "7"
	),
	
	array( 
		"name" => "Tooltip Text Sharpness",
		"desc" => "Sharpness of the tooltip text (-400 to 400).",
		"id" => $shortname."_3D_Tooltip_Text_Sharpness",
		"type" => "text",
		"std" => "50"
	),
	
	array( 
		"name" => "Tooltip Text Thickness",
		"desc" => "Thickness of the tooltip text (-400 to 400).",
		"id" => $shortname."_3D_Tooltip_Text_Thickness",
		"type" => "text",
		"std" => "-100"
	),
	
	array( 
		"name" => "Info Width",
		"desc" => "The width of the info text field.",
		"id" => $shortname."_3D_Info_Width",
		"type" => "text",
		"std" => "400"
	),
	
	array( 
		"name" => "Info Background",
		"desc" => "The background color of the info text field.",
		"id" => $shortname."_3D_Info_Background",
		"type" => "text",
		"std" => "0xFFFFFF"
	),
	
	array( 
		"name" => "Info Background Alpha",
		"desc" => "The alpha of the background of the info text, the image shines through, when smaller than 1.",
		"id" => $shortname."_3D_Info_Background_Alpha",
		"type" => "text",
		"std" => "0.95"
	),
	
	array( 
		"name" => "Info Margin",
		"desc" => "The margin of the text field in the info section to all sides.",
		"id" => $shortname."_3D_Info_Margin",
		"type" => "text",
		"std" => "15"
	),
	
	array( 
		"name" => "Info Sharpness",
		"desc" => "Sharpness of the info text (see above).",
		"id" => $shortname."_3D_Info_Sharpness",
		"type" => "text",
		"std" => "0"
	),
	
	array( 
		"name" => "Info Thickness",
		"desc" => "Thickness of the info text (see above).",
		"id" => $shortname."_3D_Info_Thickness",
		"type" => "text",
		"std" => "0"
	),
	
	array( 
		"name" => "Autoplay",
		"desc" => "Number of seconds from one transition to another, if not stopped. Set to 0 to disable autoplay.",
		"id" => $shortname."_3D_Autoplay",
		"type" => "text",
		"std" => "10"
	),
	
	array( 
		"name" => "Field Of View",
		"desc" => "see the official  Adobe Docs.",
		"id" => $shortname."_3D_FieldOfView",
		"type" => "text",
		"std" => "45"
	),	
		
	array(
		'type' => 'toggle_close'
	),
	

	/*********************************************/
	
	array( "type" => "close"), 
	/*********************************************/
	
	
	/*******************  BLOG  ******************/
	array(
		'type' => 'open',
		'tab_name' => 'Blog',
		'tab_id' => 'blog'
	) ,
	
	
	array( 
		"name" => "Read More text",
		"desc" => "Caption of permalink buttons in blog listing",
		"id" => $shortname."_blogreadmore",
		"type" => "text",
		"std" => "Read More"
	),
	
	array( 
		"name" => "Show date",
		"desc" => "Date on blog posts listing page.",
		"id" => $shortname."_blog_show_date",
		"type" => "select",
		'options' => array(
			array( "value" => "1", "text" => "Yes"),
			array( "value" => "0", "text" => "No")
		)
	),
	
	array( 
		"name" => "Show Comments count",
		"desc" => "Comments amount on blog posts listing page.",
		"id" => $shortname."_blog_show_comments",
		"type" => "select",
		'options' => array(
			array( "value" => "1", "text" => "Yes"),
			array( "value" => "0", "text" => "No")
		)
	),
	
	array( 
		"name" => "Show Author",
		"desc" => "Author name on blog posts",
		"id" => $shortname."_blog_show_author",
		"type" => "select",
		'options' => array(
			array( "value" => "1", "text" => "Yes"),
			array( "value" => "0", "text" => "No")
		)
	),
	
	array( 
		"name" => "Show Related Posts (Inner Page)",
		"desc" => "Related Posts on blog's inner page.",
		"id" => $shortname."_blog_show_rp",
		"type" => "select",
		'options' => array(
			array( "value" => "1", "text" => "Yes"),
			array( "value" => "0", "text" => "No")
		)
	),
	
	
	array( "type" => "close"),
	/*********************************************/
	
	
	
	/**************  CONTACT FORM  ***************/
	array(
		'type' => 'open',
		'tab_name' => 'Contact form',
		'tab_id' => 'contact-form'
	) ,
	array(
		'name' => 'Email Address',
		'id' => $shortname.'_email_address',
		'type' => 'text',
		'std' => 'your_email@domain.com',
		'desc' => 'Enter your e-mail address.'
	) ,
	array(
		'name' => 'Subject',
		'id' => $shortname . '_subject',
		'type' => 'text',
		'std' => 'Website visitor',
		'desc' => ''
	) ,
	
	array(
		'name' => 'Contact Address (Google Map)',
		'id' => $shortname . '_contact_address',
		'type' => 'text',
		'std' => '',
		'desc' => 'Set your address here to appear on google map. (example: 1319 Stanley avenue, Glendale, Los Angeles, USA)'
	) ,
	
	
	array(
		'name' => 'Success Message',
		'id' => $shortname . '_contact_success_message',
		'type' => 'text',
		'std' => 'Thank you. We will get back as soon as possible',
		'desc' => 'When the e-mail is successfully sent.'
	) ,
	array(
		'name' => 'Sending Error Message',
		'id' => $shortname . '_contact_error_message',
		'type' => 'text',
		'std' => 'An error occured. Please try again.',
		'desc' => 'If there was an error sending the message.'
	) ,

	array(
		'type' => 'close'
	) ,
	/*****************************************************/	
);

?>