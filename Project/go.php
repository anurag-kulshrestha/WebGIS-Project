<?php
	$db = pg_connect("host=localhost port=5433 dbname=testapp user=postgres password=90november-=");
	$query = "insert into public.testapp values ('$_POST[ID]','$_POST[name]')";
	$result = pg_query($query);
?>