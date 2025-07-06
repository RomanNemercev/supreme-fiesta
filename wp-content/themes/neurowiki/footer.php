<?php

/**
 * The Footer for our theme
 *
 * This is the template that displays the footer content
 */
?>
<footer>
    <div class="container">
        <p>© <?php echo esc_html(get_bloginfo('name')); ?> <?php echo date('Y'); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>