<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CS139 Final Hands-On Exam</title>
    <link rel="stylesheet" href="./style/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>

    <div class="body_container">
      <section class="project_container">
        <?php 
          session_start();
          if(isset($_SESSION['message'])){
              ?>
              <div class="alert alert-info text-center" style="margin-top:10px;">
                  <?php echo $_SESSION['message']; ?>
              </div>
              <?php

              unset($_SESSION['message']);
          }
        ?>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <!-- Navigation Type & Animals -->
          <li class="nav-item" role="presentation">
            <button
              class="nav-link active"
              id="home-tab"
              data-bs-toggle="tab"
              data-bs-target="#home"
              type="button"
              role="tab"
              aria-controls="home"
              aria-selected="true"
            >
              Animals
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="profile-tab"
              data-bs-toggle="tab"
              data-bs-target="#profile"
              type="button"
              role="tab"
              aria-controls="profile"
              aria-selected="false"
            >
              Type
            </button>
          </li>
        </ul>
        <!-- Body Container -->
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade show active bg-white table_container"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <div>
              <h3>Animals</h3>
              <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_animals">Add New Animal</a>
            </div>
            
            <!-- Table -->
            <div class="table_body_container">
              <table class="table table-hover mt-2">
              <thead>
                <th>EDIT | DELETE</th>
                <th>ID #</th>
                <th>Name</th>
                <th>Type</th>
                <th>Color</th>
                <th>Number of Legs</th>
                <th>Remarks</th>
              </thead>
              <tbody>
                  <?php
                            //include our connection
                            include_once('database/database.php');

                            $database = new Connection();
                            $db = $database->open();
                            try{	
                                $sql = 'SELECT * FROM animals ORDER BY id ASC';
                                $no = 0;
                                foreach ($db->query($sql) as $row) {
                                    $no++;
                        ?>
                                     <tr>
                                       <td class="editDeleteWidth bg-light">
                                            <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_animal<?php echo $row['id']; ?>"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_animal<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                        <td class="idWidth"><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>

                                        <!-- Type Name Select -->
                                        <td><?php 
                                          
                                          $typesql = 'SELECT * FROM type';
                                          foreach ($db->query($typesql) as $typerow) {
                                            if ($row['type_id'] == $typerow['id']) {
                                                echo $typerow['name'];
                                            }
                                          }
                                           
                                        
                                        ?></td>
                                        <!-- Type Name Select -->

                                        <td><?php echo $row['color']; ?></td>
                                        <td><?php echo $row['number_of_legs']; ?></td>
                                        <td><?php echo $row['remarks']; ?></td>
                                        
                                        <?php include('modal/viewEditAnimal.php'); ?>
                                        <?php include('modal/viewDeleteAnimal.php'); ?>
                                    </tr>
                        <?php 
                                }
                            }
                            catch(PDOException $e){
                                echo "There is some problem in connection: " . $e->getMessage();
                            }

                            //close connection
                            $database->close();

                        ?>
                </tbody>
            </table>
            </div>
            
          </div>
          <!-- Another Tab -->
          <div
            class="tab-pane fade bg-white table_container"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab"
          >
            <h3>Type of Animal</h3>
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_type">Add New Type</a>
            <!-- Table -->
            <div class="table_body_container">
              <table class="table table-hover mt-2">
                <thead>
                  <th>EDIT | DELETE</th>
                  <th>ID #</th>
                  <th>Type</th>
                </thead>
                <tbody>
                  <?php
                            //include our connection
                            include_once('database/database.php');

                            $database = new Connection();
                            $db = $database->open();
                            try{	
                                $sql = 'SELECT * FROM type ORDER BY id ASC';
                                $no = 0;
                                foreach ($db->query($sql) as $row) {
                                    $no++;
                        ?>
                                     <tr>
                                       <td class="editDeleteWidth bg-light">
                                            <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_type<?php echo $row['id']; ?>"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_type<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                        <td class="idWidth"><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        
                                        <?php include('modal/viewEditType.php'); ?>
                                        <?php include('modal/viewDeleteType.php'); ?>
                                    </tr>
                        <?php 
                                }
                            }
                            catch(PDOException $e){
                                echo "There is some problem in connection: " . $e->getMessage();
                            }

                            //close connection
                            $database->close();

                        ?>
                </tbody>
              </table>
              
            </div>

            
            
          </div>
        </div>
      </section>
      <footer class="mt-2 text-light">
        By Locson, Ckeanu Richer Q. & Nuluddin, Franz Louise F. BSCS - 3B
      </footer>
    </div>


    <?php include('modal/viewAddAnimal.php'); ?>
    <?php include('modal/viewAddType.php'); ?>
    <!-- JS Script -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
