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
    .justified
    {
        text-align: justify;
        text-justify: inter-word;
    }
    .star_text
    {
        color:#ffcc00;
    }
</style>
  <!-- Page Content -->
  <div class="container">
         <div class="row">
      <div class="col-lg-12 text-center">
<table id="dt2" class="display">
    <thead>
        <tr>
            <th width="5%">ID</th>
            <th width="5%">Provider</th>
            <th width="15%">Reviewer</th>
            <th width="5%">Rating</th>
            <th width="10%">Created on</th>
            <th width="55%">Review</th>
            <th width="5%">Actions</th>
        </tr>
    </thead>
    <tfoot>        
        <tr>
            <th width="5%">ID</th>
            <th width="5%">Provider</th>
            <th width="15%">Reviewer</th>
            <th width="10%">Rating</th>
            <th width="10%">Created on</th>
            <th width="50%">Review</th>
            <th width="5%">Actions</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
         foreach($reviews as $review)
      {
          ?>
      <tr>
          <td><small><?=$review['id'];?></small></td>
          <td><small><?=$review['provider_name'];?></small></td>
          <td><small><?=$review['user_name'];?></small></td>
          <td class="star_text"><small><?= str_repeat('&#9733; ', $review['rating']);?></small></td>
          <td><small><?=($review['created_on'] == '0000-00-00')?'Not saved':$review['created_on'];?></small></td>
          <td class="justified"><mark><small><small><?=$review['comment'];?></small></small></mark></td>
          <td></td>
      </tr>
          <?php
      }
        ?>
    </tbody>
</table>
          
<?php
     /* foreach($reviews as $review)
      {
          ?>
      <pre>
          <?php
                    print_r($review);
          ?>
      </pre>
          <?php
      }*/
?>
  </div>

    <!-- Bootstrap core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="<?=$this->config->item('hof_base_url');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<?php
$this->load->view('common_footer');
?>
