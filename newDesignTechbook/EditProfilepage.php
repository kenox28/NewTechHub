<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Edit</title>
		<link rel="stylesheet" href="../css_techbook/EditProfile.css?v=1.0.6" />
		<link rel="stylesheet" href="../css_techbook/header.css?v=1.0.5" />
		<link rel="stylesheet" href="../css_techbook/1.css?v=1.0.4" />
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
			integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer" />
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
	</head>

	<body>
		<?php include "header.php"?>
		<main>
			<div id="reportmessage">
				<div id="btnforx">
					<a href="#" id="closedivreport"
						><i id="btnforback" class="fa fa-circle-xmark"></i
					></a>
				</div>
				<div>
					<form action="#" id="formesreport">
						<label for="chatadmin" id="labelrpt">Reports</label>
						<textarea
							id="chatadmin"
							class="input"
							placeholder="Report a message here"
							name="messageforadmin"></textarea>
						<input
							type="text"
							value="<?php echo $_SESSION['userid'] ?>"
							hidden
							name="reportsender" />
						<div id="divforbtnx">
							<button type="submit" id="btnforreports">SEND</button>
						</div>
					</form>
				</div>
			</div>
            <div id="feedbackModal">
                <div id="btnforx">
                    <a href="#" id="closeFeedback"><i id="btnforback" class="fa fa-circle-xmark"></i></a>
                </div>
                <div>
                    <form action="#" id="feedbackForm">
                        <label for="feedbackStars" id="labelrpt">Feedback</label>
                        <!-- Remove duplicate input, keep only one -->
                        <input type="text" value="<?php echo $_SESSION['userid'] ?>" hidden name="feedback_sender">
                        
                        <div class="star-rating" id="feedbackStars">
                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"><i class="fas fa-star"></i></label>
                        </div>
                        <div class="rating-text" id="ratingText">No rating selected</div>

                        <textarea id="chatadmin" placeholder="Share your feedback here..." name="feedback_message"></textarea>
                        
                        <div id="divforbtnx">
                            <button type="submit" id="btnforreports">SEND</button>
                        </div>
                    </form>
                </div>
            </div>
			<div
				id="divprofile"
				style="display: flex; flex-direction: column"
				data-aos="fade-up"
				data-aos-anchor-placement="center-bottom"
				data-aos-duration="1000">
				
				<div
					class="divedit"
					data-aos="fade-up"
					data-aos-anchor-placement="center-bottom">
					<form action="#" id="EditForm" enctype="multipart/form-data">
						<div class="divinput" id="fnamediv">
							<div class="container">
								<input
									required=""
									type="text"
									name="firstname"
									id="firstname"
									class="input"
									placeholder="First name" />
							</div>
							<div class="container">
								<input
									required=""
									type="text"
									name="lastname"
									id="lastname"
									class="input"
									placeholder="last name" />
							</div>
						</div>
						<div class="divinput" id="Userdiv">
							<!-- <div class="container">
								<input
									required=""
									type="email"
									name="email"
									id="email"
									class="input"
									placeholder="Enter email account" />
							</div> -->
							<div class="container">
								<input
									required=""
									type="password"
									name="password"
									id="password"
									class="input"
									placeholder="Enter password" />
							</div>
						</div>
						<div class="divinput" id="numberdiv">
							<div class="container">
								<input
									required=""
									type="number"
									name="number"
									id="number"
									class="input"
									placeholder="Enter number" />
							</div>
							<!-- <div class="container">
								<input
									required=""
									type="date"
									class="input"
									id="dateb"
									name="bday" />
							</div> -->
						</div>
						<div class="divinput" id="fnamediv">
							<div class="container">
								<input
									required=""
									type="text"
									name="address"
									id="address"
									class="input"
									placeholder="address" />
							</div>
							<div class="container">
								<input
									required=""
									type="text"
									name="course"
									id="course"
									class="input"
									placeholder="course" />
							</div>
						</div>
						<div class="divinput" id="fnamediv">
							<div class="container">
								<input
									required=""
									type="text"
									name="pl"
									id="pl"
									class="input"
									placeholder="programming language" />
							</div>
							<div class="container">
								<input
									required=""
									type="text"
									name="secyr"
									id="secyr"
									class="input"
									placeholder="Section & year" />
							</div>
						</div>
						<div id="rsubmit">
							<!-- <div class="radio-button-container">
								<div class="radio-button">
									<input
										type="radio"
										class="radio-button__input"
										id="radio1"
										name="gender"
										value="Male" />
									<label class="radio-button__label" for="radio1">
										<span class="radio-button__custom"></span>
										Male
									</label>
								</div>
								<div class="radio-button">
									<input
										type="radio"
										class="radio-button__input"
										id="radio2"
										name="gender"
										value="Female" />
									<label class="radio-button__label" for="radio2">
										<span class="radio-button__custom"></span>
										Female
									</label>
								</div>
							</div> -->
							<div class="divMG">
								<label for="idimage" id="labelIMG">Select Profile</label>
								<input type="file" id="idimage" name="img" />
							</div>
							<button type="submit" id="saveEdit" class="btn">
								<i class="fa-regular fa-floppy-disk"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
			<section
				id="sidep"
				data-aos="fade-right"
				data-aos-offset="300"
				data-aos-easing="ease-in-sine">
				<?php include "../newPhpfileTechhub/selectedChat.php"?>

				<div class="profilecontainer">
					<img
						src="../profileimage/<?php echo $selectCname['img']; ?>"
						alt=""
						id="pimg" />
					<div id="dprof">
						<h1 id="pname">
							<?php echo $selectCname['fname'] . " " . $selectCname['lname'] ?>
						</h1>
						<?php include "../newPhpfileTechhub/rankinprofile.php"?>
						<p id="Prank">
							<?php echo $rankuserc['ranks'] ?>
						</p>
						<p id="pstat">
							<?php echo $selectCname['status'] ?>
						</p>
					</div>
				</div>
				<div id="moreinfo">
					<?php include "../newPhpfileTechhub/showinfo.php"?>

					<p class="pinfo" id="addp">Address:<?php echo $userinfoc['address'] ?></p>
					<p class="pinfo" id="plp">Programming language:	<?php echo $userinfoc['pl'] ?></p>
					<p class="pinfo" id="pc">Course:<?php echo $userinfoc['course'] ?></p>
					<p class="pinfo" id="psy">Section & yr:	<?php echo $userinfoc['sectionyr'] ?></p>
				</div>
			</section>
		</main>
	</body>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="../techHUB_Javascripts/editprofile.js"></script>
</html>
