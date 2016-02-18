
<div id="data_lists">
<ul class="nav nav-tabs" id="Tab">
  <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span>Facilities that Logged In</a></li>
  <li><a href="#nli" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Facilities that haven't Logged In</a></li>
  <li><a href="#issued" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Facilities that Issued</a></li>
  <li><a href="#n_issued" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Facilities that haven't Issued</a></li>
</ul>

<div class="tab-content" style="margin-top: 5px;">
<div class="tab-pane active" id="home">
  	

<br/><br/>
<center>
<div style="width:100%;height:auto;float:left;margin-left:10px;">

<h4 style="font-size:14px">Facilities that Have Logged In at least once during the month of <?php echo $month_text.' '.$year;?></h4>
<table id="sms_usage" class="table table-hover table-bordered table-update col-md-10">
  <thead>
    <tr>
      <th ><b>Facility Name</b></th>
      <th ><b>Facility Code</b></th>
      <th ><b>Sub-County</b></th>
      <th ><b>County</b></th>
    </tr> 
  </thead>
  <tbody>
    <?php 
      $row_data = $monthly_logs['logged_in'];      
      $count = count($row_data);
      foreach ($row_data as $key => $value) {
        $facility_name = $value['facility_name'];
        $facility_code = $value['facility_code'];
        $sub_county = $value['district'];
        $county = $value['county']; ?>
        <tr>
          <td><?php echo $facility_name;?></td>
          <td><?php echo $facility_code;?></td>
          <td><?php echo $sub_county;?></td>
          <td><?php echo $county;?></td>
        </tr>
      <?php }
     
    ?>
  </tbody>
  </table>
</div>
</center>

<br/><br/>
<center>
<hr/>
<div style="width:100%;margin-top:60px;height:auto;float:left;margin-left:10px;border-top:1px ridge">
<br/>
<h4 style="font-size:14px">Facilities that Have Logged In at least 4 times during the month of <?php echo $month_text.' '.$year;?></h4>
<table id="facility_nli1" class="table table-hover table-bordered table-update col-md-10">
  <thead>
    <tr>
      <th ><b>Facility Name</b></th>
      <th ><b>Facility Code</b></th>
      <th ><b>Sub-County</b></th>
      <th ><b>County</b></th>
      <th ><b>Number of Logins</b></th>
    </tr> 
  </thead>
  <tbody>
    <?php 
      $row_data = $monthly_logs['logged_in_count'];      
      $count = count($row_data);
      foreach ($row_data as $key => $value) {
        $facility_name = $value['facility_name'];
        $facility_code = $value['facility_code'];
        $sub_county = $value['district'];
        $number = $value['days'];
        $county = $value['county']; ?>
        <tr>
          <td><?php echo $facility_name;?></td>
          <td><?php echo $facility_code;?></td>
          <td><?php echo $sub_county;?></td>
          <td><?php echo $county;?></td>
          <td><?php echo $number;?></td>
        </tr>
      <?php }
     
    ?>
  </tbody>
  </table>
</div>
</center>
<br/>
<br/>
  	
</div>
<div class="tab-pane" id="nli">  

<br/><br/>
<center>
<div style="width:100%">

<h4 style="font-size:14px">Facilities that Have Not Logged In at least once during the month of <?php echo $month_text.' '.$year;?></h4>
<table id="facility_nli1" class="table table-hover table-bordered table-update col-md-10">
  <thead>
    <tr>
      <th ><b>Facility Name</b></th>
      <th ><b>Facility Code</b></th>
      <th ><b>Sub-County</b></th>
      <th ><b>County</b></th>
    </tr> 
  </thead>
  <tbody>
    <?php 
      $row_data = $monthly_logs['not_logged_in'];      
      $count = count($row_data);
      foreach ($row_data as $key => $value) {
        $facility_name = $value['facility_name'];
        $facility_code = $value['facility_code'];
        $sub_county = $value['district'];
        $county = $value['county']; ?>
        <tr>
          <td><?php echo $facility_name;?></td>
          <td><?php echo $facility_code;?></td>
          <td><?php echo $sub_county;?></td>
          <td><?php echo $county;?></td>
        </tr>
      <?php }
     
    ?>
  </tbody>
  </table>
</div>
</center>

    
  </div>
  <div class="tab-pane" id="issued">  
    <center>
<div style="width:100%;height:auto;float:left;margin-left:10px;">

<h4 style="font-size:14px">Facilities that Issued at least once during the month of <?php echo $month_text.' '.$year;?></h4>
<table id="sms_usage" class="table table-hover table-bordered table-update col-md-10">
  <thead>
    <tr>
      <th ><b>Facility Name</b></th>
      <th ><b>Facility Code</b></th>
      <th ><b>Sub-County</b></th>
      <th ><b>County</b></th>
    </tr> 
  </thead>
  <tbody>
    <?php 
      $row_data = $monthly_logs['issued_within_month'];      
      $count = count($row_data);
      foreach ($row_data as $key => $value) {
        $facility_name = $value['facility_name'];
        $facility_code = $value['facility_code'];
        $sub_county = $value['district'];
        $county = $value['county']; ?>
        <tr>
          <td><?php echo $facility_name;?></td>
          <td><?php echo $facility_code;?></td>
          <td><?php echo $sub_county;?></td>
          <td><?php echo $county;?></td>
        </tr>
      <?php }
     
    ?>
  </tbody>
  </table>
</div>
</center>

<br/><br/>
<center>
<hr/>
<div style="width:100%;margin-top:60px;height:auto;float:left;margin-left:10px;border-top:1px ridge">
<br/>
<h4 style="font-size:14px">Facilities that Issued at least 4 times during the month of <?php echo $month_text.' '.$year;?></h4>
<table id="facility_nli1" class="table table-hover table-bordered table-update col-md-10">
  <thead>
    <tr>
      <th ><b>Facility Name</b></th>
      <th ><b>Facility Code</b></th>
      <th ><b>Sub-County</b></th>
      <th ><b>County</b></th>
      <th ><b>Number of Issues</b></th>
    </tr> 
  </thead>
  <tbody>
    <?php 
      $row_data = $monthly_logs['issued_count'];      
      $count = count($row_data);
      foreach ($row_data as $key => $value) {
        $facility_name = $value['facility_name'];
        $facility_code = $value['facility_code'];
        $sub_county = $value['district'];
        $number = $value['days'];
        $county = $value['county']; ?>
        <tr>
          <td><?php echo $facility_name;?></td>
          <td><?php echo $facility_code;?></td>
          <td><?php echo $sub_county;?></td>
          <td><?php echo $county;?></td>
          <td><?php echo $number;?></td>
        </tr>
      <?php }
     
    ?>
  </tbody>
  </table>
</div>
</center>


    
  </div>
  <div class="tab-pane" id="n_issued">  

<br/><br/>
<center>
<div style="width:100%">

<h4 style="font-size:14px">Facilities that Have Not Issued during the month of <?php echo $month_text.' '.$year;?></h4>
<table id="facility_nli1" class="table table-hover table-bordered table-update col-md-10">
  <thead>
    <tr>
      <th ><b>Facility Name</b></th>
      <th ><b>Facility Code</b></th>
      <th ><b>Sub-County</b></th>
      <th ><b>County</b></th>
    </tr> 
  </thead>
  <tbody>
    <?php 
      $row_data = $monthly_logs['not_issued'];      
      $count = count($row_data);
      foreach ($row_data as $key => $value) {
        $facility_name = $value['facility_name'];
        $facility_code = $value['facility_code'];
        $sub_county = $value['district'];
        $county = $value['county']; ?>
        <tr>
          <td><?php echo $facility_name;?></td>
          <td><?php echo $facility_code;?></td>
          <td><?php echo $sub_county;?></td>
          <td><?php echo $county;?></td>
        </tr>
      <?php }
     
    ?>
  </tbody>
  </table>
</div>
</center>

    
  </div>
</div>  
</div>


