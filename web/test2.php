<h2 style="bold">The table below shows Your temperature measurement results</h2><br/><br/>
		
		<table border="1" cellpadding="6" style="bold">
			<?php 
						$conn = new mysqli($host,$db_user,$db_password,$db_name);
	
						if($conn->connect_errno != 0)
						{
							echo "Error: ".$conn->connect_errno;
						}
						else
						{
							$u_id = $_SESSION['id'];
							$sqlTemp = "select temp,Mes_date from Measurement where user_id = '$u_id'";
		
		
							if($result = mysqli_query($conn, $sqlTemp))
							{
								if(mysqli_num_rows($result) > 0)
								{
									echo "<table border='1' cellpadding='6'>";
										echo "<tr>";
											echo "<th>Temperature [°C]</th>";
											echo "<th>Date / Hour</th>";
										echo "</tr>";
									while($row = mysqli_fetch_array($result))
									{
										echo "<tr>";
											echo "<td>" . $row['temp'] . "</td>";
											echo "<td>" . $row['Mes_date'] . "</td>";
										echo "</tr>";
									}
									echo "</table>";
									mysqli_free_result($result);
								}
							}
						}

				?>
		</table>