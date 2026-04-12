# 開発記録 (Development Log)

このプロジェクトの開発プロセス、学んだ技術、直面した課題の解決策を記録します。

2026/3/31(火) マイグレーション変更
当初はカット、カラーなどのサービスを一つのみ選ぶようにしていたのでappointmentsテーブルにservice_idカラム
を設定していた。しかし配列で複数選択できるように設計を変更した。
それにより中間テーブルである、appointment_serviceを作成した。
中間テーブルというくらいなので多対多であることは間違いない。
しかしリレーションを自分で考え、
1.appointmentsテーブルからみて、appointment_service_tableは1対多、
2.services_tableから見ても1対多である
よって多対多であることを証明できた。

次回に向けて→リレーション設定を行う。

2026/4/4(土)　sessionについて
// 文字列
session(['name' => 'Taro']);
// 数値
session(['count' => 1]);
// 配列
session(['items' => ['apple', 'banana']]);
// オブジェクト
session(['user' => $userModel]);
☆Q.session('selected.date_time' )は何が入っているのか？
　A.
　　$validated = $request->validate(['date' => 'required','time' => 'required']);
　　session(['selected.date_time' => $validated]);
　　なので["date" => "2026-04-04","time" => "15:00"]が入っている。

2026/4/12(土)　予約完了ができた
ユーザーログイン→メニュー選択→スタッフ選択→日時選択→予約確認→予約確定
DBにてappointmentsテーブルにて予約確定を確認。