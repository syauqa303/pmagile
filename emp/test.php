<?
include("../lib/include.php");

//table("something wrong");
table("select id as ID,name as 'Item Name' from items");
//table("select sum(remaining) from item_hour where id in (SELECT max(item_hour.id) FROM items,`item_hour` where items.id=item_hour.itemid and items.projectid=2 group by item_hour.dt,item_hour.itemid) group by dt;");

//echo mysql_error();
?>