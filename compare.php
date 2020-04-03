<?php
	session_start();
	include 'header.php';
	
	if(!isset($_SESSION['array'])){
		header('location: index.php');
	}
	// sql connection 
	spl_autoload_register(function ($classes) {
		require_once('admin/class/' . $classes . '.php');
	});
	
	$admin = new Admin;
	
?>
<style>
	button.btnOur {
    background: #2d3a4b;
    border: none;
    color: white;
    padding: 0.8rem 1.5rem;
	}
	
	.btnOurFoot {
    height: 3rem;
    background: #2d3a4b;
    border: none;
    color: white!important;
    font-size: 1.3rem;
    padding: 0.6rem 1rem;
    cursor: pointer;
	}
</style>

<?php
	
	include 'menu_compare.php';
?>
<?php
	
	
	if (isset($_SESSION['array'])) {
		
		$array = $_SESSION['array'];
		
		
		if ($array == null) {
			session_unset();
			session_destroy();
			} else {
			$_SESSION['array'] = $array;
		}
		$data = "";
		for ($x = 0; $x < count($array); $x++) {
			
			if ($x == count($array) - 1) {
				$data .= $array[$x];
				} else {
				$data .= $array[$x] . ',';
			}
		}
		
		
		
		// for sum
		if (isset($_SESSION['array'])) { 
			$quary_one = "select sum(m_one) from post where post_id in ($data)";
			$sumMarket1 = $admin->readmore($quary_one);
			$M_one =  mysqli_fetch_assoc($sumMarket1);
			
			$quary_sum_two = "select sum(m_tow) from post where post_id in ($data)";
			$sum_market2 = $admin->readmore($quary_sum_two);
			$M_two =  mysqli_fetch_assoc($sum_market2);
			
			$quary_sum_three = "select sum(m_three) from post where post_id in ($data)";
			$sum_market3 = $admin->readmore($quary_sum_three);
			$M_three =  mysqli_fetch_assoc($sum_market3);
			
			// for sum end 
			
			
			$query = "select * from post where post_id in ($data)";
			$output = $admin->readmore($query);
		}
	?>
	
	
	<!-- Popular Products -->
	<section class="light-gray-bg padding-top-150 padding-bottom-150">
		<div class="container">
			
			<!-- Main Heading -->
			<div class="heading text-center">
				<h4>YOUR SELECTED PRODUCT </h4>
				
				<!-- Popular Item Slide -->
				<div class="papular-block block-slide" id="selectpost">
					
					<?php
						if (isset($_SESSION['array'])) { 
							while ($op = mysqli_fetch_assoc($output)) {
							?>
							
							<!-- Item -->
							<div class="item item-post">
								<!-- Item img -->
								<div class="item-img"> <img class="img-1" src="<?php echo 'upload/' . $op['post_img']; ?>" alt=""> <img class="img-2" src="<?php echo 'upload/' . $op['post_img']; ?>" alt="">
									<!-- Overlay -->
									<div class="overlay">
										<div class="position-center-center">
											<div class="inn"><a href="<?php echo 'upload/' . $op['post_img']; ?>" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> </div>
										</div>
									</div>
								</div>
								<!-- Item Name -->
								<div class="item-name"> <a href="#"><?php echo $op['post_title']; ?></a>
								</div>
							</div>
							
						<?php }} ?>
						
				</div>
			</section>
			
			
			<section id="table">
				
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-6">
							<div class=" my-4 mx-0 px-0" style="padding:0px;margin: 0px;">
								<div class="row">
									<div class="col-lg-12">
										<div class="table-responsve">
											<table id="market_one" class="table table-striped table-hover table-bordered">
												<thead class="thead-inverse">
													<tr>
														<td class="text-center" style="background:#ddd" colspan="4">
															<b>Market 1</b>
														</td>
													</tr>
													<tr>
														<th class="">IMAGES</th>
														<th class="">TITLE</th>
														<th class="">PRICE</th>
														<th class="">ACTION</th>
													</tr>
												</thead>
												<tbody>
													<?php
														if (isset($_SESSION['array'])) { 
															$query = "select * from post where post_id in ($data)";
															$output = $admin->readmore($query);
															
															while ($op = mysqli_fetch_assoc($output)) {
															?>                   
															<tr class="text-center">
																<td class="option">
																	<img class="img-fluid" style="height:50px;width:50px;object-fit: cover;
																	object-position:center" src="upload/<?php echo $op['post_img']; ?>" alt="img" />
																</td>
																<td class="align-middle"><?php echo $op['post_title']; ?></td>
																<td class="align-middle" value="<?php echo $op['m_one'];?>" ><?php echo $op['m_one'];?></td>
																<td><button class="btnOur align-middle">X</button></td>
															</tr>
														<?php } } ?>
														
														<tr>
															<th colspan="2" class="text-right">Total Price</th> 
															<th colspan="2"> <?php if (isset($_SESSION['array'])) { echo $M_one['sum(m_one)']; }else{echo '0';}?> </th>
														</tr>
												</tbody>
												<tfoot class="thead-inverse">
													<tr>
														<th colspan="4" class="text-center">
															<a class="btnOurFoot mr-5" data-toggle="collapse" href="#market1" role="button" aria-expanded="false" aria-controls="collapseExample">
																Location
															</a>
															<a class="btnOurFoot ml-3" id="mapLink1" target="_blank"></a>
														</th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="col-lg-4 col-md-6 ">
							<div class=" my-4 mx-0 px-0 " style="padding:0px;">
								<div class="row">
									<div class="col-lg-12">
										<div class="table-responsve">
											<table id="market_two" class="table table-striped table-hover table-bordered">
												<thead class="thead-inverse">
													<tr>
														<td class="text-center" style="background:#ddd" colspan="4">
															<b>Market 2</b>
														</td>
													</tr>
													<tr>
														<th class="">IMAGES</th>
														<th class="">TITLE</th>
														<th class="">PRICE</th>
														<th class="">ACTION</th>
													</tr>
												</thead>
												<tbody>
													
													<?php
														if (isset($_SESSION['array'])) { 
															
															$query = "select * from post where post_id in ($data)";
															$output = $admin->readmore($query);
															
															while ($op = mysqli_fetch_assoc($output)) {
															?>                   
															<tr class="text-center">
																<td class="option">
																	<img class="img-fluid" style="height:50px;width:50px;object-fit: cover;
																	object-position:center" src="upload/<?php echo $op['post_img']; ?>" alt="img" />
																</td>
																<td class="align-middle"><?php echo $op['post_title']; ?></td>
																<td class="align-middle" value="<?php  echo $op['m_tow'];?>"><?php echo $op['m_tow'];?></td>
																<td><button class="btnOur align-middle">X</button></td>
															</tr>
														<?php } } ?>
														
														
														<tr>
															<th colspan="2" class="text-right">Total Price</th> 
															<th colspan="2"> <?php if (isset($_SESSION['array'])) { echo $M_two['sum(m_tow)']; }else{echo '0';}  ?> </th>
														</tr>
												</tbody>
												<tfoot class="thead-inverse">
													<tr>
														<th colspan="4" class="text-center">
															<a class="btnOurFoot mr-5" data-toggle="collapse" href="#market2" role="button" aria-expanded="false" aria-controls="collapseExample">
																Location
															</a>
															<a class="btnOurFoot ml-3" id="mapLink2" target="_blank"></a>
															
														</th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-6">
							<div class=" my-4 mx-0 px-0" style="padding:0px;">
								<div class="row">
									<div class="col-lg-12">
										<div class="table-responsve">
											<table id="market_three" class="table table-striped table-hover table-bordered ">
												<thead class="thead-inverse">
													<tr>
														<td class="text-center" style="background:#ddd" colspan="4">
															<b>Market 3</b>
														</td>
													</tr>
													<tr>
														<th class="">IMAGES</th>
														<th class="">TITLE</th>
														<th class="">PRICE</th>
														<th class="">ACTION</th>
													</tr>
												</thead>
												<tbody>
													<?php
														if (isset($_SESSION['array'])) { 
															$query = "select * from post where post_id in ($data)";
															$output = $admin->readmore($query);
															
															while ($op = mysqli_fetch_assoc($output)) {
															?>                   
															<tr class="text-center">
																<td class="option">
																	<img class="img-fluid" style="height:50px;width:50px;object-fit: cover;
																	object-position:center" src="upload/<?php echo $op['post_img']; ?>" alt="img" />
																</td>
																<td class="align-middle"><?php echo $op['post_title']; ?></td>
																<td class="align-middle" value="<?php echo $op['m_three']?>"><?php echo $op['m_three']?></td>
																<td><button class="btnOur align-middle">X</button></td>
															</tr>
														<?php }} ?>
														<tr>
															<th colspan="2" class="text-right">Total Price</th> 
															<th colspan="2"> <?php if (isset($_SESSION['array'])) { echo $M_three['sum(m_three)']; }else{echo '0';} ?> </th>
														</tr>
												</tbody>
												<tfoot class="thead-inverse">
													<tr>
														<th colspan="4" class="text-center">
															<a class="btnOurFoot mr-5" data-toggle="collapse" href="#market3" role="button" aria-expanded="false" aria-controls="collapseExample">
																Location
															</a>
															<a class="btnOurFoot ml-3" id="mapLink3" target="_blank"></a>
														</th>
													</tr>
												</tfoot>
											</table>
											<p id = "status"></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						
						<!--MAP JAVASCRIPT CODE HERE -->
						
						<script>
							
							window.onload = function(){
								
								function geoFindMe3() {
									
									const status = document.querySelector('#status');
									const mapLink = document.querySelector('#mapLink3');
									
									mapLink.href = '';
									mapLink.textContent = '';
									
									function success(position) {
										const latitude  = position.coords.latitude;
										const longitude = position.coords.longitude;
										
										status.textContent = '';
										mapLink.href = `https://www.google.com/maps/dir/Rajshahi/${latitude},${longitude}/@24.376554,88.603269`
										mapLink.textContent = "Check Distance"
									}
									
									function error() {
										status.textContent = 'Unable to retrieve your location';
									}
									
									if (!navigator.geolocation) {
										status.textContent = 'Geolocation is not supported by your browser';
										} else {
										status.textContent = 'Locating…';
										navigator.geolocation.getCurrentPosition(success, error);
									}
									
								}
								
								geoFindMe3()
								
								// GEO_DIND_ME_2
								
								function geoFindMe2() {
									
									const status = document.querySelector('#status');
									const mapLink = document.querySelector('#mapLink2');
									
									mapLink.href = '';
									mapLink.textContent = '';
									
									function success(position) {
										const latitude  = position.coords.latitude;
										const longitude = position.coords.longitude;
										
										status.textContent = '';
										mapLink.href = `https://www.google.com/maps/dir/Rajshahi/${latitude},${longitude}/@24.376554,88.603269`
										mapLink.textContent = "Check Distance"
									}
									
									function error() {
										status.textContent = 'Unable to retrieve your location';
									}
									
									if (!navigator.geolocation) {
										status.textContent = 'Geolocation is not supported by your browser';
										} else {
										status.textContent = 'Locating…';
										navigator.geolocation.getCurrentPosition(success, error);
									}
									
								}
								
								geoFindMe2()
								
								// GEO_DIND_ME_1
								function geoFindMe1() {
									
									const status = document.querySelector('#status');
									const mapLink = document.querySelector('#mapLink1');
									
									mapLink.href = '';
									mapLink.textContent = '';
									
									function success(position) {
										const latitude  = position.coords.latitude;
										const longitude = position.coords.longitude;
										
										status.textContent = '';
										mapLink.href = `https://www.google.com/maps/dir/Rajshahi/${latitude},${longitude}/@24.376554,88.603269`
										mapLink.textContent = "Check Distance"
									}
									
									function error() {
										status.textContent = 'Unable to retrieve your location';
									}
									
									if (!navigator.geolocation) {
										status.textContent = 'Geolocation is not supported by your browser';
										} else {
										status.textContent = 'Locating…';
										navigator.geolocation.getCurrentPosition(success, error);
									}
									
								}
								
								geoFindMe1()
							}
							
							
						</script>
						
						
						<div class="container">
							<div class="row">
								<div class="col-md-4 col-sm-12">
									<div class="collapse" id="market1">
										<div class="card card-body">
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58144.53047174095!2d88.57099650315703!3d24.38015002626135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbefa96a38d031%3A0x10f93a950ed6f410!2sRajshahi!5e0!3m2!1sen!2sbd!4v1585728622250!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
										</div>
									</div>	
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="collapse" id="market2">
										<div class="card card-body">
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58144.53047174095!2d88.57099650315703!3d24.38015002626135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbefa96a38d031%3A0x10f93a950ed6f410!2sRajshahi!5e0!3m2!1sen!2sbd!4v1585728622250!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="collapse" id="market3">
										<div class="card card-body">
											<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58144.53047174095!2d88.57099650315703!3d24.38015002626135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbefa96a38d031%3A0x10f93a950ed6f410!2sRajshahi!5e0!3m2!1sen!2sbd!4v1585728622250!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			
			
		<?php } ?>
		
		
		<?php
			include 'footer.php';
			
		?>																		