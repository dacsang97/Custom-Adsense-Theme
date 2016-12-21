<?php
/**
 * The template for displaying the search form.
 */
?>
<?php
$mts_options = get_option(MTS_THEME_NAME);
?><form method="get" id="searchform" class="search-form" action="<?php echo esc_attr( home_url() ); ?>" _lpchecked="1">
	<fieldset>
		<input type="text" name="s" id="s" value="<?php the_search_query(); ?>"<?php if (!empty($mts_options['mts_ajax_search'])) echo ' autocomplete="off"'; ?> />
		<i id="search-image" class="sbutton fa fa-search"></i>
	</fieldset>
</form>
