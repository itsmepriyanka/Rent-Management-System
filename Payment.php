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
            display: flex;            
            height: 60px;
            width: 100%;
            justify-content: space-between;
        }
        .list h3{
            margin-left: 20px;
            color: white;
        }
        .list button{
            margin: 15px 15px 0 0;
            height:30px;
            width: 140px;
            color: white;
            background-color: black;
            border-radius: 5px;
            border: blue;
        }
        #search{
            margin-top: 0;
            width: 30px;
            background-color:aliceblue;
            color: black;
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
                <h3>List of Payments</h3>
                <a href="payment_form.php"><button><b>+ Entry</b></button></a>
            </div>
            <div id="box">                
                <div class="list" >
                    <h4>Show<select type="number">
                    <option value="">5</option>
                    <option value="">10</option>
                    <option value="">20</option></select>entries                    
                    </h4>
                    <form action="" method="post">
                    <h5>search<input type="text" id="myInput" placeholder="on basis of date..." onkeyup="searchFun()"></h5>
                    </form>
                </div>                
                <div>
                
                    <table border="1" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Tenant ID</th>
                                <th>Tenant name</th>
                                <th>Invoice</th>
                                <th>Amount</th>                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                        <?php                       
                            include 'db_connect.php';
                            $sql="SELECT * FROM `payments`as p join tenants as t on p.tenant_id=t.id";
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
									<td><?php echo $record['date_created'] ?></td>
									<td><?php echo $record['tenant_id'] ?></td>
                                    <td><?php echo $record['name'] ?></td>
									<td><?php echo $record['invoice'] ?></td>
									<td><?php echo $record['amount'] ?></td>						
									<td class="text-center">										
                                    <a href="payment_edit.php?id=<?php echo $record['id']?>" ><button>Edit</button></a>										
									</td>
								</tr> 
                                <?php } ?>
                    <?php } else{ ?>
                        <tr>
                            <td colspan="3">No payments found into databases</td>
                        </tr>
                    <?php } ?>   
                    <script>
    
    const searchFun=()=>{
        const filter = document.getElementById('myInput').value.toUpperCase();
        let myTable = document.getElementById('myTable') ;
        let tr= myTable.getElementsByTagName('tr');
        for(let i=0;i<tr.length;i++){
         let td= tr[i].getElementsByTagName('td')[1];
         if(td){
             let textValue= td.textContent || td.innerHTML;
             if(textValue.toUpperCase().indexOf(filter)>-1){
                 tr[i].style.display="";
             }else{
                 tr[i].style.display="none";
             }
         }
        }
    }  
    
    </script>                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>