<?php
include 'connect.php';
session_start();
if(!isset($_SESSION['id'])){
	header('location: login_page.php');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./css/bootstrap.min.css" />
		<link rel="stylesheet" href="./css/all.min.css" />
		<link rel="stylesheet" href="./css/style.css" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200;300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<title>Document</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg sticky-top">
			<div class="container">
				<a class="logo me-5" href=""><img src="./img/logo.png" alt="" /></a>
				<button
					class="navbar-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#navbarNavDropdown"
					aria-controls="navbarNavDropdown"
					aria-expanded="false"
					aria-label="Toggle navigation"
				>
					<i class="fa-solid fa-bars text-light fa-xl"></i>
				</button>
				<div
					class="collapse navbar-collapse ms-5 justify-content-between"
					id="navbarNavDropdown"
				>
					<ul class="navbar-nav my-3 w-50 justify-content-between">
						<li class="nav-item">
							<a
								class="nav-link active ttl"
								aria-current="page"
								href="./home.php"
								>Home</a
							>
						</li>
						<li class="nav-item dropdown">
							<a
								class="ttl nav-link dropdown-toggle"
								href="#"
								role="button"
								data-bs-toggle="dropdown"
								aria-expanded="false"
							>
								Collection
							</a>
							<ul class="dropdown-menu">
								<li>
									<a class="dropdown-item" href="./collection.php"
										>All collections</a
									>
								</li>
								<li>
									<a class="dropdown-item" href="./own-col.php"
										>Your collections</a
									>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a
								class="ttl nav-link dropdown-toggle"
								href="#"
								role="button"
								data-bs-toggle="dropdown"
								aria-expanded="false"
							>
								NFTs
							</a>
							<ul class="dropdown-menu">
								<li>
									<a class="dropdown-item" href="./nfts.php">All NFTs</a>
								</li>
								<li>
									<a class="dropdown-item" href="./own-nft.php">Your NFTs</a>
								</li>
							</ul>
						</li>
					</ul>
					<div class="logout">
						<?php
							if(!isset($_SESSION['id'])){
								echo '<a href="login_page.php" style="margin-left:100px;">
						<button class="main-btn">Login</button>
					</a>';
							}else{
								echo '<span><b> Hi '.$_SESSION['name'].'</b></span>
								<img class="prf" src='.$_SESSION['img'].'>
						<a href="logout.php">
						<button class="main-btn">logout</button>
						</a>';
							}
						?>
					</div>
				</div>
			</div>
		</nav>
		

		<section class="collection">
			<div class="container">
				<div class="all container">
					<a class="d-flex align-items-center justify-content-end text-light"  href="./cre_col.php">
						<span class="fs-4"><b>Add collection</b></span>
						<i class="fa-solid fa-circle-plus fa-2x"></i>
					</a>
				</div>
				<div class="collection-cards">
					<!-- <div>
						<div class="col-card d-flex flex-column justify-content-between">
							<div class="profil">
								<img class="me-2" src="./img/nft1.png" alt="" />
								<span>Compelling Claudette</span>
							</div>
							<div class="statics d-flex justify-content-between">
								<div>
									<p>Total price</p>
									<h5>835.6 <span>ETH</span></h5>
								</div>
								<div>
									<p>Average price</p>
									<h5>62 <span>ETH</span></h5>
								</div>
							</div>
							<div class="nfts d-flex justify-content-between">
								<img src="./img/nft5.png" alt="" />
								<img src="./img/nft10.png" alt="" />
								<img src="./img/nft11.png" alt="" />
								<img src="./img/nft12.png" alt="" />
							</div>
						</div>
						<div class="edit mt-3 text-center">
							<button class="btn btn-primary w-25">Edit</button>
							<button class="btn btn-danger w-25">Delete</button>
						</div>
					</div> -->
						<?php
						$sql='SELECT * FROM collections WHERE collections.artist_id = "'.$_SESSION['id'].'"';
          	$result = mysqli_query($con,$sql);

					if($result){
            while($row = mysqli_fetch_assoc($result)){
							$name=$row['name'];
							$artistId=$row['artist_id'];
							$col_id=$row['id'];
							$sql_nft="SELECT * FROM nfts WHERE coll_id ='".$col_id."'";
							$result_nft=mysqli_query($con,$sql_nft);
							$total=0;
							while($row_nft = mysqli_fetch_assoc($result_nft)){
								$total=$total+$row_nft['price'];
							}
							$count_sql='SELECT COUNT(*) AS total FROM nfts WHERE coll_id ="'.$col_id.'"';
							$r=mysqli_query($con,$count_sql);
							$value=mysqli_fetch_assoc($r);
							$count=$value['total'];
							$moyenne=0;
							if($count!=0){
								$moyenne=round($total/$count,2);
							}
							echo '<div><div class="col-card d-flex flex-column justify-content-between">
											<div class="profil">
												<img class="me-2" src='.$_SESSION['img'].' alt="" />
												<span>'.$name.'</span>
											</div>
											<div class="statics d-flex justify-content-between">
												<div>
													<p>Total price</p>
													<h5>'.$total.' ETH</h5>
												</div>
												<div>
													<p>N° NFTs</p>
													<h5>'.$count.'</h5>
												</div>
												<div>
													<p>Average price</p>
													<h5>'.$moyenne.' <span>ETH</span></h5>
												</div>
											</div>
											<div class="nfts d-flex justify-content-between">
											</div>
										</div>
										<div class="edit mt-3 text-center">
										<a class="text-light" href="colupdate.php?updateid='.$col_id.'"><button class="btn btn-danger w-25">Edit</button></a>
										<a class="text-light" href="coldelete.php?deleteid='.$col_id.'"><button class="btn btn-danger w-25">Delete</button></a>
									</div>
									</div>';
						}
					};
					?>
					
				</div>
			</div>
		</section>
		<!-- Footer -->
		<footer class="text-center text-lg-start text-light text-muted">
			<section
				class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
			>
				<div class="me-5 d-none d-lg-block text-light">
					<span>Get connected with us on social networks:</span>
				</div>

				<div class="text-light">
					<a href="" class="me-4 text-reset">
						<i class="fab fa-facebook-f"></i>
					</a>
					<a href="" class="me-4 text-reset">
						<i class="fab fa-twitter"></i>
					</a>
					<a href="" class="me-4 text-reset">
						<i class="fab fa-google"></i>
					</a>
					<a href="" class="me-4 text-reset">
						<i class="fab fa-instagram"></i>
					</a>
					<a href="" class="me-4 text-reset">
						<i class="fab fa-linkedin"></i>
					</a>
					<a href="" class="me-4 text-reset">
						<i class="fab fa-github"></i>
					</a>
				</div>
			</section>

			<section class="">
				<div class="container text-center text-md-start mt-5">
					<div class="row mt-3 text-light">
						<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
							<h6 class="text-uppercase fw-bold mb-4">
								<i class="fas fa-gem me-3"></i>NFTea
							</h6>
							<p>A New Place to Collect and Connect NFT Across the World</p>
						</div>

						<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
							<h6 class="text-uppercase fw-bold mb-4">Collections</h6>
							<p>
								<a href="#!" class="text-reset">All collections</a>
							</p>
						</div>

						<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
							<h6 class="text-uppercase fw-bold mb-4">NFTs</h6>
							<p>
								<a href="#!" class="text-reset">All NFTs</a>
							</p>
						</div>

						<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
							<h6 class="text-uppercase fw-bold mb-4">Contact</h6>
							<p><i class="fas fa-home me-3"></i> City, NY 10012, US</p>
							<p>
								<i class="fas fa-envelope me-3"></i>
								info@example.com
							</p>
							<p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
							<p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
						</div>
					</div>
				</div>
			</section>

			<!-- Copyright -->
			<div
				class="text-center p-4 text-light"
				style="background-color: rgba(0, 0, 0, 0.05)"
			>
				© 2022 Copyright: NFtea
			</div>
			<!-- Copyright -->
		</footer>
		<script src="./js/bootstrap.bundle.min.js"></script>
		<script src="./js/all.min.js"></script>
	</body>
</html>