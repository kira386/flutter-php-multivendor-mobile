<?php
require_once __DIR__.'/../config/config.php';
function db():PDO{static $p=null;if(!$p)$p=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);return $p;}
function input():array{$v=json_decode(file_get_contents('php://input'),true);return is_array($v)?$v:[];}
function out(array $v,int $code=200):never{http_response_code($code);header('Content-Type: application/json');echo json_encode($v);exit;}
function auth():array{$h=$_SERVER['HTTP_AUTHORIZATION']??'';if(!preg_match('/Bearer\s+(.+)/',$h,$m))out(['error'=>'Unauthorized'],401);$s=db()->prepare("SELECT u.id,u.name,u.role FROM tokens t JOIN users u ON u.id=t.user_id WHERE t.hash=? AND t.expires_at>NOW()");$s->execute([hash('sha256',trim($m[1]))]);$u=$s->fetch();if(!$u)out(['error'=>'Unauthorized'],401);return $u;}
