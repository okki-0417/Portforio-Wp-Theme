<?php
  $secrets = require get_template_directory() . "/config/secret.php";
  $token = $secrets["github_token"];
?>

<section>
  <h3 class="lg:text-3xl text-2xl mt-8 font-semibold">Github Repos</h3>

  <?php
    $response = wp_remote_get("https://api.github.com/users/okki-0417/repos?sort=pushed&page=1&per_page=4",
      [
        "headers" => [
          "Authorization" => "Bearer $token",
          "Accept" => "application/json",
        ]
      ]);

    if (is_wp_error($response)) {
      echo "API取得失敗";
    } else {
      $body = wp_remote_retrieve_body($response);
      $data = json_decode($body, true);
    };
  ?>

  <div class="mt-4 grid grid-cols-2 gap-4">
    <?php if (!empty($data)): ?>
      <?php foreach ($data as $repo): ?>
        <article class="lg:col-span-1 col-span-2 w-full hover:opacity-50">
          <a href="<?= $repo["html_url"]; ?>" target="blank">
            <div class="grid grid-cols-4 gap-2 p-2">
              <div class="col-span-1 p-2">
                <img src="<?= get_template_directory_uri(); ?>/assets/images/github/github-mark.png" alt="">
              </div>

              <div class="col-span-3 flex flex-col">
                <h4 class="text-lg font-semibold uppercase"><?= $repo["name"]; ?></h4>
                <div class="flex flex-col h-full">
                  <p class="line-clamp-2 h-full"><?= $repo["description"]; ?></p>

                  <?php
                    $lang_response = wp_remote_get($repo["languages_url"],
                      [
                        "headers" => [
                          "Authorization" => "Bearer $token",
                          "Accept" => "application/json",
                        ]
                      ]);
                    if (is_wp_error($lang_response)) {
                      echo "API取得失敗";
                    } else {
                      $lang_body = wp_remote_retrieve_body($lang_response);
                      $lang_data = json_decode($lang_body, true);
                    };
                  ?>

                  <?php if (!empty($lang_data)): ?>
                    <?php $lang_names = array_keys($lang_data); ?>

                    <ul class="flex gap-1 text-xs grow-0">
                      <?php foreach ($lang_names as $name): ?>
                        <li>
                          <?= $name; ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>

                  <p class="text-xs text-right text-gray-500 grow-0">
                    <span>Last Pushed:</span>
                    <?php
                      $date = new DateTime($repo["pushed_at"]);
                      echo $date->format('Y年n月j日');
                    ?>
                  </p>
                </div>
              </div>
            </div>

          </a>
        </article>
      <?php endforeach; ?>

    <?php else: ?>
      <p>リポジトリが見つかりませんでした。</p>
    <?php endif; ?>
  </div>

  <div class="text-right">
    <a href="https://github.com/okki-0417" class="text-blue-500 underline" target="blank">もっと見る</a>
  </div>
</section>
