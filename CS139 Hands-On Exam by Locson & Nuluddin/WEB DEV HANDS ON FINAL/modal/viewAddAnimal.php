<div class="modal fade" id="add_animals" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Animal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="modal/addAnimal.php" method="post">
        <div class="modal-body">

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name">
              <label for="floatingInput">Name</label>
            </div>

            <div class="form-floating mb-3">
              <select class="form-select" id="type_id" name="type_id" aria-label="Floating label select example">
                <?php
                            //include our connection
                            include_once('include/database.php');

                            $database = new Connection();
                            $db = $database->open();
                            try{	
                                $sql = 'SELECT * FROM type ORDER BY id ASC';
                                $no = 0;
                                foreach ($db->query($sql) as $row) {
                                    $no++;
                        ?>            
                              <option value=<?php echo $row['id']; ?> ><?php echo $row['name']; ?></option>
                        <?php 
                                }
                            }
                            catch(PDOException $e){
                                echo "There is some problem in connection: " . $e->getMessage();
                            }

                            //close connection
                            $database->close();

                        ?>
              </select>
              <label for="floatingSelect">Type Of Animal</label>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="color" name="color" placeholder="Name">
              <label for="floatingInput">Color</label>
            </div>

            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="number_of_legs" name="number_of_legs" placeholder="Name">
              <label for="floatingInput">Number Of Legs</label>
            </div>

            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="remarks" name="remarks" placeholder="Name">
              <label for="floatingInput">Remarks</label>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="addAnimal" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>