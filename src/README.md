# お食事処提案くん

## アプリ概要

・基本的にはWEB上でよく見かける、何を食べようか困った時にルーレットなどを活用して決めようというスタンスのアプリ

・差別化できるポイントとしては、現在地を取得して、おすすめの外食屋を提案する機能をAPIを使って実装している点

## 作成経緯

・AWSやDockerのようなインフラ周りの知識のアウトプット

・Vue＋TypeScriptのコーディングの練習

・より品質の高いLaravelコーディングの練習

## 使用技術

・フロントエンド(Vue, TypeScript, TailwindCSS)

・バックエンド(Laravel)

・インフラなど(AWS, Docker, MySQL)

・その他(GoogleMapsAPI)

## 要件定義

詳細はこちらからご覧ください

https://docs.google.com/spreadsheets/d/1Xw7Ek04I66hVouqm6_o23O6WLTrCG7z4EHfg_DX18zs/edit#gid=217497615

#### やることメモ

・Dockerfile内のキーなどの機密情報を.envへの移行
・ログインしていないとログイン後の機能は使えないように(コンストラクタ)
・ルーレットで使うデータをAPIとして管理

#### コンテナの起動
docker compose exec php bash

#### EC2へのログイン
ssh -i /path/to/your/key.pem ec2-user@your-ec2-public-ip