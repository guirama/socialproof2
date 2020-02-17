<?php
$this->load->view('common_header');
?>
<style>
    .red
    {
        background-color: red !important;
    }
    #extra_dr_img_options,#extra_dr_logo_options
    {
        display: none;
        margin-top: 2px;
    }
    .btn-xus
    {
        font-size: 0.7em !important;
        padding: .15rem .2rem;
        line-height: 1.0;
        border-radius: .1rem;
    }
    #dr-image-preview,#dr-logo-preview
    {
        max-width: 200px !important;
        max-height: 200px !important;
    }
    .actionLink
    {
        color:black;
        text-decoration: none;
    }
    .actionLink:hover
    {
        color:brown;
        background-color: yellow;
        text-weight:bold;
    }
</style>
  <!-- Page Content -->
  <div class="container">
<?php

    if($dr_image_uploaded)
    {
      ?>
      <div class="row" style="margin:10px;">
          <div class="col-md-12">
            <div class="alert alert-success" role="alert">
             New Dr. Image uploaded successfully.
            </div>
          </div>
      </div>
      <?php
    }
    if($dr_logo_uploaded)
    {
      ?>
      <div class="row" style="margin:10px;">
          <div class="col-md-12">
            <div class="alert alert-success" role="alert">
             New Dr. Logo uploaded successfully.
            </div>
          </div>
      </div>
      <?php
    }
    if($linkages_updated)
    {
      ?>
      <div class="row" style="margin:10px;">
          <div class="col-md-12">
            <div class="alert alert-success" role="alert">
             Selected Linkages updated successfully.
            </div>
          </div>
      </div>
      <?php
    }
?>
    <div class="row">
      <div class="col-lg-12 text-center">
<table id="dt1" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name &amp; URL</th>
            <th>User Image</th>
            <th>User Logo</th>
            <th>Linkages</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>        
        <tr>
            <th>ID</th>
            <th>Name &amp; URL</th>
            <th>User Image</th>
            <th>User Logo</th>
            <th>Linkages</th>
            <th>Action</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        foreach($clients as $client)
        {
            if(isset($client['hof']))
                    $addClass = "red";
                else {
                    $addClass = '';
                }
                
                if(isset($client['ID']))
                {
        ?>
        <tr>
            <td class=""><?=$client['ID'];?></td>
            <td><a href="https://www.socialproof.co/profile/<?=$client['user_nicename'];?>" target="_blank"><?=$client['display_name'];?></a></td>
            <td class="text-center" id="uimg<?=$client['ID'];?>"><a href="javascript:void(0);" onClick="viewUImg(<?=$client['ID'];?>);">View</a></td>
            <td class="text-center" id="ulimg<?=$client['ID'];?>"><a href="javascript:void(0);" onClick="viewULImg(<?=$client['ID'];?>);">View</a></td>
            <td class="small">
            <?php
            //echo $client['ID'].'<br>';
                if((isset($client['hof'])) && (sizeof($client['hof']) > 0))

                {
                    $thisLinkages = array();
                    if(isset($client['hof'][0]['gmr_id']))
                        $thisLinkages[] = '';//<span class="badge badge-primary small">GMR</span>';
                    if(isset($client['hof'][0]['dfm_id']))
                        $thisLinkages[] = '';//<span class="badge badge-warning small">DFM</span>';
                    
                    //echo join(' ',$thisLinkages);
                }                
                else{}
                    //echo '<span class="badge badge-dark small">None</span>';
                
                echo '<span id="linkages'.$client['ID'].'">Loading ..</span><input type="hidden" id="dataholder'.$client['ID'].'" value=""/>';
            ?>
            </td>
            <td>
                <a href="javascript:void(0);" onClick="linkages(<?=$client['ID'];?>)" class="actionLink" title="Linkages"><i class="fa fa-link"></i></a>
                <a href="<?=$this->config->item('hof_base_url');?>reviews/<?=$client['ID'];?>"  class="actionLink" title="Reviews" target="_blank"><i class="fa fa-comments"></i></a>  
            </td>
        </tr>
        <?php
                }
        }
        ?>
    </tbody>
</table>
      </div>
    </div>
  </div>
<div id="modal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User Image</h4>
      </div>
      <div class="modal-body " id="modal1-body">
          <div class="row">
              <div class="col-md-6" id="modal1-body-img"></div>
              <div class="col-md-6 text-center" id="modal1-body-form">
              <form action="" enctype="multipart/form-data" method="POST" id="dr-img-form">
                  <input type="file" id="dr-img" name="dr-img" style="display:none;" accept=".png" onChange="readURL(this,'dr-image-preview');"/>     
                  <img src="" id="dr-image-preview"/>
                  <button type="button" onClick="trigger_dr_img();" class="btn-primary btn-xus">Select New</button>
                  <div id="extra_dr_img_options">                  
                  <button typpe="submit" class="btn-success btn-xus">Upload</button>                 
                  <button type="button" class="btn-default  btn-xus" onclick="cancel_dr_img_upload()">Cancel</button> 
                  </div>
                  <input type="hidden" name="dr_id" id="dr_id" value=""/>
              </form>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="modal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User Logo</h4>
      </div>
      <div class="modal-body" id="modal2-body">
          <div class="row">
              <div class="col-md-6" id="modal2-body-img"></div>
              <div class="col-md-6 text-center" id="modal2-body-form">
                <form action="" enctype="multipart/form-data" method="POST" id="dr-logo-form">
                    <input type="file" id="dr-logo" name="dr-logo" style="display:none;" accept=".png" onChange="readURL(this,'dr-logo-preview');"/>     
                    <img src="" id="dr-logo-preview"/>
                    <button type="button" onClick="trigger_dr_logo();" class="btn-primary btn-xus">Select New</button>
                    <div id="extra_dr_logo_options">                  
                    <button typpe="submit" class="btn-success btn-xus">Upload</button>                 
                    <button type="button" class="btn-default  btn-xus" onclick="cancel_dr_logo_upload()">Cancel</button> 
                    </div>
                    <input type="hidden" name="dr_id" id="dr_id_logo" value=""/>
                </form>                  
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <!-- Modal -->
<div id="linkages_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Linkages</h4>
      </div>
      <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="POST" id="linkages-form">
          <div class="row">
              <div class="col-md-6">
                  <h5>GMR connections</h5>
                  <select name="gmr_connection"  id="gmr_connection" size="1"  class="form-control">
                      <option class="gmr_connection_option" value="0" SELECTED>Select GMR Connection</option>
                      <?php
foreach ( (array) $gmr_connections as $index => $node )
{
    ?><option class="gmr_connection_option" value="<?=$index;?>"><?=$node;?></option><?php
}
                      ?>
                  </select>
              </div>
              <div class="col-md-6">
                  <h5>DFM connections</h5>
                  <select name="dfm_connection"  id="dfm_connection" size="1"  class="form-control">                      
                      <option class="dfm_connection_option" value="0" SELECTED>Select DFM Connection</option>
                      <?php
foreach ( (array) $dfm_connections as $index => $node )
{
    ?><option class="dfm_connection_option"  value="<?=$index;?>"><?=$node;?></option><?php
}
                      ?>
                  </select>               
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 text-center" style="padding-top:10px;">
                    <button typpe="submit" class="btn-success">Save</button>              
              </div>
          </div>
                    <input type="hidden" id="linkage_client_id"  name="linkage_client_id" value=""/>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <!-- Bootstrap core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
   <script lang="JavaScript">
      function viewUImg(id)
      {
          var uimg_url = 'https://www.socialproof.co/hof-profiles/'+id+'/dr_img.png';
          $('#dr_id').val(id);
          $('#uimg'+id).html('<a href="javascript:void(0);" onClick="loadImgPop(\'uimg\','+id+')"> <img src="'+uimg_url+'" height="75" ></a>');
      }
      function viewULImg(id)
      {
          var ulimg_url = 'https://www.socialproof.co/hof-profiles/'+id+'/dr_logo.png';
          $('#dr_id_logo').val(id);
          $('#ulimg'+id).html('<a href="javascript:void(0);" onClick="loadImgPop(\'ulimg\','+id+')"> <img src="'+ulimg_url+'" width="75" ></a>');
      }
      
      function loadImgPop(type,id)
      {
          if(type == 'uimg')
          {
                var imgurl = 'https://www.socialproof.co/hof-profiles/'+id+'/dr_img.png';
                $('#modal1-body-img').html('<img src="'+imgurl+'"/>');
                $('#modal1').modal('show');
            }
          if(type == 'ulimg')
          {
            var imgurl = 'https://www.socialproof.co/hof-profiles/'+id+'/dr_logo.png';
            $('#modal2-body-img').html('<img src="'+imgurl+'"/>');
            $('#modal2').modal('show');
          }
      }
      function trigger_dr_img()
      {
           $('#dr-img').trigger('click');
      }
      function trigger_dr_logo()
      {
           $('#dr-logo').trigger('click');
      }
      function readURL(input,preview)
      {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#'+preview).attr('src', e.target.result);
            if(preview == 'dr-image-preview')
                $('#extra_dr_img_options').show();
            if(preview == 'dr-logo-preview')
                $('#extra_dr_logo_options').show();
          }

          reader.readAsDataURL(input.files[0]);
        }
    }
    function cancel_dr_img_upload()
    {
             $('#dr-image-preview').attr('src', '');
            $('#extra_dr_img_options').hide();       
    }
    function cancel_dr_logo_upload()
    {
             $('#dr-logo-preview').attr('src', '');
            $('#extra_dr_logo_options').hide();       
    }
    function linkages(id)
    {
        var linkages = $('#dataholder'+id).val().split(',');
        $('.gmr_connection_option').attr('selected',false);
        $('.dfm_connection_option').attr('selected',false);
        $('.gmr_connection_option[value='+linkages[0]+']').attr('selected','selected');
        $('.dfm_connection_option[value='+linkages[1]+']').attr('selected','selected');
        $('#linkage_client_id').val(id);
        $('#linkages_modal').modal('show');
    }
    
    $( document ).ready(function() {

                   $.post( "<?=$this->config->item('hof_base_url');?>home/get_current_linkages/", { ids: '<?=$ids;?>' })
  .done(function( data ) {
                  
                       data = data.split('::');
               
                       var noc = data.length;
                       
                       for(i = 0; i <= noc; i++)
                       {    
                            
                            var this_item = data[i];
                            if(this_item != null)
                            {
                               
                                var this_item_data = data[i].split(',');
                                $('#linkages'+this_item_data[0]).html('');
                                
                                if(parseInt(this_item_data[1]) == 0)
                                {
                                     $('#linkages'+this_item_data[0]).html('<span class="badge badge-dark small">None</span>');
                                     
                                }
                                else
                                {
                                    var gmr_id = parseInt(this_item_data[2]);
                                    var dfm_id = parseInt(this_item_data[3]);
                                    console.log('#linkages'+this_item_data[0]+' ' +gmr_id + ' '+dfm_id);
                                    if(!(gmr_id == 0 && dfm_id == 0))
                                    {
                                    if(gmr_id > 0)
                                         $('#linkages'+this_item_data[0]).append('<span class="badge badge-primary small">GMR</span> ');

                                    if(dfm_id > 0)
                                         $('#linkages'+this_item_data[0]).append('<span class="badge badge-warning small">DFM</span> ');
                                    }
                                    else
                                        $('#linkages'+this_item_data[0]).html('<span class="badge badge-dark small">None</span>');
                                }
                                $('#dataholder'+this_item_data[0]).val(this_item_data[2]+','+this_item_data[3]);

                            }
                       }
                       var dtable = $('#dt1').DataTable();
                       dtable.page.len(10).draw();
  });
                 
          <?php

    ?>
    });
  </script>
<?php
$this->load->view('common_footer');
?>
