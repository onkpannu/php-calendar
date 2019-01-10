<?php
// Simple PHP script to display calendar
// By : Onkar Singh 
// Date created : Jan 10 2019


$show_week_names="";
$the_year ="2019";

echo "<table width=105>";	
	for($the_month=1;$the_month<=12;$the_month++) {
		echo "<tr>";
			echo "<td colspan=7 >";
				$the_date= date("Y-m-d",strtotime("$the_year-$the_month-01"));
				showCalendarByMonthType1($the_date);
			echo "</td>";
		echo "</tr>";
	}
echo "</table>";


function showCalendarByMonthType1($the_date){	 //Show calendar by month 
	// Get the date data and details 
		global $show_week_names;
		$current_full_date = date("Y-m-d",strtotime($the_date));
		$current_day =  date("d",strtotime($current_full_date));
		$current_year =  date("Y",strtotime($current_full_date));
		$current_month =  date("m",strtotime($current_full_date));
		$current_month_name =  date("F",strtotime($current_full_date));
		$current_week_day = date('w', strtotime($current_full_date));
		$current_week_day_name = date('l', strtotime($current_full_date));
		$current_month_total_days = date('t', strtotime($current_full_date));
		$current_month_start_week_day = date('w', strtotime("$current_year-$current_month-1"));
		
		$display_date_number=1;
		$x=0;
		echo"<table width=100%  >";
			if($show_week_names==""){
				echo "<td><table>";
				echo "<tr>";
					echo "<td class='week_name'><b>S</b></td>";
					echo "<td class='week_name'><b>M</b></td>";
					echo "<td class='week_name'><b>T</b></td>";
					echo "<td class='week_name'><b>W</b></td>";
					echo "<td class='week_name'><b>T</b></td>";
					echo "<td class='week_name'><b>F</b></td>";				
					echo "<td class='week_name'><b>S</b></td>"; 
				echo "</tr>";
				echo "</td></table>";
				$show_week_names="x";
			}				
					
			echo "<tr>";
				echo "<td class='week_name' style='text-align:center' ><b>$current_month_name</b></td>"; 							
			echo "</tr>";
			echo "<tr>";
				echo "<td >";
				
				do {				
					echo "<table width=100%  >";
					
					echo "<tr>";
						for($i=$x; $display_date_number<=$current_month_total_days;$i++) {
							
							if($i<$current_month_start_week_day) {									
								$date=date_create("$current_year-$current_month-01");
								$ds=($current_month_start_week_day-$i);
								date_sub($date,date_interval_create_from_date_string("$ds days"));
								$t_full_date = date_format($date,"Y-m-d");
								$t_day =  date("d",strtotime($t_full_date));
								$t_month_name =  substr(date("F",strtotime($t_full_date)),0,3);										
								$x++;									
								echo "<td class='out_of_month'></td>";
							
							} else {									
																
								$date=date_create("$current_year-$current_month-$display_date_number");											
								$t_full_date = date_format($date,"Y-m-d");
								$t_day =  date("d",strtotime($t_full_date));
								$t_month_name =  substr(date("F",strtotime($t_full_date)),0,3);
								
								$display_date_number++;
								$x++;
								
								echo "<td class='in_month' >";
									//echo "$t_month_name $t_day";
									echo (int)$t_day;
									showDayDetails("$t_month_name $t_day",$t_full_date);
								echo "</td>";									
							}
							
							if ($display_date_number > $current_month_total_days) {
								$date=date_create("$current_year-$current_month-$current_month_total_days");
								$t_full_date = date_format($date,"Y-m-d");	
								$t_week_day = date('w', strtotime("$t_full_date"));
								
								for($j=$t_week_day;$j<6;$j++) {
									date_sub($date,date_interval_create_from_date_string("$-ds days"));
									$t_full_date = date_format($date,"Y-m-d");
									$t_day =  date("d",strtotime($t_full_date));
									$t_month_name =  substr(date("F",strtotime($t_full_date)),0,3);										
							
									echo "<td class='out_of_month'></td>";
								}									
							}

							if(fmod($x,7)==0) {									
								break;
							}	
						}
						echo "</tr>";
					echo "</table>";
					
				} while ($display_date_number < $current_month_total_days);	

				echo "</td>";				
			echo "</tr>";
		echo "</table>";
		
}

function showDayDetails($t_month_name_day,$t_full_date){
	echo "";
}



?>
<style>
td.out_of_month {
	width: 15px;
	background: #ffffff;
	text-align: center;
	font-family: verdana;
	font-size: 8px;
	
}
td.in_month {
	width: 15px;
	background: #f7f7f7;
	text-align: center;
	font-family:verdana;
	font-size: 8px;
}

td.week_name {
	width: 15px;
	background: #ffffff;
	text-align: center;
	font-family: verdana;
	font-size: 8px;
}


</style>