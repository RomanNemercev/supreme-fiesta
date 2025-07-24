<article class="card">
    <div class="card__header">
        <img class="card__logo" src="<?php echo get_the_post_thumbnail_url() ?: get_template_directory_uri() . '/assets/img/src/placeholder.png'; ?>" alt="ai-logo">
        <h3 class="card__title"><?php the_title(); ?></h3>
        <div class="card__rating">
            <span class="card__rating-value"><?php echo get_field('rating') ?: '0.0'; ?></span>
            <span class="card__rating-icon">★</span>
        </div>
    </div>
    <div class="card__description">
        <p><?php echo wp_trim_words(get_the_content(), 30, '...'); ?></p>
    </div>
    <div class="card__tags">
        <?php
        $tags = get_field('tags');
        if (is_array($tags)) {
            foreach ($tags as $tag) {
                $tag_class = '';
                switch (esc_html($tag)) {
                    case 'VPN: не нужен':
                        $tag_class = 'card__tag--vpn-no';
                        break;
                    case 'Работа с текстом':
                        $tag_class = 'card__tag--text-work';
                        break;
                    case 'Условно бесплатно':
                        $tag_class = 'card__tag--free';
                        // Добавляй другие случаи по необходимости
                }
                echo '<span class="card__tag ' . $tag_class . '">' . esc_html($tag) . '</span>';
            }
        }
        ?>
    </div>
</article>