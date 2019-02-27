<?php require_once('conn.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <title>VoteCounter | Interactive Counter for the 2019 Presidential Election</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/jquery-ui.min.css" rel="stylesheet">  
      <link href="css/dataTables.bootstrap4.css" rel="stylesheet">    
  </head>

<body style="padding-top: 5rem;">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">VoteCounter</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>      
    </div>
  </nav>

  <main role="main" class="container">            
      <div class="row">        
        <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              <b>Votes</b>
            </div>
            <div class="card-body">
              <form method="post" action="process.php">
                <div class="form-group">                  
                  <select id="select" class="form-control" name="state">
                    <option value="0">Select a State</option>
                    <option value="Abuja">ABUJA FCT</option>
                    <option value="Abia">ABIA</option>
                    <option value="Adamawa">ADAMAWA</option>
                    <option value="Akwa Ibom">AKWA IBOM</option>
                    <option value="Anambra">ANAMBRA</option>
                    <option value="Bauchi">BAUCHI</option>
                    <option value="Bayelsa">BAYELSA</option>
                    <option value="Benue">BENUE</option>
                    <option value="Borno">BORNO</option>
                    <option value="10">CROSS RIVER</option>
                    <option value="Delta">DELTA</option>
                    <option value="Ebonyi">EBONYI</option>
                    <option value="Edo">EDO</option>
                    <option value="Ekiti">EKITI</option>
                    <option value="Enugu">ENUGU</option>
                    <option value="Gombe">GOMBE</option>
                    <option value="Imo">IMO</option>
                    <option value="Jigawa">JIGAWA</option>
                    <option value="Kaduna">KADUNA</option>
                    <option value="Kano">KANO</option>
                    <option value="Katsina">KATSINA</option>
                    <option value="Kebbi">KEBBI</option>
                    <option value="Kogi">KOGI</option>
                    <option value="Kwara">KWARA</option>
                    <option value="Lagos">LAGOS</option>
                    <option value="Nassarawa">NASSARAWA</option>
                    <option value="Niger">NIGER</option>
                    <option value="Ogun">OGUN</option>
                    <option value="Ondo">ONDO</option>
                    <option value="Osun">OSUN</option>
                    <option value="Oyo">OYO</option>
                    <option value="Plateau">PLATEAU</option>
                    <option value="Rivers">RIVERS</option>
                    <option value="Sokoto">SOKOTO</option>
                    <option value="Taraba">TARABA</option>
                    <option value="Yobe">YOBE</option>
                    <option value="Zamfara">ZAMFARA</option>
                  </select>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="APC">APC</label>
                    <input type="number" class="form-control" id="" placeholder="APC" name="apc">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="PDP">PDP</label>
                    <input type="number" class="form-control" id="" placeholder="PDP" name="pdp">
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success form-control" name="save">Save Votes</button>
                </div>
              </form>
            </div>            
          </div>
        </div> 

        <div class="col-md-7">
          <div class="row">
            <div class="col-md-4">
              <div class="card" style="width: 14.5rem;">
                <img src="img/apc-logo.jpg" class="card-img-top" alt="APC Logo">
                <div class="card-body">
                  <h5 class="card-title text-center">
                    <?php                  
                          $sql = $pdo->prepare("SELECT sum(apc) as 'Total APC' from votes");                
                          // execute the prepared statement
                          $sql->execute();
                          while ($apc = $sql->fetch()) {
                          if ($apc > 0){
                          $total_apc = number_format($apc['Total APC']);

                          echo $total_apc;
                          ?>      
                               
                          <?php 
                          } else {
                              echo "<p>No matches found</p>";
                          }
                      }                  
                  ?>                    
                  </h5>
                </div>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <div class="card" style="width: 17.1rem;">
                <img src="img/pdp-logo-2.jpg" class="card-img-top" alt="PDP Logo">
                <div class="card-body">
                  <h5 class="card-title text-center">
                   <?php                  
                          $sql = $pdo->prepare("SELECT sum(pdp) as 'Total PDP' from votes");                
                          // execute the prepared statement
                          $sql->execute();
                          while ($pdp = $sql->fetch()) {
                          if ($pdp > 0){
                          $total_pdp = number_format($pdp['Total PDP']);

                          echo $total_pdp;
                          ?>      
                               
                          <?php 
                          } else {
                              echo "<p>No matches found</p>";
                          }
                      }                  
                  ?>              
                  </h5>
                </div>
              </div>
            </div>              
          </div>
          
        </div>  

      </div>   

      <div class="row">
        <div class="col-md-8">
          <div class="card mt-3">
        <div class="card-header">
          <i class="fa fa-list"></i> <b>States</b>          
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>State</th>
                  <th>APC</th>                  
                  <th>PDP</th>
                  <th>Winner</th>                
                </tr>
              </thead>
              <tfoot class="small text-muted">
                <tr>
                  <th></th>
                  <th></th>
                  <th><?php echo $total_apc; ?></th>                  
                  <th><?php echo $total_pdp; ?></th>
                  <th></th>                   
                </tr>
              </tfoot>
              <tbody>
              <?php
                $sql = $pdo->prepare("SELECT state, apc, pdp from votes");
                    $sql->execute();
                    $counter = 0; 

                   while ($report = $sql->fetch()) {
                         $state = $report['state'];
                         $apc = $report['apc'];
                         $pdp = $report['pdp'];               
              ?>
              <?php
                      if($apc > $pdp){
                        $twinner = 'APC';
                        $tclass='table-success';
                      } elseif ($pdp > $apc) {
                        $twinner = 'PDP';
                        $tclass='table-danger';
                      }
                    ?>  
                <tr class="<?php echo $tclass; ?>">
                  <td><?php echo ++$counter; ?></td>
                  <td><?php echo $state; ?></td>
                  <td><?php echo number_format($apc); ?></td>
                  <td><?php echo number_format($pdp); ?></td>  
                  <td><?php echo $twinner; ?></td>          
                </tr>
                <?php }?>               
              </tbody>
            </table>
          </div>
        </div>
       
      </div>
        </div>



        <div class="col-md-6"></div>
      </div>
  </main>     

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script> 
    <script type="text/javascript">          
      $(document).ready( function () {
        $('#dataTable').DataTable();
      } );
    </script>  
</body>
</html>