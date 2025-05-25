<?php
function blog_enqueue_styles()
{
	wp_enqueue_style(
		"blog-style",
		get_template_directory_uri() . "/assets/css/tailwind-output.min.css"
	);
}
add_action("wp_enqueue_scripts", "blog_enqueue_styles");

function mytheme_enqueue_scripts()
{
	wp_enqueue_script(
		"react-bundle",
		get_template_directory_uri() . "/dist/main.js",
		[],
		null,
		true // true ? footer出力 : head出力
	);
}
add_action("wp_enqueue_scripts", "mytheme_enqueue_scripts");

function enqueue_react_app()
{
	wp_enqueue_script("react-app", get_template_directory_uri() . "/dist/main.js", [], null, true);

	wp_localize_script("react-app", "APP_CONFIG", [
		"BASE_URL" => get_template_directory_uri(),
	]);
}
add_action("wp_enqueue_scripts", "enqueue_react_app");
