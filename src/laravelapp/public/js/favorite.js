// お気に入りボタンのクリックイベントをハンドリング
document.querySelectorAll('.toggle-favorite').forEach(button => {
  button.addEventListener('click', function (event) {
      event.preventDefault(); // デフォルトのクリックイベントをキャンセル

      // リンク先のURLを取得
      const url = this.getAttribute('href');
      console.log(url); // デベロッパーツールのコンソールログにURLを表示

      // 非同期リクエストを送信
      fetch(url, {
          method: 'GET',
          headers: {
              'X-Requested-With': 'XMLHttpRequest' // LaravelのCSRFトークン対策
          }
      })
      .then(response => response.json())
      .then(data => {
        console.log(data); // デベロッパーツールのコンソールログにレスポンスデータを表示
          // リクエストが成功した場合はお気に入りボタンのテキストを更新
          if (data.success) {
              if (data.isFavorite) {
                  this.textContent = 'お気に入り解除';
              } else {
                  this.textContent = 'お気に入り';
              }

            //   // お気に入り登録が成功したことをポップアップメッセージで表示
            //   Swal.fire({
            //     icon: 'success',
            //     title: 'お気に入りに登録しました',
            //     showConfirmButton: false,
            //     timer: 1500 // メッセージを表示する時間（ミリ秒）
            // });
          }
      })
      .catch(error => console.error(error));
  });
});
