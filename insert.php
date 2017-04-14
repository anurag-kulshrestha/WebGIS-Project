<?php 

            //$point = $_POST['nayaPoint'];
            $point=$_GET['name'];
            $lat=$_GET['lati'];
            $lon=$_GET['long'];
            
            //echo json_encode($lon.$lat);
            
            
            function conn(){
            $host = "host = localhost";
            $port = "port=5432";
            $dbname = "dbname=openstreetfood";
            $userpass= "user=postgres password=postgres";

            $db=pg_connect("$host $port $dbname $userpass");
            /*if(!$db){
                echo "Nahi aaya\n";
                }
            else{echo "Aa gaya\n";}
            */
            return $db;
            
            }
            
         function get_queryID(){
            $conn=conn();
            $query="select nukkad_id from point_updater;";
            $result=pg_query($conn, $query);
            
            $row=pg_fetch_row($result);
            $id=$row[0];
            //pg_close($conn);
            return $id;
            }
        
         function update_queryid(){
            $conn=conn();
            $id=get_queryID();
            $newid=$id+1;
            $query="update point_updater set nukkad_id=".$newid." where nukkad_id=".$id.";";
            $result=pg_query($conn, $query); 
            
            //pg_close($conn);
            //return $newid;
            }
        
         function insert($latitude,$longitude){
            $conn=conn();
            $id=get_queryID();
            $p='POINT('.(string)$longitude.' '.(string)$latitude.')';
            //$query="insert into ddoon_nukkad (id, geom) values (".$id.", st_geomfromtext('POINT(".(string)$longitude." ".(string)$latitude")', 4326));";
            $query="insert into ddoon_nukkad (id, geom) values (".$id.", st_geomfromtext('".$p."', 4326));"; 
            //POINT(78.056690719604 30.350883113861)
            $result=pg_query($conn, $query);
            //if(!$result)
            //{ echo 'Nahi chada';
            //}
            //else
            //{echo 'Chadd gaya';
            //}
            update_queryid();
            //pg_close($conn);
            //echo json_encode($query);
        }
        
        function returnRefreshGeom(){
            $conn=conn();
            $myarray=array();
            $query="select * from ddoon_nukkad;";
            $result=pg_query($conn, $query);
            
            while($row=pg_fetch_row($result)){
                $myarray[]=$row;
            }
            
            pg_close($conn);
            //echo json_encode(pg_fetch_all($result));
            echo json_encode($myarray);
        }
        
        insert($lat, $lon);
        returnRefreshGeom();
        
        
            
?> 