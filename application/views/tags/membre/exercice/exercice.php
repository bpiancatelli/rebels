<?php 

    $gentelella = base_url()."../plugins/gentelella/production/";
    $datatables = base_url()."../plugins/datatables/";

?>

<div class="right_col" role="main">
    <div class="row"> 

        <div class="col-md-3 col-sm-3 col-xs-3 alertmessage">

            <div class="x_panel tile fixed_height_320">                            
                <div class="x_title">                            
                    <h2>Niveau de difficulté</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                            
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php                     
                        echo form_open('exercice/retrievelevel');
                    ?>                         
                    <?php if (isset($difficultyLevel) && $difficultyLevel != null) { ?>                        
                            <?php foreach ($difficultyLevel as $key => $value) { ?>
                                <div><input type="radio" name="level" value="<?php echo $key ?>"><?php echo $value ?></div>
                            <?php } ?>
                                <div><input class="btn btn-primary" type="submit" name="submit_exercice" value="Sélectionner" /></div>
                    <?php } ?>
                </div>
            </div>                
        </div>

         

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