<?php 

    $gentelella = base_url()."../plugins/gentelella/production/";
    $datatables = base_url()."../plugins/datatables/";

?>


<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>                        
        </nav>
    </div>

</div>


<div class="right_col" role="main">
    <div class="row">
            <div class="col-md-5 col-sm-4 col-xs-12">                
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>Modifier mot de passe</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>                           
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <?php                     
                        echo form_open('membre/updateMdp/');
                    ?>  
                    <form>
                        <table>
                            <tbody>
                                <div class="x_content">  

                                    <tr>
                                        
                                            <td>
                                                <div class="w_left w_30">
                                                    <span>Ancien mot de passe</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="w_center w_50 col-md-offset-2" >
                                                    <input type="password" name="ancien_mdp"></input>
                                                </div>
                                            </td>
                                            <div class="clearfix"></div>
                                        
                                    </tr>
                                    <tr>
                                        
                                            <td>
                                                <div class="w_left w_30">
                                                    <span>Nouveau mot de passe</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="w_center w_50 col-md-offset-2">
                                                    <input type="password" name="nouveau_mdp"></input>
                                                </div>
                                            </td>
                                            <div class="clearfix"></div>
                                        </div>
                                    </tr>
                                    <tr>
                                        
                                            <td>
                                                <div class="w_left w_30">
                                                    <span>Confirmer mot de passe</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="w_center w_50 col-md-offset-2">
                                                    <input type="password" name="confirmation_mdp"></input>
                                                </div>
                                            </td>
                                            <div class="clearfix"></div>
                                        
                                    </tr> 
                                    
                                   <tr>
                                        
                                            <td>
                                                <div class="w_left w_30">
                                                    <input class="btn btn-primary btn-block" type="submit" name="submit_mdp" value="Modifier" />
                                                </div>
                                            </td>
                                            <div class="clearfix"></div>
                                        

                                    </tr>      
                                   
                                </div>
                            </tbody>
                        </table>
                    </form>
                    <div class="col-md-12">
                        <tr>
                            <td>

                                <?php if (isset($mdp) && $mdp != null) { 

                                    $alert = $mdp['succes'] ? "alert-success" : "alert-danger";
                                ?>
                                    <div class="alertmessage alert <?php echo $alert ?>">
                                        <?php echo $mdp["message"]; ?>
                                    </div>
                                    
                                <?php } ?>
                            </td>                                    
                        </tr>
                    </div>
                </div>            
            </div>





    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">                
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Modifier adresse email</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                        
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
               <?php                     
                    echo form_open('membre/updateEmail/');
                ?>
                    <form>
                        <table>
                            <tbody>
                                <div class="x_content">                        
                                    <tr>
                                        
                                            <td>
                                                <div class="w_left w_30">
                                                    <span>Adresse mail</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="w_center w_50 col-md-offset-2" >
                                                    <input type="text" name="adresse_email"></input>
                                                </div>
                                            </td>                                                                    
                                        
                                    </tr>
                                    <tr>
                                        
                                            <td>
                                                <div class="w_left w_30">
                                                    <input class="btn btn-primary btn-block" type="submit" name="submit_email" value="Modifier" />
                                                </div>
                                            </td>
                                            <div class="clearfix"></div>
                                        
                                    </tr>
                                </div>
                            </tbody>
                        </table>
                    </form>
                    <div class="col-md-12">
                        <tr>
                            <td>

                                <?php if (isset($email) && $email != null) { 

                                    $alert = $email['succes'] ? "alert-success" : "alert-danger";
                                ?>
                                    <div class="alertmessage alert <?php echo $alert ?>">
                                        <?php echo $email["message"]; ?>
                                    </div>
                                    
                                <?php } ?>
                            </td>                                    
                        </tr>
                    </div>
                </div>
            </div>                
        </div>
</div>













<script>setTimeout(function() {
    $('.alertmessage').fadeOut('slow');
}, 10000); // <-- time in milliseconds
</script>     




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