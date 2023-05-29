<?php
class DAO_profile{
    //データベースに接続する関数
    private function dbConnect(){
        //データベースに接続
        $pdo = new PDO('mysql:host=localhost; dbname=tabetterdb; charset=utf8',
                        'webuser', 'abccsd2');
        return $pdo;
    }

    public function getForumId($forumid){

        $pdo = $this -> dbConnect();

        //SQLの生成　入力を受け取る部分は”？”
        $sql = "SELECT * FROM forum WHERE forum_id = ?";

        //prepare:準備　戻り値を変数に保持
        $ps = $pdo -> prepare($sql);

        //”？”に値を設定する
        $ps->bindValue(1, $forumid ,PDO::PARAM_INT); 
        
        //SQLの実行
        $ps->execute();

        //実行結果を配列に格納
        $result = $ps->fetchAll(PDO::FETCH_ASSOC);
    }


}
?>