<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo("name"); ?></title>
    <?php wp_head(); ?>
  </head>

  <body class="text-gray-800">
    <div class="bg-pink-50 max-w-screen min-h-screen flex flex-col">
      <div>
        <?php get_template_part("components/header"); ?>
      </div>

      <main class="lg:mt-24 mt-12 grow">
        <ul class="mt-2 px-4 lg:text-base text-sm max-w-screen-lg mx-auto">
          <li>
            >
            <a href="<?php home_url('/'); ?>" class="underline text-blue-500">トップ</a>
          </li>
        </ul>

        <div class="lg:mt-8 mt-2">
          <div id="main-visual"></div>
        </div>

        <div class="lg:mt-32 mt-18 grid grid-cols-3 max-w-screen-xl mx-auto px-3">
          <div class="lg:col-span-2 col-span-3">
            <h2 class="lg:text-5xl text-3xl font-semibold uppercase tracking-tight">What's New</h2>
            <hr>

            <?php get_template_part("components/qiita_section"); ?>
            <?php get_template_part("components/github_section"); ?>
          </div>

          <aside class="lg:col-span-1 lg:block hidden">
            <div class="mt-4 max-w-72 mx-auto">
              <div class="flex justify-center">
                <img src="https://www.gravatar.com/avatar/b579cdaddff632251a36c4fead94f6a5?s=300" alt="" class="size-64">
              </div>

              <p class="mt-2 text-xl font-bold text-center">
                @murai
              </p>

              <div class="mt-4 flex flex-col gap-2">
                大学生で、開発のインターンを2024年7月から続けています。
                バックエンドは Rails, フロントエンドは React/Next.js を中心に勉強しています。 デプロイはTrraformとAWSを勉強中です。
                AIに関しては少し置いてけぼりなので頑張りたいです。
                やるべきことを後回しないこと、知らないことがあったら調べることをモットーにしています。
              </div>
            </div>
          </aside>
        </div>
      </main>

      <div>
        <?php get_template_part("components/footer"); ?>
      </div>

    </div>
  </body>
</html>
