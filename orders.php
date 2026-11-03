<?php require_once __DIR__.'/../../app/bootstrap.php';$u=auth();
if($_SERVER['REQUEST_METHOD']==='GET'){
 if($u['role']==='buyer'){$s=db()->prepare("SELECT * FROM orders WHERE buyer_id=? ORDER BY id DESC");$s->execute([$u['id']]);}
 elseif($u['role']==='driver'){$s=db()->prepare("SELECT * FROM orders WHERE driver_id=? ORDER BY id DESC");$s->execute([$u['id']]);}
 else out(['error'=>'Use seller products endpoint'],403);
 out(['orders'=>$s->fetchAll()]);
}
if($_SERVER['REQUEST_METHOD']==='POST'&&$u['role']==='buyer'){$d=input();$pid=(int)($d['product_id']??0);$s=db()->prepare("SELECT id,price FROM products WHERE id=? AND active=1");$s->execute([$pid]);$p=$s->fetch();if(!$p)out(['error'=>'Product unavailable'],404);$s=db()->prepare("INSERT INTO orders(product_id,buyer_id,total,status) VALUES(?,?,?,'pending')");$s->execute([$pid,$u['id'],$p['price']]);out(['success'=>true,'order_id'=>(int)db()->lastInsertId()],201);}
out(['error'=>'Forbidden or method not allowed'],403);
