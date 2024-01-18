<?php include('.\common.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant</title>
    <style>
         #gap{
            width: 100%;
            height: 9vmax;
        }
        .content{
            padding-bottom: 10px;
            margin:0px 10px 0 20vmax;
            background-color: aliceblue;            
            width:63vmax;
        }
        .list{
            display: flex;            
            height: 60px;
            width: 100%;
            /* background-color: grey; */
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
            background-color: blue;
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
            width: 60vmax;
            font-size: 18px;            
            margin-left: 25px;
            border-collapse: collapse;            
        }
        table tr td, table tr th{
            padding: 10px 5px 10px 5px;
            border: rgb(124, 120, 120) solid;
        }
        img{
            width: 150px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="container_tenant">
    <div id="gap"></div>
        <div class="content">
            <div class="list" style="background-color: grey;">
                <h3>List of Tenants</h3>                
            </div>
            <div id="box">
                <div class="list" >
                    <h4>Show<select type="number">
                    <option value="">5</option>
                    <option value="">10</option>
                    <option value="">20</option></select>entries                    
                    </h4>
                    <form action="" method="post">
                    <h5>search<input type="text" id="myInput" placeholder="search....." onkeyup="searchFun()"></h5>
                    </form>
                </div>                 
                <div>               
                    <table border="1" id="myTable">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No.</th>
                                <th>Id Type</th>
                                <th>Id Photo</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>   
                        <?php
                            // $status=$_isset['status'];
                            include 'db_connect.php';
                            $sql="SELECT * FROM `tenants`";
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
									<td><?php echo $record['name'] ?></td>
									<td><?php echo $record['email'] ?></td>
									<td><?php echo $record['contact'] ?></td>
									<td><?php echo $record['id_type'] ?></td>
									<td><img src="<?php print_r($record['id_photo']) ?>"></td>
                                    <td><?php echo $record['status'] ?></td>
									<td class="text-center">
                                    <button><a href="tenant_view.php?&na=<?php echo $record['name'];?>&id=<?php echo $record['id'];?>&em=<?php echo $record['email']; ?>&co=<?php echo $record['contact']; ?>&dt=<?php echo $record['date_in'];?>&idt=<?php echo $record['id_type']; ?>&idp=<?php echo $record['id_photo'];?>&ad=<?php echo $record['address'];?>" >View</a></button>
									</td>
								</tr>
                                <?php } ?>
                    <?php } else{ ?>
                        <tr>
                            <td colspan="3">No categories found into databases</td>
                        </tr>
                    <?php } ?>
                        </tbody>
                    </table>                   
                    
                    
                   
                </div>
            </div>          
                    
        </div>
    </div>
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
</body>
</html>