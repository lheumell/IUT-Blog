<?php

function get_all_posts()
{
    global $db;
    $sth = $db->query("SELECT * FROM posts");
    return $sth->fetchAll();
}

function create_article($title, $content, $iduser)
{
    global $db;
    $sth = $db->prepare("INSERT INTO posts(title,content,iduser) VALUES (?,?,?)") ;
    $sth->execute(array($title,$content,$iduser)) ;
}

function recuperer_article($id)
{
    global $db;
    $sth = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $sth->execute(array($id));
    return $sth->fetch();
}

function supprimer_article($id)
{
    global $db;
    $sth = $db->prepare("DELETE FROM posts WHERE id = ?") ;
    $sth->execute(array($id)) ;
}

function modifier_article($id, $title, $content)
{
    global $db;
    $sth = $db->prepare("UPDATE posts SET title = ? , content = ? WHERE id = ?");
    $sth->execute(array($title, $content, $id)) ;

}

function get_all_category()
{
    global $db;
    $sth = $db->query("SELECT * FROM category");
    return $sth->fetchAll();
}

function create_category($nom)
{
    global $db;
    $sth = $db->prepare("INSERT INTO category(nom) VALUES (?)") ;
    $sth->execute(array($nom)) ;
}

function recuperer_category($id)
{
    global $db;
    $sth = $db->prepare("SELECT * FROM category WHERE id = ?");
    $sth->execute(array($id));
    return $sth->fetch();
}

function supprimer_category($id)
{
    global $db;
    $sth = $db->prepare("DELETE FROM category WHERE id = ?") ;
    $sth->execute(array($id)) ;
}

function modifier_category($id, $nom)
{
    global $db;
    $sth = $db->prepare("UPDATE category SET nom = ? WHERE id = ?");
    $sth->execute(array($nom, $id)) ;

}

function inscription($email,$password,$nom)
{
    global $db ;
    $sth = $db->prepare("INSERT INTO inscription(email,password,nom) VALUES (?,?,?)");
    $sth->execute(array($email,$password,$nom)) ;
}

function connexion($email,$password)
{
    global $db ;
    $sth = $db->prepare("SELECT * FROM inscription WHERE email= ? AND password= ? ") ;
    $sth->execute(array($email,$password)) ;
    return $sth;
}

function recuperer_nom($id)
{
    global $db ;
    $sth = $db->prepare("SELECT nom FROM inscription WHERE id = ?") ;
    $sth->execute(array($id)) ;
    $sth = $sth->fetch() ;
    return $sth['nom'];
}