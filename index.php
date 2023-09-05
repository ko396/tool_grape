<!doctype html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>ぶどう計算機</title>
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <script src="assets/js/garlic.min.js"></script>
  <script src="assets/js/decimal.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <script>
    $(function() {
      const $all = $('.js-calc-all');

      //合計計算
      const GetAll = function() {
        let tmp = 0;
        $('.js-calc-gokei').each(function() {
          if ($(this).val()) {
            tmp += Number($(this).val());
          }
        })
        $all.html(tmp);
      }

      //各項計算
      const SetValue = function(elm) {
        console.log(1);
        const $wrap = elm.closest('.js-calc-wrap');
        const $omosa_grape = $wrap.find('.js-calc-input2');
        const $omosa_box = $wrap.find('.js-calc-input3');
        const $omosa_only = $wrap.find('.js-calc-input4');
        const $tanka = $wrap.find('.js-calc-input5');
        const $gokei = $wrap.find('.js-calc-gokei');

        //ぶどうだけの重さ
        let omosa_grape_val = 0;
        if ($omosa_grape.val()) {
          omosa_grape_val = new Decimal($omosa_grape.val());
        } else {
          omosa_grape_val = new Decimal(0);
        }
        let omosa_box_val = 0;
        if ($omosa_box.val()) {
          omosa_box_val = new Decimal($omosa_box.val());
        } else {
          omosa_box_val = new Decimal(0);
        }

        let omosa_only = omosa_grape_val.sub(omosa_box_val).toNumber();
        $omosa_only.html(omosa_only);

        //金額
        let gokei = omosa_only * $tanka.val();
        gokei = Math.floor(gokei);
        $gokei.val(gokei);

        //合計
        GetAll();

      }

      $('.js-calc-wrap input').on('change, input', function() {
        if ($(this).hasClass('js-calc-gokei')) {} else {
          SetValue($(this));
        }
      })

      $('.js-calc-gokei').on('change, input', function() {
        GetAll();
      });
     

    });
  </script>


</head>

<body>
  <main class="l-main1">
    <h1 class="c-title1">ぶどう計算機</h1>

    <form data-persist="garlic" method="POST">

      <?php for ($i = 0; $i < 14; $i++) {

        $name = "";
        if ($i == 0) {
          $name = "シャインマスカット";
        } else if ($i == 1) {
          $name = "安芸クイーン";
        } else if ($i == 2) {
          $name = "ハニーシードレス";
        } else if ($i == 3) {
          $name = "ハニーブラック";
        } else if ($i == 4) {
          $name = "ピオーネ";
        } else if ($i == 5) {
          $name = "ゴールドフィンガー";
        } else if ($i == 6) {
          $name = "ロザリコ・ビアンコ";
        }

      ?>

        <div class="c-frame1 js-calc-wrap">

          <div class="c-frame1__head1">
            <div class="c-frame1__block1">
              <input type="text" name="<?php echo $i; ?>_1" value="<?php echo $name; ?>" class="c-input1 js-calc-input1">
            </div>
          </div>

          <div class="c-frame1__body1">
            <table class="c-table1">
              <tr>
                <td>
                  <span class="c-text1">ぶどうの重さ</span>
                </td>
                <td>
                  <input type="number" step="0.1" name="<?php echo $i; ?>_2" class="c-input1 js-calc-input2" placeholder="3.5">
                </td>
                <td>
                  <span class="c-text2">kg</span>
                </td>
              </tr>

              <tr>
                <td>
                  <span class="c-text1">箱の重さ</span>
                </td>
                <td>
                  <input type="number" step="0.1" name="<?php echo $i; ?>_3" value="" class="c-input1 js-calc-input3" placeholder="0.8">
                </td>
                <td>
                  <span class="c-text2">kg</span>
                </td>
              </tr>

              <tr>
                <td>
                  <span class="c-text1">ぶどうだけの重さ</span>
                </td>
                <td>
                  <div class="c-input2 js-calc-input4">&nbsp;</div>
                </td>
                <td>
                  <span class="c-text2">kg</span>
                </td>
              </tr>

              <tr>
                <td>
                  <span class="c-text1">ぶどうの単価</span>
                </td>
                <td>
                  <input type="number" name="<?php echo $i; ?>_4" value="" class="c-input1 js-calc-input5" placeholder="1500">
                </td>
                <td>
                  <span class="c-text2">円/kg</span>
                </td>
              </tr>
            </table>

          </div>

          <div class="c-frame1__foot1">
            <table class="c-table2">
              <tr>
                <td>
                  <span class="c-text3">金額</span>
                </td>
                <td>
                  <input type="number" name="<?php echo $i; ?>_gokei" value="" class="c-input1 js-calc-gokei">
                </td>
                <td>
                  <span class="c-text3">円</span>
                </td>
              </tr>
            </table>
          </div>

        </div>

      <?php } ?>

    </form>


    <div class="c-fixed1">
      <span class="c-text3">合計</span>
      <div class="c-input3 js-calc-all">0</div>
      <span class="c-text3">円</span>
    </div>


  </main>
</body>

</html>