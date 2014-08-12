<tr>
	<td style="background-color:#FFFFFF">1</td>
	<td>Molecular, COBAS, TaqMan, AmpliPrep, HIV-1, Qualitative (<strong>Manf. Code</strong> 5035724190)</td>
	<td><small>48 tests </small></td>
	<td><div align="center">
	  <input type="text" class="input-small" value="<?php echo @$openingqualkit;?>" name="oqualkit" size="5" style = "background:#F6F6F6; font-weight:bold" />
    </div></td>
	<td><div align="center">
      <input type="text" class="input-small" " name="recqualkit" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="" value="<?php echo @$qualkitreceived_a;?>"/>
    </div></td>
	<td><div align="center">
      <input type="text" class="input-small" name="kitlotno" size="20" style = "background:#F6F6F6; font-weight:bold; color:#999999" value="<?php echo @$kitlotno_a;?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"  name="uqualkit" size="5" value="<?php echo ceil(@$uqualkit);?>"  style = "background:#F6F6F6; font-weight:bold; color:#999999" />
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"   value="<?php echo @$wqualkit;?>" name="wqualkit" size="5" style = "background:#F6F6F6;font-weight:bold;"/>
    </div></td>
	<td><div align="center">
      <input type="text" class="input-small"  name="pqualkit" size="5" style = "background:#F6F6F6;"  value="<?php echo @$qualkitreceived;?>"/>
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"   value="<?php echo @$iqualkit;?>" name="iqualkit" size="5" style = "background:#F6F6F6;font-weight:bold;" />
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"   style = "background:#F6F6F6;font-weight:bold;" value="<?php echo @$equalkit;?>" name="equalkit" size="5" />
    </div></td>
	<td><div align="center">
	  <input type="text" class="input-small"    value="<?php echo @$rqualkit;?>" name="rqualkit" size="5" style = "background:#F6F6F6;font-weight:bold;" />
    </div></td>
</tr>

<tr>
	<td style="background-color:#FFFFFF">2</td>
	<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, AmpliPrep, Specimen Pre-Extraction Reagent</td>
	<td style="background-color:#FFFFFF"><small>350 tests </small></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$openingspexagent;?>" name="ospexagent" size="5" style = "background:#FfFfFf; font-weight:bold"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-small"  name="recspexagent" size="5" style = "background:#FfFfFf; font-weight:bold; color:#999999" value="<?php echo ceil(@$spexagentreceived_a);?>"/>
    </div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small" name="uspexagent" size="5" style = "background:#FfFfFf; font-weight:bold; color:#999999"  value="<?php echo ceil(@$uspexagent);?>"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$wspexagent;?>" name="wspexagent" size="5" style = "background:#FfFfFf;font-weight:bold;"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-small" name="pspexagent" size="5" style = "background:#FFFFff;" value="<?php echo @$spexagentreceived;?>"/>
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small"  value="<?php echo @$ispexagent;?>" name="ispexagent" size="5" style = "background:#FfFfFf;font-weight:bold;" />
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small"  style = "background:#FfFfFf;font-weight:bold;" value="<?php echo @$espexagent;?>" name="espexagent" size="5" />
    </div></td>
	<td style="background-color:#FFFFFF"><div align="center">
	  <input type="text" class="input-small"   value="<?php echo @$rspexagent;?>" name="rspexagent" size="5" style = "background:#FFFFFF;font-weight:bold;"/>
    </div></td>
</tr>
<tr>
	<td style="background-color:#FFFFFF">3</td>
	<td>Molecular, COBAS, TaqMan, Ampliprep, Input S-tubes</td>
<td><small>12 * 24</small></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$openingampinput;?>" name="oampinput" size="5" style = "background:#F6F6F6; font-weight:bold"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  name="recampinput" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999" onkeyup="writeMessage()" value="<?php echo ceil(@$ampinputreceived_a);?>"/>
</div></td>
<td>-</td>
<td><div align="center">
  <input type="text" class="input-small" name="uampinput" size="5"  style = "background:#F6F6F6; font-weight:bold; color:#999999"  value="<?php echo ceil(@$uampinput);?>"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$wampinput;?>" name="wampinput" size="5" style = "background:#F6F6F6;font-weight:bold;"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  name="pampinput" size="5" style = "background:#F6F6F6;" value="<?php echo @$ampinputreceived;?>"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  value="<?php echo @$iampinput;?>" name="iampinput" size="5" style = "background:#F6F6F6;font-weight:bold;" />
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  style = "background:#F6F6F6;font-weight:bold;" value="<?php echo @$eampinput;?>" name="eampinput" size="5" />
</div></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$rampinput;?>" name="rampinput" size="5" style = "background:#F6F6F6;font-weight:bold;" />
</div></td>
</tr>
<tr>
<td style="background-color:#FFFFFF">4</td>
<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, Ampliprep <!--Flapless--> SPU</td>
<td style="background-color:#FFFFFF"><small>12 * 24</small></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$openingampflapless;?>" name="oampflapless" size="5" style = "background:#FfFfFf; font-weight:bold"/>
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"  name="recampflapless" size="5" style = "background:#FfFfFf; font-weight:bold; color:#999999"  value="<?php echo ceil(@$ampflaplessreceived_a);?>"/>
</div></td>
<td style="background-color:#FFFFFF">-</td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small" name="uampflapless" size="5" style = "background:#FfFfFf; font-weight:bold; color:#999999"  value="<?php echo ceil(@$uampflapless);?>"/>
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$wampflapless;?>" name="wampflapless" size="5" style = "background:#FfFfFf;font-weight:bold;"/>
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"  name="pampflapless" size="5" style = "background:#FfFfFf;"  value="<?php echo @$ampflaplessreceived;?>"/>
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"  value="<?php echo @$iampflapless;?>" name="iampflapless" size="5" style = "background:#FfFfFf;font-weight:bold;" />
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"  style = "background:#FfFfFf;font-weight:bold;" value="<?php echo @$eampflapless;?>" name="eampflapless" size="5" />
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$rampflapless;?>" name="rampflapless" size="5" style = "background:#FFFFFF;font-weight:bold;" />
</div></td>
</tr>			
<tr>
<td style="background-color:#FFFFFF">5</td>
<td>Molecular, COBAS, TaqMan, AmpliPrep, Wash Reagent</td>
<td><small>5.1 Litres</small></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$openingampwash;?>" name="oampwash" size="5" style = "background:#F6F6F6; font-weight:bold"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small" name="recampwash" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999"  value="<?php echo ceil(@$ampwashreceived_a);?>"/>
</div></td>
<td>-</td>
<td><div align="center">
  <input type="text" class="input-small" name="uampwash" size="5"  style = "background:#F6F6F6; font-weight:bold; color:#999999"  value="<?php echo ceil(@$uampwash);?>"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$wampwash;?>" name="wampwash" size="5" style = "background:#F6F6F6;font-weight:bold;"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small" name="pampwash" size="5" style = "background:#F6F6F6;"  value="<?php echo @$ampwashreceived;?>"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  value="<?php echo @$iampwash;?>" name="iampwash" size="5" style = "background:#F6F6F6;font-weight:bold;" />
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  style = "background:#F6F6F6;font-weight:bold;" value="<?php echo @$eampwash;?>" name="eampwash" size="5" />
</div></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$rampwash;?>" name="rampwash" size="5" style = "background:#F6F6F6;font-weight:bold;" />
</div></td>
</tr>
<tr>
<td style="background-color:#FFFFFF">6</td>
<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, Ampliprep, K-tips, 1.2mm</td>
<td style="background-color:#FFFFFF"><small>1.2mm, 12 * 36</small></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$openingampktips;?>" name="oampktips" size="5" style = "background:#FFFFFF; font-weight:bold"/>
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"  name="recampktips" size="5" style = "background:#FFFFFF; font-weight:bold; color:#999999" value="<?php echo ceil(@$ampktipsreceived_a);?>"/>
</div></td>
<td style="background-color:#FFFFFF">-</td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small" name="uampktips" size="5"  style = "background:#FfFfFf; font-weight:bold; color:#999999"  value="<?php echo ceil(@$uampktips);?>"/>
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$wampktips;?>" name="wampktips" size="5" style = "background:#FfFfFf;font-weight:bold;" />
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small" name="pampktips" size="5" style = "background:#FFFFFF;" value="<?php echo @$ampktipsreceived;?>"/>
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"  value="<?php echo @$iampktips;?>" name="iampktips" size="5" style = "background:#FfFfFf;font-weight:bold;" />
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"  style = "background:#FfFfFf;font-weight:bold;" value="<?php echo @$eampktips;?>" name="eampktips" size="5" />
</div></td>
<td style="background-color:#FFFFFF"><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$rampktips;?>" name="rampktips" size="5" style = "background:#FFFFFF;font-weight:bold;" />
</div></td>
</tr>
<tr>
<td style="background-color:#FFFFFF">7</td>
<td>Molecular, COBAS, TaqMan, K-Tubes</td>
<td><small>12 * 96 </small></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$openingktubes;?>" name="oktubes" size="5" style = "background:#F6F6F6; font-weight:bold"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small" name="recktubes" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999"  value="<?php echo ceil(@$ktubesreceived_a);?>"/>
</div></td>
<td>-</td>
<td><div align="center">
  <input type="text" class="input-small" name="uktubes" size="5" style = "background:#F6F6F6; font-weight:bold; color:#999999"  value="<?php echo ceil(@$uktubes);?>"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$wktubes;?>" name="wktubes" size="5" style = "background:#F6F6F6;font-weight:bold;"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  name="pktubes" size="5" style = "background:#F6F6F6;" value="<?php echo @$ktubesreceived;?>"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  value="<?php echo @$iktubes;?>" name="iktubes" size="5" style = "background:#F6F6F6;font-weight:bold;" />
</div></td>
<td><div align="center">
  <input type="text" class="input-small"  style = "background:#F6F6F6;font-weight:bold;" value="<?php echo @$ektubes;?>" name="ektubes" size="5"/>
</div></td>
<td><div align="center">
  <input type="text" class="input-small"   value="<?php echo @$rktubes;?>" name="rktubes" size="5" style = "background:#F6F6F6;font-weight:bold;" />
</div></td>
</tr>
<tr class="even">
<td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#9900CC">negative adjustments</font><br /><small>( eg. where were the kits issued out / donated to and why. )</small></strong></div></td>
  <td colspan="3">
  <textarea name="iicomments" cols="50" rows="2" style="font-family:monospace; font-size:11.2px; border:none" disabled="disabled" ><?php echo @$icomments;?></textarea>
  <input type="hidden" name="icomments" value="<?php echo @$icomments;?>"/>			  </td>			
<!--</tr>
<tr class="even"> -->
<td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#009900">positive adjustments</font><br /><small>( eg. where were the kits were received from. )</small></strong></div></td>
  <td colspan="3">
  <input type="hidden" name="rowID" size="5" value="<?php echo @$rowID;?>" style = "background:#FFFFCC; font-weight:bold"/>
 <input type="hidden" name="receivedtestkitlotnno"  value="<?php echo @$kitlotno;?>" />
 <input type="hidden" name="receivedfrom"  value="<?php echo @$labfrom;?>" />
 <input type="hidden" name="receiveddate"  value="<?php echo @$datereceived;?>" />
 <!--<input type="hidden" name="receivedby"  value="<?php //echo $receivedby;?>" /> -->
  <?php 
  if (@$labfrom == '')
  {	echo 'No Comments';
  }
  else
  {
  	echo '<em>Test Kit Lot No = '.@$kitlotno.'<br>Kit Source = '.@$labfrom.'<br>Date Received = '.@$datereceived.'<br>Date Entered = '.@$dateentered.'</em>';
}?></td>				

</tr>