MyNumber-PHP
============

MyNumber-PHP はマイナンバーの検証やダミーデータの生成を行う PHP ライブラリです。MIT ライセンスで提供しています。

使い方
------

### 環境 ###

* PHP 5.3.3 以上（できるだけ新しいほうが良いです）

### 準備 ###

1. まだ設定していなければ [Composer](https://getcomposer.org/) を使えるようにします。具体的な方法は [Download Composer](https://getcomposer.org/download/) を確認してください。

2. 現在のあなたのソースコードで Composer を使用していなければ、次のコマンドを実行してください。

    ```sh
    php composer.phar init
    ```

    あなたのソースコード（プロジェクト）についていくつか質問されますので適当に答えてください。完了すると `composer.json` ファイルが生成されます。

3. `jp3cki/mynumber` を Composer 経由でインストールします。
           
    - 開発時にのみ使用し、本番では使用しない場合（例えばテストデータの生成のみに使用する場合）
                       
        ```sh
        php composer.phar require --dev jp3cki/mynumber
        ```

    - 本番でも使用する場合

        ```sh
        php composer.phar require jp3cki/mynumber
        ```

4. これで利用の準備が整いました。


詳しくは Composer のウェブサイトか、Composer の解説サイトを参照してください。

なお、 Composer 経由でインストールしたライブラリ等を使用する際は、あなたのプログラムの最初の方で `vendor/autoload.php` を `require` または `include` してください。

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
```

### 利用 ###

#### 入力値の検証 ####

マイナンバーの最後（最も右）の桁はチェックディジットになっています。

`jp3cki\mynumber\MyNumber::isValid()` は 12 桁の数字からなる文字列を受け取り、チェックディジットが正しいことを確認します。

```php
<?php
use jp3cki\mynumber\MyNumber;

require_once(__DIR__ . '/vendor/autoload.php');

$tests = array(
    // 正しい https://gist.github.com/ninoseki/a7e59bb74202a5252baf
    '895980423139',
    '436673173767',
    '430792811528',
    '107611545184',
    '964041141335',
    '044580705690',
    '439023617171',
    '680557982222',
    '335790979402',
    '763625921000',

    // 壊れている https://gist.github.com/ninoseki/b179215570d7605ce03f
    '828731078542',
    '430663651143',
    '211421187381',
    '627852730078',
    '693415034651',
    '189518719745',
    '105892595337',
    '491136797254',
    '345537562761',
    '348049767367',
);

foreach ($tests as $myNumber) {
    if (MyNumber::isValid($myNumber)) {
        echo "{$myNumber} is a valid ID\n";
    } else {
        echo "{$myNumber} is not a valid ID\n";
    }
}
```

#### ダミーデータの作成 ####

`jp3cki\mynumber\MyNumber::generate()` はチェックディジットが正しい（理論上存在しうる）番号をランダムに生成します。

マイナンバー自体が 10<sup>11</sup> = 1000 億通りしか存在しないため、完全にランダムに生成した場合でもマイナンバー運用開始時点でそれなりに実在する番号になっていることに注意してください。

```php
<?php
use jp3cki\mynumber\MyNumber;

require_once(__DIR__ . '/vendor/autoload.php');

for ($i = 0; $i < 10; ++$i) {
    echo MyNumber::generate() . "\n";
}
```


LICENSE
-------

```
The MIT License (MIT)

Copyright (c) 2015 AIZAWA Hina <hina@bouhime.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

CHANGE LOG
----------

- not released yet

備考
----

- バージョンナンバーは [セマンティック バージョニング](http://semver.org/lang/ja/) に従います。
    - `v1.0.0` に対して
        - `v1.0.1` は機能追加等を行わないただのバグ修正であることを示します。このリリースは常に適用が推奨されます。
        - `v1.1.0` は機能追加を行っていますが既存の API に影響がないことを示します。このリリースは通常は適用が推奨されます。
        - `v2.0.0` は API の互換性が損なわれたリリースであることを示します。CHANGELOG を確認してください。
    - composer のバージョン指定においては `^` または `~` で安全に指定できます。
