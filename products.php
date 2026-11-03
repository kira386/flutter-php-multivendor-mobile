<?php require_once __DIR__.'/../../app/bootstrap.php';
if($_SERVER['REQUEST_METHOD']==='GET'){$s=db()->query("SELECT p.id,p.name,p.description,p.price,p.image_url,p.seller_id,u.name seller_name FROM products p JOIN users u ON u.id=p.seller_id WHERE p.active=1 ORDER BY p.id DESC");out(['products'=>$s->fetchAll()]);}
$u=auth();if($u['role']!=='seller')out(['error'=>'Seller only'],403);$d=input();
if($_SERVER['REQUEST_METHOD']==='POST'){$name=trim($d['name']??'');$price=(float)($d['price']??0);if(!$name||$price<=0)out(['error'=>'Name and positive price required'],422);$s=db()->prepare("INSERT INTO products(seller_id,name,description,price,image_url) VALUES(?,?,?,?,?)");$s->execute([$u['id'],$name,$d['description']??'', $price,$d['image_url']??null]);out(['success'=>true,'id'=>(int)db()->lastInsertId()],201);}
if($_SERVER['REQUEST_METHOD']==='DELETE'){$id=(int)($_GET['id']??0);$s=db()->prepare("DELETE FROM products WHERE id=? AND seller_id=?");$s->execute([$id,$u['id']]);out(['success'=>$s->rowCount()>0]);}
out(['error'=>'Method not allowed'],405);
