<?php require 'config.php';
$cats=['Women','Men','Kids','Footwear','Accessories'];foreach($cats as $i=>$name){$s=$pdo->prepare("INSERT IGNORE INTO categories(name,sort_order) VALUES(?,?)");$s->execute([$name,$i+1]);}
$adminEmail='admin@stylehub.test';$s=$pdo->prepare("INSERT IGNORE INTO users(name,email,password_hash,role) VALUES('StyleHub Admin',?,?, 'admin')");$s->execute([$adminEmail,password_hash('admin12345',PASSWORD_DEFAULT)]);
$catids=[];foreach($pdo->query("SELECT id,name FROM categories") as $c)$catids[$c['name']]=$c['id'];
$demo=[
['Everyday Linen Shirt','Women','Clothing',1299,24,'A relaxed-fit breathable linen shirt for effortless everyday styling.','https://images.unsplash.com/photo-1598554747436-c9293d6a588f?w=900','XS, S, M, L, XL'],
['Classic Tailored Blazer','Men','Formalwear',3499,12,'A clean tailored blazer that moves from workdays to evenings.','https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=900','S, M, L, XL'],
['Weekend Sneakers','Footwear','Sneakers',2199,30,'Comfort-first everyday sneakers with a versatile silhouette.','https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=900','UK 6–11'],
['Mini Explorer Set','Kids','Casual wear',999,18,'A playful, soft cotton outfit set for little adventures.','https://images.unsplash.com/photo-1519238263530-99bdd11df2ea?w=900','2–8 years'],
['Everyday Tote','Accessories','Bags',799,40,'A roomy everyday tote for all your daily essentials.','https://images.unsplash.com/photo-1544816155-12df9643f363?w=900','One size'],
['Essential Cotton Tee','Men','Casual wear',699,50,'A soft cotton tee designed for easy everyday layering.','https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=900','S, M, L, XL']
];
foreach($demo as $d){$s=$pdo->prepare("INSERT IGNORE INTO products(name,category_id,subcategory,price,stock,description,image_url,size_guide,featured) VALUES(?,?,?,?,?,?,?,?,1)");$s->execute([$d[0],$catids[$d[1]],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7]]);}
echo 'StyleHub demo data created. Admin: admin@stylehub.test / admin12345. Delete setup.php immediately.';
