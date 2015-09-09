<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php echo wp_title('|',true,'right'); ?></title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="global" class="global">
    <div class="pusher">

				
				<?php
//BEGIN Added by Sam Oakley

				// test for if group page
				
				/*
				//if ((bp_is_groups_component())&&(!bp_is_user())){
				if (bp_is_group()){
					if (is_translation_group()){
						echo "This is a Translation Group<br/>";
						} else {
							echo "NOT a Translation Group<br/>";
						}
				}
				*/
				
				/*			
				// test for is profile page
				
				if (bp_is_user()){
					if (member_is_in_translation_group()){
						echo "Member is in Translation Group<br/>";
						} else {
							echo "Member is NOT in a Translation Group<br/>";				
						}
				
				}
				*/
			
				/*
			
						if ( (bp_is_group())&&(is_translation_group()) ){				
							echo "This is a Translation Group<br/>";
							} else {
							echo "NOT a Translation Group<br/>";
						}
						
					if ( (bp_is_user())&&(member_is_in_translation_group())  ){
						echo "Member is in Translation Group<br/>";
						} else {
							echo "Member is NOT in a Translation Group<br/>";				
						}
			*/
						
				
//END Added by Sam Oakley
				?>
				
        <header>
            <div class="container"></div>
        </header>

