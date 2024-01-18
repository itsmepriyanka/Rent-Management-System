<?php include('.\common.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payemnts</title>
    <style>
        #gap{
            width: 100%;
            height: 150px;
        }
        .content_payment{
            padding-bottom: 10px;
            margin:0px 10px 0 20vmax;
            background-color: aliceblue;            
            width:63vmax;
        }
        .list{
            margin-bottom: 30px;
            display: flex;            
            height: 60px;
            width: 100%;
            justify-content: space-between;
        }
        .list h3{
            margin-left: 20px;
            color: white;
        }
        input{
            margin-left: 10px;
        }
        .list h4{
            margin: 20px 20px 0 20px;
        } 
        table{
            width: 45vmax;
        }       
    </style>
</head>
<body>
    <div class="container_payment">
        <div id="gap"></div>
        <div class="content_payment">
            <div class="list" style="background-color: grey;">
                <h3>List of Bookings</h3>                
            </div>
            <div id="box">            
                       
                <div>
                
                    <table border="1">
                        <thead>
                            <tr>
                                <th>#</th>                                
                                <th>Tenant ID</th>
                                <th>Tenant name</th>
                                <th>House No</th>
                                <th>booking date</th>                  
                            </tr>
                        </thead>
                        <tbody> 
                        <?php                       
                            include 'db_connect.php';
                            $sql="SELECT * FROM `bookings`as b join tenants as t on b.tenant_id=t.id join houses as h on h.id=b.house_id";
                            $result=$conn->query($sql);
                            $data=[];
                            if($result->num_rows>0){
                                while($row=$result->fetch_assoc()){
                                    array_push($data,$row);
                                }
                            }        
                        ?> 
                         <?php
                            if(count($data)>0){ ?>  
                        <?php foreach($data as $key=> $record){?>                       
                                <tr>
									<td class="text-center"><?php echo $key+1;?></td>
									<td><?php echo $record['tenant_id'] ?></td>
                                    <td><?php echo $record['name'] ?></td>
									<td><?php echo $record['house_no'] ?></td>
									<td><?php echo $record['booking_date'] ?></td>
								</tr> 
                                <?php } ?>
                    <?php } else{ ?>
                        <tr>
                            <td colspan="3">No bookings found into databases</td>
                        </tr>
                    <?php } ?>                               
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>