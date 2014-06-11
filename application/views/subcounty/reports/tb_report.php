

<div class="container" style="width: 96%; margin: auto;">
<div class="table-responsive " style="height:400px; overflow-y: auto;">
	<form action="" name="" class="">
<table width="100%" class="table table-bordered table-condensed table-responsive row-fluid table-condensed">
<!-- width="98%" border="0" class="row-fluid table table-hover table-bordered table-update" -->
	<tbody>
		<tr>
	<table width="100%" class="table table-bordered table-condensed table-responsive row-fluid table-condensed">
			<td>Facility Name:</td>
			<td><input type= 'text' name="facility_name" class="form-control"></td>

			<td>District/Region:</td>
			<td><input type= 'text' name="district_name" class="form-control"></td>

		</tr>
<!-- second row -->
		<tr>
		<div class="input-group">
			<td>Facility Type: </td>
			<td><label>DISP</label><input type="checkbox" name="dispensary" value="" class="checkbox "></td>
			<td><label>HC</label><input type="checkbox" name="hc" value="" class="checkbox"></td>
			<td><label>SDH</label><input type="checkbox" name="sdh" value="" class="checkbox"></td>
			<td><label>DH</label><input type="checkbox" name="dh" value="" class="checkbox"></td>
			<td><label>PGH</label><input type="checkbox" name="pgh" value="" class="checkbox"></td>
			<td><label>CLN</label><input type="checkbox" name="cln" value="" class="checkbox"></td>
			</div>
		</tr>

		<!-- fourth -->
		<tr>
			<td>Beginning Date (of Reporting Period): </td>
			<td><input type="text" required name="beginning_date" value="" class='form-control'></td>
		
			<td>Ending Date (of Reporting Period): </td>
			<td><input type="text" required name="ending_date" value="" class='form-control'></td>
		</tr>
		</table>
		<tr>
		<!-- use colspan on a td -->
			<table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update">
				<thead>
				<tr>
					<th>Commodity</th>
					<th>Unit</th>
					<th>Beginning Balance (at the start of the month)</th>
					<th>Received This Month</th>
					<th>Quantity Dispensed</th>
					<th>Positive Adjustment</th>
					<th>Negative Adjustment</th>
					<th>Losses</th>
					<th>Physical Count</th>
					<th colspan="2">Earliest Expiry Date (6 months)</th>
					<th>Quantity Needed</th>
				</tr>
				</thead>
				<tr>
					<td colspan="12" class=""><div class = "alert alert-info">TB drugs</div></td>
				</tr>
<!-- tb packs -->
				<tr>
					<td>TB Patient Packs Category</td>
					<td>Packs</td>
					<td><input type="text" required name="a1" value="" class='form-control' class=""></td>
					<td><input type="text" required name="a2" value="" class='form-control'></td>
					<td><input type="text" required name="a3" value="" class='form-control'></td>
					<td><input type="text" required name="a4" value="" class='form-control'></td>
					<td><input type="text" required name="a5" value="" class='form-control'></td>
					<td><input type="text" required name="a6" value="" class='form-control'></td>
					<td><input type="text" required name="a7" value="" class='form-control'></td>
					<td><input type="text" required name="a8" value="" class='form-control'></td>
					<td><input type="text" required name="a9" value="" class='form-control'></td>
					<td><input type="text" required name="a10" value="" class='form-control'></td>

				</tr>

				<!-- r/h/z/e 150 -->
				<tr>
					<td>R/H/Z/E 150/75/400/275 mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="b1" value="" class='form-control'></td>
					<td><input type="text" required name="b2" value="" class='form-control'></td>
					<td><input type="text" required name="b3" value="" class='form-control'></td>
					<td><input type="text" required name="b4" value="" class='form-control'></td>
					<td><input type="text" required name="b5" value="" class='form-control'></td>
					<td><input type="text" required name="b6" value="" class='form-control'></td>
					<td><input type="text" required name="b7" value="" class='form-control'></td>
					<td><input type="text" required name="b8" value="" class='form-control'></td>
					<td><input type="text" required name="b9" value="" class='form-control'></td>
					<td><input type="text" required name="b10" value="" class='form-control'></td>
				</tr>

				<!-- R/H/Z/E 150/75/275 mg -->
				<tr>
					<td>R/H/Z/E 150/75/275 mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="c1" value="" class='form-control'></td>
					<td><input type="text" required name="c2" value="" class='form-control'></td>
					<td><input type="text" required name="c3" value="" class='form-control'></td>
					<td><input type="text" required name="c4" value="" class='form-control'></td>
					<td><input type="text" required name="c5" value="" class='form-control'></td>
					<td><input type="text" required name="c6" value="" class='form-control'></td>
					<td><input type="text" required name="c7" value="" class='form-control'></td>
					<td><input type="text" required name="c8" value="" class='form-control'></td>
					<td><input type="text" required name="c9" value="" class='form-control'></td>
					<td><input type="text" required name="c10" value="" class='form-control'></td>
				</tr>

				<!-- Streptomycin Injection -->
				<tr>
					<td>Streptomycin Injection 1Gm</td>
					<td>Vials</td>
					<td><input type="text" required name="d1" value="" class='form-control'></td>
					<td><input type="text" required name="d2" value="" class='form-control'></td>
					<td><input type="text" required name="d3" value="" class='form-control'></td>
					<td><input type="text" required name="d4" value="" class='form-control'></td>
					<td><input type="text" required name="d5" value="" class='form-control'></td>
					<td><input type="text" required name="d6" value="" class='form-control'></td>
					<td><input type="text" required name="d7" value="" class='form-control'></td>
					<td><input type="text" required name="d8" value="" class='form-control'></td>
					<td><input type="text" required name="d9" value="" class='form-control'></td>
					<td><input type="text" required name="d10" value="" class='form-control'></td>
				</tr>

				<!-- R/H 150/75 mg  -->
				<tr>
					<td>R/H 150/75 mg </td>
					<td>Tablets</td>
					<td><input type="text" required name="rh1" value="" class='form-control'></td>
					<td><input type="text" required name="rh2" value="" class='form-control'></td>
					<td><input type="text" required name="rh3" value="" class='form-control'></td>
					<td><input type="text" required name="rh4" value="" class='form-control'></td>
					<td><input type="text" required name="rh5" value="" class='form-control'></td>
					<td><input type="text" required name="rh6" value="" class='form-control'></td>
					<td><input type="text" required name="rh7" value="" class='form-control'></td>
					<td><input type="text" required name="rh8" value="" class='form-control'></td>
					<td><input type="text" required name="rh9" value="" class='form-control'></td>
					<td><input type="text" required name="rh10" value="" class='form-control'></td>
				</tr>

				<!-- R/H/Z 60/30/150 mg  -->
				<tr>
					<td>R/H/Z 60/30/150 mg  </td>
					<td>Tablets</td>
					<td><input type="text" required name="rhz1" value="" class='form-control'></td>
					<td><input type="text" required name="rhz2" value="" class='form-control'></td>
					<td><input type="text" required name="rhz3" value="" class='form-control'></td>
					<td><input type="text" required name="rhz4" value="" class='form-control'></td>
					<td><input type="text" required name="rhz5" value="" class='form-control'></td>
					<td><input type="text" required name="rhz6" value="" class='form-control'></td>
					<td><input type="text" required name="rhz7" value="" class='form-control'></td>
					<td><input type="text" required name="rhz8" value="" class='form-control'></td>
					<td><input type="text" required name="rhz9" value="" class='form-control'></td>
					<td><input type="text" required name="rhz10" value="" class='form-control'></td>
				</tr>

				<!-- R/H 60/30 mg  -->
				<tr>
					<td>R/H 60/30 mg </td>
					<td>Tablets</td>
					<td><input type="text" required name="rh11" value="" class='form-control'></td>
					<td><input type="text" required name="rh12" value="" class='form-control'></td>
					<td><input type="text" required name="rh13" value="" class='form-control'></td>
					<td><input type="text" required name="rh14" value="" class='form-control'></td>
					<td><input type="text" required name="rh15" value="" class='form-control'></td>
					<td><input type="text" required name="rh16" value="" class='form-control'></td>
					<td><input type="text" required name="rh17" value="" class='form-control'></td>
					<td><input type="text" required name="rh18" value="" class='form-control'></td>
					<td><input type="text" required name="rh19" value="" class='form-control'></td>
					<td><input type="text" required name="rh20" value="" class='form-control'></td>
				</tr>

				<!-- 60mg -->
				<tr>
					<td>R/H 60/60 mg </td>
					<td>Tablets</td>
					<td><input type="text" required name="rh21" value="" class='form-control'></td>
					<td><input type="text" required name="rh22" value="" class='form-control'></td>
					<td><input type="text" required name="rh23" value="" class='form-control'></td>
					<td><input type="text" required name="rh24" value="" class='form-control'></td>
					<td><input type="text" required name="rh25" value="" class='form-control'></td>
					<td><input type="text" required name="rh26" value="" class='form-control'></td>
					<td><input type="text" required name="rh27" value="" class='form-control'></td>
					<td><input type="text" required name="rh28" value="" class='form-control'></td>
					<td><input type="text" required name="rh29" value="" class='form-control'></td>
					<td><input type="text" required name="rh30" value="" class='form-control'></td>
				</tr>

				<!-- Ethambutol 400 mg  -->
				<tr>
					<td>Ethambutol 400 mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="f1" value="" class='form-control'></td>
					<td><input type="text" required name="f2" value="" class='form-control'></td>
					<td><input type="text" required name="f3" value="" class='form-control'></td>
					<td><input type="text" required name="f4" value="" class='form-control'></td>
					<td><input type="text" required name="f5" value="" class='form-control'></td>
					<td><input type="text" required name="f6" value="" class='form-control'></td>
					<td><input type="text" required name="f7" value="" class='form-control'></td>
					<td><input type="text" required name="f8" value="" class='form-control'></td>
					<td><input type="text" required name="f9" value="" class='form-control'></td>
					<td><input type="text" required name="f10" value="" class='form-control'></td>
				</tr>

				<!-- H, 300 mg -->
				<tr>
					<td>H, 300 mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="g1" value="" class='form-control'></td>
					<td><input type="text" required name="g2" value="" class='form-control'></td>
					<td><input type="text" required name="g3" value="" class='form-control'></td>
					<td><input type="text" required name="g4" value="" class='form-control'></td>
					<td><input type="text" required name="g5" value="" class='form-control'></td>
					<td><input type="text" required name="g6" value="" class='form-control'></td>
					<td><input type="text" required name="g7" value="" class='form-control'></td>
					<td><input type="text" required name="g8" value="" class='form-control'></td>
					<td><input type="text" required name="g9" value="" class='form-control'></td>
					<td><input type="text" required name="g10" value="" class='form-control'></td>
				</tr>

				<!-- H,100mg -->
				<tr>
					<td>H, 100 mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="h1" value="" class='form-control'></td>
					<td><input type="text" required name="h2" value="" class='form-control'></td>
					<td><input type="text" required name="h3" value="" class='form-control'></td>
					<td><input type="text" required name="h4" value="" class='form-control'></td>
					<td><input type="text" required name="h5" value="" class='form-control'></td>
					<td><input type="text" required name="h6" value="" class='form-control'></td>
					<td><input type="text" required name="h7" value="" class='form-control'></td>
					<td><input type="text" required name="h8" value="" class='form-control'></td>
					<td><input type="text" required name="h9" value="" class='form-control'></td>
					<td><input type="text" required name="h10" value="" class='form-control'></td>
				</tr>

				<!-- Rifabutin 150mg  -->
				<tr>
					<td>Rifabutin 150mg </td>
					<td>Tablets</td>
					<td><input type="text" required name="i1" value="" class='form-control'></td>
					<td><input type="text" required name="i2" value="" class='form-control'></td>
					<td><input type="text" required name="i3" value="" class='form-control'></td>
					<td><input type="text" required name="i4" value="" class='form-control'></td>
					<td><input type="text" required name="i5" value="" class='form-control'></td>
					<td><input type="text" required name="i6" value="" class='form-control'></td>
					<td><input type="text" required name="i7" value="" class='form-control'></td>
					<td><input type="text" required name="i8" value="" class='form-control'></td>
					<td><input type="text" required name="i9" value="" class='form-control'></td>
					<td><input type="text" required name="i10" value="" class='form-control'></td>
				</tr>

				<!-- Pyrazinamide 500mg -->
				<tr>
					<td>Pyrazinamide 500mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="j1" value="" class='form-control'></td>
					<td><input type="text" required name="j2" value="" class='form-control'></td>
					<td><input type="text" required name="j3" value="" class='form-control'></td>
					<td><input type="text" required name="j4" value="" class='form-control'></td>
					<td><input type="text" required name="j5" value="" class='form-control'></td>
					<td><input type="text" required name="j6" value="" class='form-control'></td>
					<td><input type="text" required name="j7" value="" class='form-control'></td>
					<td><input type="text" required name="j8" value="" class='form-control'></td>
					<td><input type="text" required name="j9" value="" class='form-control'></td>
					<td><input type="text" required name="j10" value="" class='form-control'></td>
				</tr>

				<!-- Rifampicin 600mg -->
				<tr>
					<td>Rifampicin 600mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="k1" value="" class='form-control'></td>
					<td><input type="text" required name="k2" value="" class='form-control'></td>
					<td><input type="text" required name="k3" value="" class='form-control'></td>
					<td><input type="text" required name="k4" value="" class='form-control'></td>
					<td><input type="text" required name="k5" value="" class='form-control'></td>
					<td><input type="text" required name="k6" value="" class='form-control'></td>
					<td><input type="text" required name="k7" value="" class='form-control'></td>
					<td><input type="text" required name="k8" value="" class='form-control'></td>
					<td><input type="text" required name="k9" value="" class='form-control'></td>
					<td><input type="text" required name="k10" value="" class='form-control'></td>
				</tr>

				<!-- Pyridoxine 50mg -->
				<tr>
					<td>Pyridoxine 50mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="l1" value="" class='form-control'></td>
					<td><input type="text" required name="l2" value="" class='form-control'></td>
					<td><input type="text" required name="l3" value="" class='form-control'></td>
					<td><input type="text" required name="l4" value="" class='form-control'></td>
					<td><input type="text" required name="l5" value="" class='form-control'></td>
					<td><input type="text" required name="l6" value="" class='form-control'></td>
					<td><input type="text" required name="l7" value="" class='form-control'></td>
					<td><input type="text" required name="l8" value="" class='form-control'></td>
					<td><input type="text" required name="l9" value="" class='form-control'></td>
					<td><input type="text" required name="l10" value="" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole 960 Mg -->
				<tr>
					<td>Co-trimoxazole 960 Mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="m1" value="" class='form-control'></td>
					<td><input type="text" required name="m2" value="" class='form-control'></td>
					<td><input type="text" required name="m3" value="" class='form-control'></td>
					<td><input type="text" required name="m4" value="" class='form-control'></td>
					<td><input type="text" required name="m5" value="" class='form-control'></td>
					<td><input type="text" required name="m6" value="" class='form-control'></td>
					<td><input type="text" required name="m7" value="" class='form-control'></td>
					<td><input type="text" required name="m8" value="" class='form-control'></td>
					<td><input type="text" required name="m9" value="" class='form-control'></td>
					<td><input type="text" required name="m10" value="" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole, 480  mg -->
				<tr>
					<td>Co-trimoxazole, 480  mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="n1" value="" class='form-control'></td>
					<td><input type="text" required name="n2" value="" class='form-control'></td>
					<td><input type="text" required name="n3" value="" class='form-control'></td>
					<td><input type="text" required name="n4" value="" class='form-control'></td>
					<td><input type="text" required name="n5" value="" class='form-control'></td>
					<td><input type="text" required name="n6" value="" class='form-control'></td>
					<td><input type="text" required name="n7" value="" class='form-control'></td>
					<td><input type="text" required name="n8" value="" class='form-control'></td>
					<td><input type="text" required name="n9" value="" class='form-control'></td>
					<td><input type="text" required name="n10" value="" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole suspension, 240 mg/5ml -->
				<tr>
					<td>Co-trimoxazole suspension, 240 mg/5ml</td>
					<td>Bottles</td>
					<td><input type="text" required name="o1" value="" class='form-control'></td>
					<td><input type="text" required name="o2" value="" class='form-control'></td>
					<td><input type="text" required name="o3" value="" class='form-control'></td>
					<td><input type="text" required name="o4" value="" class='form-control'></td>
					<td><input type="text" required name="o5" value="" class='form-control'></td>
					<td><input type="text" required name="o6" value="" class='form-control'></td>
					<td><input type="text" required name="o7" value="" class='form-control'></td>
					<td><input type="text" required name="o8" value="" class='form-control'></td>
					<td><input type="text" required name="o9" value="" class='form-control'></td>
					<td><input type="text" required name="o10" value="" class='form-control'></td>
				</tr>  

				<!-- Dapsone 100mg -->
				<tr>
					<td>Dapsone 100mg</td>
					<td>Tablets</td>
					<td><input type="text" required name="p1" value="" class='form-control'></td>
					<td><input type="text" required name="p2" value="" class='form-control'></td>
					<td><input type="text" required name="p3" value="" class='form-control'></td>
					<td><input type="text" required name="p4" value="" class='form-control'></td>
					<td><input type="text" required name="p5" value="" class='form-control'></td>
					<td><input type="text" required name="p6" value="" class='form-control'></td>
					<td><input type="text" required name="p7" value="" class='form-control'></td>
					<td><input type="text" required name="p8" value="" class='form-control'></td>
					<td><input type="text" required name="p9" value="" class='form-control'></td>
					<td><input type="text" required name="p10" value="" class='form-control'></td>
				</tr> 

				
				<tr><td colspan="12" class=""><div class = "alert alert-info">Leprosy Drugs</div></td></tr>
				<!-- MB Adult Blister  -->
				<tr>
					<td>MB Adult Blister </td>
					<td>Packs</td>
					<td><input type="text" required name="q1" value="" class='form-control'></td>
					<td><input type="text" required name="q2" value="" class='form-control'></td>
					<td><input type="text" required name="q3" value="" class='form-control'></td>
					<td><input type="text" required name="q4" value="" class='form-control'></td>
					<td><input type="text" required name="q5" value="" class='form-control'></td>
					<td><input type="text" required name="q6" value="" class='form-control'></td>
					<td><input type="text" required name="q7" value="" class='form-control'></td>
					<td><input type="text" required name="q8" value="" class='form-control'></td>
					<td><input type="text" required name="q9" value="" class='form-control'></td>
					<td><input type="text" required name="q10" value="" class='form-control'></td>
				</tr>

				<!-- MB Child Blister Packs -->
				<tr>
					<td>MB Child Blister Packs</td>
					<td>Packs</td>
					<td><input type="text" required name="r1" value="" class='form-control'></td>
					<td><input type="text" required name="r2" value="" class='form-control'></td>
					<td><input type="text" required name="r3" value="" class='form-control'></td>
					<td><input type="text" required name="r4" value="" class='form-control'></td>
					<td><input type="text" required name="r5" value="" class='form-control'></td>
					<td><input type="text" required name="r6" value="" class='form-control'></td>
					<td><input type="text" required name="r7" value="" class='form-control'></td>
					<td><input type="text" required name="r8" value="" class='form-control'></td>
					<td><input type="text" required name="r9" value="" class='form-control'></td>
					<td><input type="text" required name="r10" value="" class='form-control'></td>
				</tr>

				<!-- PB Adult Blister Packs -->
				<tr>
					<td>PB Adult Blister Packs</td>
					<td>Packs</td>
					<td><input type="text" required name="s1" value="" class='form-control'></td>
					<td><input type="text" required name="s2" value="" class='form-control'></td>
					<td><input type="text" required name="s3" value="" class='form-control'></td>
					<td><input type="text" required name="s4" value="" class='form-control'></td>
					<td><input type="text" required name="s5" value="" class='form-control'></td>
					<td><input type="text" required name="s6" value="" class='form-control'></td>
					<td><input type="text" required name="s7" value="" class='form-control'></td>
					<td><input type="text" required name="s8" value="" class='form-control'></td>
					<td><input type="text" required name="s9" value="" class='form-control'></td>
					<td><input type="text" required name="s10" value="" class='form-control'></td>
				</tr>

				<!-- PB Child Blister Packs -->
				<tr>
					<td>PB Child Blister Packs</td>
					<td>Packs</td>
					<td><input type="text" required name="t1" value="" class='form-control'></td>
					<td><input type="text" required name="t2" value="" class='form-control'></td>
					<td><input type="text" required name="t3" value="" class='form-control'></td>
					<td><input type="text" required name="t4" value="" class='form-control'></td>
					<td><input type="text" required name="t5" value="" class='form-control'></td>
					<td><input type="text" required name="t6" value="" class='form-control'></td>
					<td><input type="text" required name="t7" value="" class='form-control'></td>
					<td><input type="text" required name="t8" value="" class='form-control'></td>
					<td><input type="text" required name="t9" value="" class='form-control'></td>
					<td><input type="text" required name="t10" value="" class='form-control'></td>
				</tr>

				<tr><td colspan="12" class=""><div class = "alert alert-info">MDR TB drugs</div></td></tr>

				<!-- Capreomycin 1gm vial -->
				<tr>
					<td>Capreomycin 1gm vial</td>
					<td>Vial</td>
					<td><input type="text" required name="u1" value="" class='form-control'></td>
					<td><input type="text" required name="u2" value="" class='form-control'></td>
					<td><input type="text" required name="u3" value="" class='form-control'></td>
					<td><input type="text" required name="u4" value="" class='form-control'></td>
					<td><input type="text" required name="u5" value="" class='form-control'></td>
					<td><input type="text" required name="u6" value="" class='form-control'></td>
					<td><input type="text" required name="u7" value="" class='form-control'></td>
					<td><input type="text" required name="u8" value="" class='form-control'></td>
					<td><input type="text" required name="u9" value="" class='form-control'></td>
					<td><input type="text" required name="u10" value="" class='form-control'></td>
				</tr>

				<!-- Cycloserine 250mg  -->
				<tr>
					<td>Cycloserine 250mg </td>
					<td>Tablet</td>
					<td><input type="text" required name="v1" value="" class='form-control'></td>
					<td><input type="text" required name="v2" value="" class='form-control'></td>
					<td><input type="text" required name="v3" value="" class='form-control'></td>
					<td><input type="text" required name="v4" value="" class='form-control'></td>
					<td><input type="text" required name="v5" value="" class='form-control'></td>
					<td><input type="text" required name="v6" value="" class='form-control'></td>
					<td><input type="text" required name="v7" value="" class='form-control'></td>
					<td><input type="text" required name="v8" value="" class='form-control'></td>
					<td><input type="text" required name="v9" value="" class='form-control'></td>
					<td><input type="text" required name="v10" value="" class='form-control'></td>
				</tr>

				<!-- Kanamycin 1gm vial  -->
				<tr>
					<td>Kanamycin 1gm vial </td>
					<td>Vial</td>
					<td><input type="text" required name="w1" value="" class='form-control'></td>
					<td><input type="text" required name="w2" value="" class='form-control'></td>
					<td><input type="text" required name="w3" value="" class='form-control'></td>
					<td><input type="text" required name="w4" value="" class='form-control'></td>
					<td><input type="text" required name="w5" value="" class='form-control'></td>
					<td><input type="text" required name="w6" value="" class='form-control'></td>
					<td><input type="text" required name="w7" value="" class='form-control'></td>
					<td><input type="text" required name="w8" value="" class='form-control'></td>
					<td><input type="text" required name="w9" value="" class='form-control'></td>
					<td><input type="text" required name="w10" value="" class='form-control'></td>
				</tr>

				<!-- Levofloxacin 250mg   -->
				<tr>
					<td>Levofloxacin 250mg  </td>
					<td>Tablets</td>
					<td><input type="text" required name="x1" value="" class='form-control'></td>
					<td><input type="text" required name="x2" value="" class='form-control'></td>
					<td><input type="text" required name="x3" value="" class='form-control'></td>
					<td><input type="text" required name="x4" value="" class='form-control'></td>
					<td><input type="text" required name="x5" value="" class='form-control'></td>
					<td><input type="text" required name="x6" value="" class='form-control'></td>
					<td><input type="text" required name="x7" value="" class='form-control'></td>
					<td><input type="text" required name="x8" value="" class='form-control'></td>
					<td><input type="text" required name="x9" value="" class='form-control'></td>
					<td><input type="text" required name="x10" value="" class='form-control'></td>
				</tr>

				<!-- Levofloxacin 500mg   -->
				<tr>
					<td>Levofloxacin 500mg  </td>
					<td>Tablets</td>
					<td><input type="text" required name="y1" value="" class='form-control'></td>
					<td><input type="text" required name="y2" value="" class='form-control'></td>
					<td><input type="text" required name="y3" value="" class='form-control'></td>
					<td><input type="text" required name="y4" value="" class='form-control'></td>
					<td><input type="text" required name="y5" value="" class='form-control'></td>
					<td><input type="text" required name="y6" value="" class='form-control'></td>
					<td><input type="text" required name="y7" value="" class='form-control'></td>
					<td><input type="text" required name="y8" value="" class='form-control'></td>
					<td><input type="text" required name="y9" value="" class='form-control'></td>
					<td><input type="text" required name="y10" value="" class='form-control'></td>
				</tr>

				<!-- Para-aminosalicylic acid 4mg    -->
				<tr>
					<td>Para-aminosalicylic acid 4mg   </td>
					<td>Satchets</td>
					<td><input type="text" required name="z1" value="" class='form-control'></td>
					<td><input type="text" required name="z2" value="" class='form-control'></td>
					<td><input type="text" required name="z3" value="" class='form-control'></td>
					<td><input type="text" required name="z4" value="" class='form-control'></td>
					<td><input type="text" required name="z5" value="" class='form-control'></td>
					<td><input type="text" required name="z6" value="" class='form-control'></td>
					<td><input type="text" required name="z7" value="" class='form-control'></td>
					<td><input type="text" required name="z8" value="" class='form-control'></td>
					<td><input type="text" required name="z9" value="" class='form-control'></td>
					<td><input type="text" required name="z10" value="" class='form-control'></td>
				</tr>

				<!-- Prothionamide 250mg    -->
				<tr>
					<td>Prothionamide 250mg   </td>
					<td>Tablets</td>
					<td><input type="text" required name="ab1" value="" class='form-control'></td>
					<td><input type="text" required name="ab2" value="" class='form-control'></td>
					<td><input type="text" required name="ab3" value="" class='form-control'></td>
					<td><input type="text" required name="ab4" value="" class='form-control'></td>
					<td><input type="text" required name="ab5" value="" class='form-control'></td>
					<td><input type="text" required name="ab6" value="" class='form-control'></td>
					<td><input type="text" required name="ab7" value="" class='form-control'></td>
					<td><input type="text" required name="ab8" value="" class='form-control'></td>
					<td><input type="text" required name="ab9" value="" class='form-control'></td>
					<td><input type="text" required name="ab10" value="" class='form-control'></td>
				</tr>
			</table>
		</tr>

		<tr>
		<td>
		<table class="table table-bordered ">
		<tr>
			<th>Collection or Reporting tool</th>
			<th colspan="2">DAR</th>
			<th>CDRR</th>
		</tr>
		<tr>
			<th>Reporting Tool</th>
			<th>50 page</th>
			<th>100 page</th>
			<th>FCDRR</th>
		</tr>
		<tr>
			<th>Quantity Requested</th>
			<td><input type="text" required name="50pg" value="" class='form-control'></td>
			<td><input type="text" required name="100pg" value="" class='form-control'></td>
			<td><input type="text" required name="FCDRR" value="" class='form-control'></td>
		</tr>
			</table>
			</td>
		</tr>
<!-- patient summary table -->
		<tr>
				<table class="table table-bordered">
				<th colspan="8" class="">Patient Summaries: </th>
					<tr>
						<th></th>
						<th>New</th>
						<th>Retreatment</th>
						<th>Leprosy</th>
						<th>MDR</th>
						<th>IPT</th>
						<th>Rifabetia</th>
						<th>CPT</th>
					</tr>
					<tr>
						<th>Adult</th>
						<td><input type="text" required name="summary_adult_new" value="" class='form-control'></td>
						<td><input type="text" required name="summary_adult_retreatment" value="" class='form-control'></td>
						<td><input type="text" required name="summary_adult_leprosy" value="" class='form-control'></td>
						<td><input type="text" required name="summary_adult_mdr" value="" class='form-control'></td>
						<td><input type="text" required name="summary_adult_ipt" value="" class='form-control'></td>
						<td><input type="text" required name="summary_adult_rifabetia" value="" class='form-control'></td>
						<td><input type="text" required name="summary_adult_cpt" value="" class='form-control'></td>
					</tr>

					<tr>
						<th>Children</th>
						<td><input type="text" required name="summary_children_new" value="" class='form-control'></td>
						<td><input type="text" required name="summary_children_retreatment" value="" class='form-control'></td>
						<td><input type="text" required name="summary_children_leprosy" value="" class='form-control'></td>
						<td><input type="text" required name="summary_children_mdr" value="" class='form-control'></td>
						<td><input type="text" required name="summary_children_ipt" value="" class='form-control'></td>
						<td><input type="text" required name="summary_children_rifabetia" value="" class='form-control'></td>
						<td><input type="text" required name="summary_children_cpt" value="" class='form-control'></td>
					</tr>
				</table>
		</tr>

		<tr>
			<table class="table table-bordered">
			<th colspan="8" class="accordion">Supply Box Commodities</th>
				<tr>
					<th>Commodity</th>
					<th>Beginning Balance</th>
					<th>Amount into Supply Box</th>
					<th>Amount out of Supply Box</th>
					<th>Amount Withdrawn to District Store</th>
					<th>Ending Balance</th>
				</tr>
				<tr>
					<th>A</th>
					<th>B</th>
					<th>C</th>
					<th>D</th>
					<th>E</th>
					<th>F</th>
				</tr>
				<tr>
					<th>RHZE Tablets</th>
					<td><input type="text" required name="rhzeB" value="" class='form-control'></td>
					<td><input type="text" required name="rhzeC" value="" class='form-control'></td>
					<td><input type="text" required name="rhzeD" value="" class='form-control'></td>
					<td><input type="text" required name="rhzeE" value="" class='form-control'></td>
					<td><input type="text" required name="rhzeF" value="" class='form-control'></td>
				</tr>
				<tr>
					<th>RH Tablets</th>
					<td><input type="text" required name="rhB" value="" class='form-control'></td>
					<td><input type="text" required name="rhC" value="" class='form-control'></td>
					<td><input type="text" required name="rhD" value="" class='form-control'></td>
					<td><input type="text" required name="rhE" value="" class='form-control'></td>
					<td><input type="text" required name="rhF" value="" class='form-control'></td>
				</tr>
			</table>
		</tr>

	</tbody>
</table>
</form>
</div>
<div class="container-fluid">
<div style="float: right">
<button class="save btn btn-sm btn-success"><span class="glyphicon glyphicon-open"></span>Save</button></div>
</div>
</div>
<script>

      $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
  

  $(window).resize(function() {
    if (($(window).width() < 768))
    {
        $( ".col-md-2,.col-md-10" ).css( "position", "" );
    };
});
 	$('#dataTables_filter label input').addClass('form-control');
	$('#dataTables_length label select').addClass('form-control');
$('#exp_datatable,#potential_exp_datatable,#potential_exp_datatable2').dataTable( {
     "sDom": "T lfrtip",
  
       "sScrollY": "377px",
       
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
            "oTableTools": {
                 "aButtons": [
        "copy",
        "print",
        {
         "sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
    }
  } ); 
    

});
    </script>