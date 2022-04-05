
<html>
  <head>
    <title>Courses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
                    table {
                      font-family: arial, sans-serif;
                      border-collapse: collapse;
                      width: 100%;
                      font-size: 20px;
                    }
                    th
                    {
                        padding-top: 12px;
                          padding-bottom: 12px;
                          text-align: center;
                          background-color: black;
                          color: white;
                          border-bottom: 1px solid #ddd;
                          padding: 8px;
                    }
                    td{
                      
                      
                      text-align: center;
                      border-bottom: 1px solid #ddd;
                      
                        padding: 8px;
                     
                    }
                    tr:nth-child(even){background-color: #f2f2f2;} 
                    tr:hover {background-color: #ddd;}
                    </style>
  </head>

  <body>
    
    <style>
                            #courses{
                                padding:15px;
                                  overflow: hidden;
                                  background-color: #f2f2f2;
                                  font-family: arial, sans-serif;
                                  text-align: center;

                            }

                            #search-container {
  float: right;
  overflow: hidden;
  
}
input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}
* {box-sizing: border-box;}
#search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 13px;
  background: #ddd;
  font-size: 20px;
  border: none;
  cursor: pointer;
}
#search-container button:hover {
  background: #ccc;
}
                            
                        </style>
    <h1><button onclick="location.href='index.php'" style='padding: 6px;
  
  
  background: #ddd;
  font-size: 17px;
  border: 1px;
  cursor: pointer;
  
  '>Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script><div id='courses'>Courses</div></h1>

    <?php 
      $username = "root"; 
      $password = ""; 
      $database = "project"; 
      $mysqli = new mysqli("localhost", $username, $password, $database); 
      $query = "SELECT * FROM courses";
      session_start();
        
      echo '<table> 
            <tr> 
              
                <th><b>Course Name</b> </th> 
                
                <th><b>Category</b></th> 
                <th colspan="2"><div id="search-container">
    <form action="disp_courses.php" method="POST">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div></th>
                
                
            </tr>';
    
      if(isset($_POST['search']))#search
      {
        $searchq = $_POST['search'];     
       $min_length = 0;
       if(strlen($searchq) >= $min_length){ 
         
        $searchq = htmlspecialchars($searchq); 
         
        $searchq = mysqli_real_escape_string($mysqli,$searchq);

        $raw_results = mysqli_query($mysqli,("SELECT * FROM courses
            WHERE ((`coursename` LIKE '%".$searchq."%') OR (`description` LIKE '%".$searchq."%')OR(`category` LIKE '%".$searchq."%'))")) or die(mysql_error());
        if(mysqli_num_rows($raw_results) >= 0){ 

            while($results = mysqli_fetch_array($raw_results,MYSQLI_ASSOC)){
              
              echo '<tr>
              <td>'.$results['coursename'].'</td>
              <td>'.$results['category'].'</td>
              <td>'?><a href="abt_course.php?courseid=<?=$results['courseid']?>" >About Course</a></td>
                    <td><a href="goto_course.php?courseid=<?=$results['courseid']?>" >Go to Course</a></td>
                <?php echo'</tr> ';

      }
    }
  }

        ?></table>
        <?php
        }
      


    else {
      
      if ($result = $mysqli->query($query)) #display all
      {
        while ($row = $result->fetch_assoc()) 
        {
          $coursename = $row["coursename"];
          $category = $row["category"]; 
          $courseid=$row["courseid"];
          
          echo '<tr>  
                    <td>'.$coursename.'</td> 
                    <td>'.$category.'</td> 
                    <td>'?><a href="abt_course.php?courseid=<?=$courseid?>" >About Course</a></td>
                    <td><a href="goto_course.php?courseid=<?=$courseid?>" >Go to Course</a></td>
                <?php echo'</tr>';
        }
        $result->free();
      } 
    }



    ?>
  </body>
</html