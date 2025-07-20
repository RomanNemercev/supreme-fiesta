<?php get_header(); ?>
<main class="main">
    <div class="breadcrumbs">
        <a href="<?php echo home_url(); ?>" class="breadcrumbs__item breadcrumbs__item--active">Главная</a>
        <span class="breadcrums__separator">-</span>
        <a href="<?php echo get_post_type_archive_link('neural_network'); ?>" class="breadcrumbs__item">Все нейросети</a>
    </div>
    <h1 class="main__title">Единый каталог нейросетей</h1>
    <div class="filters">
        <!-- Фильтры заглушка -->
        <div class="filtes__placeholder">Фильтры (в разработке)</div>
    </div>
    <div class="results">
        <p>Найдено: <?php echo wp_count_posts('neural_network')->publish ?> нейросетей</p>
        <!-- Сортировка заглушка -->
        <select class="results__sort">
            <option value="date">По дате</option>
            <option value="rating">По рейтингу</option>
        </select>
    </div>
    <div class="cards">
        <?php
        $args = [
            'post_type' => 'neural_network',
            'posts_per_page' => 9,
        ];
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/card', 'neural-network');
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Нейросети не найдены.</p>';
        endif;
        ?>
    </div>
</main>
<?php get_footer(); ?>