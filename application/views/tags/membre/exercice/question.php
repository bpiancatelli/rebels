<?php 

    $gentelella = base_url()."../plugins/gentelella/production/";
    $datatables = base_url()."../plugins/datatables/";

?>

<div class="right_col" role="main">
    <div class="row"> 
        
        <?php if (isset($questions) && $questions != null && $questions != '') { ?>    
           <?php                     
                echo form_open('exercice/checkreponse');
            ?>    
            <?php foreach($questions as $questionNo => $value ){ ?>

                    <div class="col-md-12 col-sm-12 col-xs-12">                
                        <div class="x_panel tile">                            
                            <div class="x_title">                    

                                <h2>Question N° <?php echo $questionNo ?> : 
                                    <?php echo ($value['out'] < 2) ? $value['out']. " out" : $value['out']." outs" ?>, 

                                    <?php 
                                    //$sentence  = null; 

                                    if($value['bases'][0] == true && $value['bases'][1] == true && $value['bases'][2] == true){
                                        $sentence = "Bases loaded";
                                    }elseif($value['bases'][0] == false && $value['bases'][1] == false && $value['bases'][2] == false){
                                        $sentence = "Personne sur base";
                                    }elseif($value['bases'][0] == true && $value['bases'][1] == false && $value['bases'][2] == false){
                                       $sentence = "1ère base occupée";                                       
                                    }elseif($value['bases'][0] == false && $value['bases'][1] == true && $value['bases'][2] == false){
                                        $sentence = "2ème base occupée";
                                    }elseif($value['bases'][0] == false && $value['bases'][1] == false && $value['bases'][2] == true){
                                        $sentence = "3ème base occupée";
                                    }elseif ($value['bases'][0] == true && $value['bases'][1] == true && $value['bases'][2] == false) {
                                        $sentence = "1ère et 2ème base occupées";
                                    }elseif($value['bases'][0] == false && $value['bases'][1] == true && $value['bases'][2] == true){
                                        $sentence = "2ème et 3ème base occupées";
                                    }else{
                                        $sentence = "1ère et 3ème base occupées";
                                    }  

                                    echo $sentence.",";                                  
                                    ?>

                                    balle frappée <?php echo $value['frappe'] ?>
                                </h2>


                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>                            
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">                                     
                                <table class="table table-bordered table-hover table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Infield</th>
                                            <th>Outfield</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($value['options'] as $key => $v) { ?>
                                           <tr>
                                                <td><input type="radio" name="level" value=""><?php echo $v ?></td>
                                                <td><input type="radio" name="level" value=""><?php echo $v ?></td>
                                           </tr>
                                           
                                        <?php } ?>

                                    </tbody>
                                </table>
                               
                            </div>
                        </div>                
                    </div>
            <?php } ?>

             <input class="btn btn-block btn-primary" type="submit" value="Soumettre">
        <?php } ?>

    </div>
</div>


















<div id="custom_notifications" class="custom-notifications dsp_none">
<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
</ul>
<div class="clearfix"></div>
<div id="notif-group" class="tabbed_notifications"></div>
</div>


<script type="text/javascript" src="<?php echo $datatables ?>datatables.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>        
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $gentelella?>js/bootstrap.min.js"></script>


<!-- chart js -->
<script src="<?php echo $gentelella?>js/chartjs/chart.min.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo $gentelella?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo $gentelella?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo $gentelella?>js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo $gentelella?>js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $gentelella?>js/datepicker/daterangepicker.js"></script>

<script src="<?php echo $gentelella?>js/custom.js"></script>