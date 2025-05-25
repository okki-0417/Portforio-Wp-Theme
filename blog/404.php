<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo("name"); ?></title>
    <?php wp_head(); ?>
  </head>

  <body class="h-screen overflow-hidden">
    <?php get_template_part("components/header"); ?>

    <div class="w-screen h-full flex justify-center items-center">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.png" alt="404" class="object-contain w-lg">
    </div>
  </body>
</html>
