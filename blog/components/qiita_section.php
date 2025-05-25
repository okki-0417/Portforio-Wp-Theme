<?php
  $secrets = require get_template_directory() . "/config/secret.php";
  $token = $secrets["qiita_token"];
?>

<section>
  <h3 class="lg:text-3xl text-2xl mt-8 font-semibold">Qiita</h3>

  <?php
    $response = wp_remote_get("https://qiita.com/api/v2/authenticated_user/items?page=1&per_page=4",
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

  <?php if (!empty($data)): ?>
    <div class="mt-4 grid grid-cols-2 gap-4">
      <?php foreach ($data as $post): ?>
        <a href="<?= esc_url($post["url"]); ?>" target="_blank" class="lg:col-span-1 col-span-2">
          <article
            class="p-2 grid grid-cols-4 gap-1 hover:opacity-70"
          >
            <div class="col-span-1 p-3">
              <img
                src="<?= get_template_directory_uri(); ?>/assets/images/qiita/qiita-icon.png"
                alt="Qiita"
                class="w-full object-contain"
              />
            </div>

            <div class="col-span-3">
              <h4 class="lg:text-base text-sm line-clamp-2 font-semibold"><?= $post["title"]; ?></h4>
              <p class="text-xs line-clamp-2"><?= $post["body"]; ?></p>
              <p class="mt-1 text-xs text-right text-gray-500">
                <?php
                  $date = new DateTime($post['created_at']);
                  echo $date->format('Y年n月j日');
                ?>
              </p>
            </div>
          </article>
        </a>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p>記事が見つかりませんでした。</p>
  <?php endif; ?>

  <div class="text-right">
    <a href="https://qiita.com/okki-0417" class="text-blue-500 underline" target="blank">もっと見る</a>
  </div>
</section>
