<tr>
	<td style="background-color:#FFFFFF">1</td>
	<td>Molecular , COBAS, TaqMan, CAP/CTM HIV v2.0, Quantitative (<strong>Manf. Code </strong>5212294190)</td>
	<td><small>48 tests</small></td>
	<td><div align="center">
	  <input type="text"  name="voqualkit"  class="input-small" size="10" value="<?php echo @$vopeningqualkit;?>" style = "background:#F6F6F6; font-weight:bold"/>
    </div></td>
	<td><div align="center">
      <input type="text"  name="vrecqualkit"  class="input-small" size="10" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="" value="<?php echo @$vqualkitreceived_a;?>"/>
    </div></td>
	<td><div align="center">
      <input type="text" name="vkitlotno"  class="input-small" size="20" style = "background:#F6F6F6; font-weight:bold; color:#999999" value="<?php echo @$vkitlotno_a;?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small" style = "background:#F6F6F6; color:#999999; font-weight:bold" name="vuqualkit" size="10"  value="<?php echo ceil(@$vuqualkit);?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small"  value="<?php echo @$vwqualkit;?>" name="vwqualkit" size="10" style = "background:#F6F6F6; font-weight:bold" />
    </div></td>
	<td><div align="center">
      <input type="text"  class="input-small" name="vpqualkit" size="10" style = "background:#F6F6F6;"  value="<?php echo @$vqualkitreceived;?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$viqualkit;?>" name="viqualkit" size="10" style = "background:#F6F6F6; font-weight:bold"/>
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$vequalkit;?>" style = "background:#F6F6F6;font-weight:bold" name="vequalkit" size="10" />
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small"   value="<?php echo @$vrqualkit;?>" name="rvqualkit" size="10" style = "background:#F6F6F6;font-weight:bold" />
    </div></td>
</tr>
<tr>
	<td style="background-color:#FFFFFF">2</td>
	<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, AmpliPrep, Specimen Pre-Extraction Reagent</td>
	<td style="background-color:#FFFFFF"><small>350 tests </small></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" name="vospexagent" size="10" value="<?php echo @$vopeningspexagent;?>" style = "background:#ffffff; font-weight:bold"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text"  class="input-small" name="vrecspexagent" size="10" style = "background:#ffffff; font-weight:bold; color:#999999" value="<?php echo ceil(@$vspexagentreceived_a);?>"/>
    </div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" name="vuspexagent" size="10" style = "background:#ffffff; color:#999999; font-weight:bold" value="<?php echo ceil(@$vuspexagent);?>"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$vwspexagent;?>" name="vwspexagent" size="10" style = "background:#ffffff; font-weight:bold" />
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text"  class="input-small" name="vpspexagent" size="10" style = "background:#FFFFff;" value="<?php echo @$vspexagentreceived;?>"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$vispexagent;?>" name="vispexagent" size="10" style = "background:#ffffff; font-weight:bold"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$vespexagent;?>"  style = "background:#ffffff;font-weight:bold" name="vespexagent" size="10" />
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small"   value="<?php echo @$vrspexagent;?>" name="rvspexagent" size="10" style = "background:#FFFFFF;font-weight:bold"/>
    </div></td>
</tr>
<tr>
	<td style="background-color:#FFFFFF">3</td>
	<td>Molecular, COBAS, TaqMan, Ampliprep,  Input S-tube</td>
	<td><small>12 * 24</small></td>
	<td><div align="center">
	  <input type="text"  class="input-small" name="voampinput" size="10" value="<?php echo @$vopeningampinput;?>" style = "background:#F6F6F6; font-weight:bold"/>
    </div></td>
	<td><div align="center">
      <input type="text"  class="input-small" name="vrecampinput" size="10" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="writeMessage()" value="<?php echo ceil(@$vampinputreceived_a);?>"/>
    </div></td>
	<td>-</td>
	<td><div align="center">
	  <input type="text" class="input-small" name="vuampinput" size="10" style = "background:#F6F6F6; color:#999999; font-weight:bold" value="<?php echo ceil(@$vuampinput);?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$vwampinput;?>" name="vwampinput" size="10" style = "background:#F6F6F6; font-weight:bold" />
    </div></td>
	<td><div align="center">
      <input type="text"  class="input-small" name="vpampinput" size="10" style = "background:#F6F6F6;" value="<?php echo @$vampinputreceived;?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$viampinput;?>" name="viampinput" size="10" style = "background:#F6F6F6; font-weight:bold"/>
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$veampinput;?>"  style = "background:#F6F6F6;font-weight:bold" name="veampinput" size="10" />
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small"   value="<?php echo @$vrampinput;?>" name="rvampinput" size="10" style = "background:#F6F6F6;font-weight:bold" />
    </div></td>
</tr>
<tr>
	<td style="background-color:#FFFFFF">4</td>
	<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, Ampliprep,
 <!--Flapless --> SPU</td>
	<td style="background-color:#FFFFFF"><small>12 * 24</small></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" name="voampflapless" size="10" value="<?php echo @$vopeningampflapless;?>" style = "background:#ffffff; font-weight:bold"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text"  class="input-small" name="vrecampflapless" size="10" style = "background:#ffffff; font-weight:bold; color:#999999" value="<?php echo ceil(@$vampflaplessreceived_a);?>"/>
    </div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small" name="vuampflapless" size="10" style = "background:#ffffff; color:#999999; font-weight:bold" value="<?php echo ceil(@$vuampflapless);?>"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$vwampflapless;?>" name="vwampflapless" size="10" style = "background:#ffffff; font-weight:bold" />
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text"  class="input-small" name="vpampflapless" size="10" style = "background:#FFFFff;" value="<?php echo @$vampflaplessreceived;?>"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$viampflapless;?>" name="viampflapless" size="10" style = "background:#ffffff; font-weight:bold"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$veampflapless;?>"  style = "background:#ffffff;font-weight:bold" name="veampflapless" size="10" />
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small"   value="<?php echo @$vrampflapless;?>" name="rvampflapless" size="10" style = "background:#FFFFFF;font-weight:bold" />
    </div></td>
</tr>			
<tr>
	<td style="background-color:#FFFFFF">5</td>
	<td>Molecular, COBAS, TaqMan, Ampliprep,  Wash Reagent</td>
	<td><small>5.1 Litres</small></td>
	<td><div align="center">
	  <input type="text" class="input-small"  name="voampwash" size="10" value="<?php echo @$vopeningampwash;?>" style = "background:#F6F6F6; font-weight:bold"/>
    </div></td>
	<td><div align="center">
      <input type="text" class="input-small" name="vrecampwash" size="10" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="writeMessage()" value="<?php echo ceil(@$vampwashreceived_a);?>"/>
    </div></td>
	<td>-</td>
	<td><div align="center">
	  <input type="text" class="input-small" name="vuampwash" size="10" style = "background:#F6F6F6; color:#999999; font-weight:bold" value="<?php echo ceil(@$vuampwash);?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$vwampwash;?>" name="vwampwash" size="10" style = "background:#F6F6F6; font-weight:bold" />
    </div></td>
	<td><div align="center">
      <input type="text" class="input-small" name="vpampwash" size="10" style = "background:#F6F6F6;" value="<?php echo @$vampwashreceived;?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$viampwash;?>" name="viampwash" size="10" style = "background:#F6F6F6; font-weight:bold"/>
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$veampwash;?>" style = "background:#F6F6F6;font-weight:bold" name="veampwash" size="10" />
    </div></td>
	<td><div align="center">
	  <input type="text"  class="input-small"   value="<?php echo @$vrampwash;?>" name="rvampwash" size="10" style = "background:#F6F6F6;font-weight:bold" />
    </div></td>
</tr>
<tr>
	<td style="background-color:#FFFFFF">6</td>
	<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, Ampliprep, K-tips, 1.2mm</td>
	<td style="background-color:#FFFFFF"><small> 12 * 36</small></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" name="voampktips" size="10" value="<?php echo @$vopeningampktips;?>" style = "background:#ffffff; font-weight:bold"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text"  class="input-small" name="vrecampktips" size="10" style = "background:#ffffff; font-weight:bold; color:#999999" value="<?php echo ceil(@$vampktipsreceived_a);?>"/>
    </div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small" name="vuampktips" size="10" style = "background:#ffffff; color:#999999; font-weight:bold" value="<?php echo ceil(@$vuampktips);?>"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$vwampktips;?>" name="vwampktips" size="10" style = "background:#ffffff; font-weight:bold" />
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-small" name="vpampktips" size="10" style = "background:#FFFFff;" value="<?php echo @$vampktipsreceived;?>"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$viampktips;?>" name="viampktips" size="10" style = "background:#ffffff; font-weight:bold"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small" value="<?php echo @$veampktips;?>" style = "background:#ffffff;font-weight:bold" name="veampktips" size="10" />
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text"  class="input-small"   value="<?php echo @$vrampktips;?>" name="rvampktips" size="10" style = "background:#FFFFFF;font-weight:bold" />
    </div></td>
</tr>
<tr>
	<td style="background-color:#FFFFFF">7</td>
	<td>Molecular, COBAS, TaqMan, K-Tubes</td>
	<td><small>12 * 96 Pcs</small></td>
	<td><div align="center">
	  <input type="text" class="input-small"  name="voktubes" size="10" value="<?php echo @$vopeningktubes;?>" style = "background:#F6F6F6; font-weight:bold"/>
    </div></td>
	<td><div align="center">
      <input type="text" class="input-small" name="vrecktubes" size="10" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="writeMessage()" value="<?php echo ceil(@$vktubesreceived_a);?>"/>
    </div></td>
	<td>-</td>
	<td><div align="center">
	  <input type="text" class="input-small" name="vuktubes" size="10" style = "background:#F6F6F6; color:#999999; font-weight:bold" value="<?php echo ceil(@$vuktubes);?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$vwktubes;?>" name="vwktubes" size="10" style = "background:#F6F6F6; font-weight:bold" />
    </div></td>
	<td><div align="center">
      <input type="text" class="input-small" name="vpktubes" size="10" style = "background:#F6F6F6;" value="<?php echo @$vktubesreceived;?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$viktubes;?>" name="viktubes" size="10" style = "background:#F6F6F6; font-weight:bold"/>
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$vektubes;?>" style = "background:#F6F6F6;font-weight:bold" name="vektubes" size="10"/>
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"    value="<?php echo @$vrktubes;?>" name="rvktubes" size="10" style = "background:#F6F6F6;font-weight:bold" />
    </div></td>
</tr>
<tr class="even">
	<td colspan="12" style="background-color:#FFFFFF">&nbsp;</td>				
</tr>
<tr class="even">
	<td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#9900CC">negative adjustments</font><br /><small>( eg. where were the kits issued out / donated to and why. )</small></strong></div></td>
  <td colspan="3">
  <textarea name="viicomments"   cols="50" rows="2" style="font-family:monospace; font-size:11.2px; border:none" disabled="disabled"><?php echo @$vicomments;?></textarea>
  <input type="hidden" class="input-small" name="vicomments" value="<?php echo @$vicomments;?>"/></td>	
	
	<td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#009900">positive adjustments</font><br /><small>( eg. where were the kits were received from. )</small></strong></div></td>
  <td colspan="3"><input type="hidden" name="vrowID" value="<?php echo @$vrowID;?>" style = "background:#FFFFCC; font-weight:bold"/>
  <input type="hidden" name="vreceivedtestkitlotnno"  value="<?php echo @$vkitlotno;?>" />
 <input type="hidden" name="vreceivedfrom"  value="<?php echo @$vlabfrom;?>" />
 <input type="hidden" name="vreceiveddate"  value="<?php echo @$vdatereceived;?>" />
 <!--<input type="hidden" name="vreceivedby"  value="<?php //echo @$vreceivedby;?>" /> -->
  <?php 
  if (@$vlabfrom == '')
  {	echo 'No Comments';
  }
  else
  {
  	echo '<em>Test Kit Lot No = '.@$vkitlotno.'<br>Kit Source = '.@$vlabfrom.'<br>Date Received = '.@$vdatereceived.'<br>Date Entered = '.@$vdateentered.'</em>';
  }
  ?></td>					
</tr>