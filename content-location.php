<?php
	global $gStudy24Url;
	$mapPage = "/locations/#!";
	$locationId = get_the_ID();
	$slug = $post->post_name;
	$subject = cf("subject");
	$phone = cf("phone");
	$building = cf("building");
	$spaces = cf("group_spaces");
	//$equipment = cf("equipment");
	$arexpert = get_field("expert");
	$title1 = cf("tab_1_title");
	$subtitle1 = cf("tab_1_subtitle");
	$content1left = get_field("tab_1_content_left");
	$content1 = get_field("tab_1_content");
	$title2 = cf("tab_2_title");
	$subtitle2 = cf("tab_2_subtitle");
	$content2left = get_field("tab_2_content_left");
	$content2 = get_field("tab_2_content");
	$content2wide = 0;
	if ($content2 == "") $content2wide = 1;
	$content1wide = 0;
	if ($content1 == "") $content1wide = 1;
	$study24 = get_field("study_24");
	$temp = $post;
	$post = $temp;
		$reserveText = get_field("reserve_text");
	if ($reserveText == "") {
		$reserveText = "Reserve Group Study Space";
	}
	$reserveUrl = get_field("reserve_url");
	
	
	
	$expertAskUrl = get_field("expert_ask_url");
	if ($expertAskUrl == "") $expertAskUrl = "http://libraries.mit.edu/ask";
	
	
	$numMain = 6;
	$arMain = array();
	
	for($i=1;$i<=$numMain;$i++) {
		$img = get_field("main_image".$i, $locationId);
		if ($img != "")
			$arMain[] = $img;
	}
	
	$numSub = 8;
	$arSub = array();
	$subs = 0;
	for($i=1;$i<=$numSub;$i++) {
		$img = get_field("sub_image".$i, $locationId);
		if ($img != "") {
			$subs++;
			$arSub[] = $img;
		}
	}
	
	$strLocation = "";
	if ($subs <= 0) {
		$strLocation = "noThumbs";
	}
	
	
	$alert = trim(get_field("alert"));
?>
		
<div id="stage" class="inner row group" role="main">

	<div class="title-page libraryTitle flex-container">
		<div class="flex-item">
			<div class="libraryContent">
				<h1>
					<span class="libraryName"><?php the_title(); ?></span>
					<span class="subject-library"><?php echo $subject ?></span>
				</h1>
				<div class="info-more">
					<a href="tel:<?php echo $phone; ?>" class="phone"><?php echo $phone ?></a>
					<a href="<?php echo $mapPage.$slug; ?>">Room: <?php echo $building ?> <i class="icon-arrow-right"></i></a>
				</div>
			</div><!-- end div.libraryContent -->
			
			<div class="hours-today">
				<span>Today's hours: <strong data-location-hours="<?php the_title(); ?>"></strong></span>
				<?php if ($study24 == 1): ?>
					<a class="study-24-7" href="<?php echo $gStudy24Url; ?>" alt="This location contains one or more study spaces available 24 hours a day, seven days a week. Click the link for more info." title="Study 24/7">Study 24/7</a>
				<?php endif; ?>
				<a href="/hours" class="link-hours-all">See all hours <i class="icon-arrow-right"></i></a>
			</div>					

		</div><!-- end div.flex-item -->
		<div class="flex-item">
			
<?php

$showAlert = get_post_meta($frontpage_id, 'show_alert', true);	
if ($showAlert == 0 && $alert != "") { 
		
$alert = trim(get_field("alert"));

?>		
				
<div id="dispose" class="smallerAlert  transition-vertical transition-vertical">
        <div class="post alert--critical flex-container">
		<svg class="icon-exclamation-circle" width="2048" height="2048" viewBox="0 0 2048 2048" xmlns="http://www.w3.org/2000/svg">
		<path d="M1024 256q209 0 385.5 103t279.5 279.5 103 385.5-103 385.5-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103zm128 1247v-190q0-14-9-23.5t-22-9.5h-192q-13 0-23 10t-10 23v190q0 13 10 23t23 10h192q13 0 22-9.5t9-23.5zm-2-344l18-621q0-12-10-18-10-8-24-8h-220q-14 0-24 8-10 6-10 18l17 621q0 10 10 17.5t24 7.5h185q14 0 23.5-7.5t10.5-17.5z"/>
        </svg>
        	<div class="content-post"><?php echo $alert; ?> </div>
		</div>
	</div>
				
<?php }   ?>
			

<script>
jQuery( document ).ready(function() {
    console.log( "ready!" );
	jQuery(".smallerAlert .post").append('<a href="#0" id="closeMe" class="action-close"><svg width="2048" height="2048" viewBox="0 0 2048 2048" xmlns="http://www.w3.org/2000/svg"><path d="M1353 1207l-146 146q-10 10-23 10t-23-10l-137-137-137 137q-10 10-23 10t-23-10l-146-146q-10-10-10-23t10-23l137-137-137-137q-10-10-10-23t10-23l146-146q10-10 23-10t23 10l137 137 137-137q10-10 23-10t23 10l146 146q10 10 10 23t-10 23l-137 137 137 137q10 10 10 23t-10 23zm215-183q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/></svg></a>')
	
	jQuery("#closeMe").click(function(){
		jQuery( "#dispose" ).hide();
		})
	
});

</script>	
		
			<div class="librarySlideshow">
				<div class="slideshow">
					<?php
						$val = $arMain[array_rand($arMain)];
					?>
					<?php if ($val != ""): ?>
					<img src="<?php echo $val; ?>" data-thumb="<?php echo $val; ?>" alt="<?php the_title(); ?>" />
					<?php endif; ?>
				</div>
			</div><!-- end div.librarySlideshow -->
		</div><!-- end div.flex-item -->
	</div><!-- end div.libraryTitle -->
	
	<div class="btMarg content-main flex-container group <?php echo $strLocation; ?>">
		<div class="col-1 content-page">

			<?php if ($title1 != "" || $title2 != ""): ?>
				<?php $noTab = "";  ?>
			<ul class="tabnav">
				<?php if ($title1 != ""): ?>
				<li class="active"><h2 class="title-tab"><a href="#tab1"><?php echo $title1 ?><div><?php echo $subtitle1 ?></div></a></h2></li>
				<?php endif; ?>
				<?php if ($title2 != ""): ?>
				<li><h2 class="title-tab"><a href="#tab2"><?php echo $title2 ?><span class="title-sub"><?php echo $subtitle2 ?></span class="title-sub"></a></h2></li>
				<?php endif; ?>
			</ul>
			<?php else: ?>
				<?php $noTab = " noTab";  ?>
			<?php endif; ?>

			<div class="tabcontent group <?php echo $noTab ?>">

				<div class="tab active flex-container group" id="tab1">

						<div class="flex-item first group <?php if($content1wide): ?>span7 wideColumn<?php else: ?>span4<?php endif; ?>">
						
							<?php
								if ($arexpert) {
									$expertIndex = array_rand($arexpert);
									$expert = $arexpert[$expertIndex];
									
									
									$name = $expert->post_title;
									$bio = $expert->post_excerpt;
									//$url = $expert->guid;
									$url = get_post_meta($expert->ID, "expert_url", 1);
									
									if (has_post_thumbnail($expert->ID)) {
										$thumb = get_the_post_thumbnail($expert->ID, array(108,108));
									} else {
										$thumb = "";
									}
									
							?>
							<div class="profile flex-container group">
								<?php if ($thumb != ""): 
									echo $thumb;
								endif; ?>
								<div class="profileContent">
									<h3 class="profileTitle"><span class="intro">Featured expert:</span><span class="name"><?php echo $name; ?></span><span class="bio"><?php echo $bio; ?></span></h3>
									<div class="links">
										<a class="primary" href="<?php echo $url; ?>" target="_blank">How can I help? <i class="icon-arrow-right"></i></a>
										<a href="/experts">See all our experts <i class="icon-arrow-right"></i></a>
									</div>

								</div>

							</div>

							<?php
								}
									echo $content1left;
								?>

						</div>

						<div class="flexItem second span3">
							<?php echo $content1 ?>
						</div>

				</div>
				<?php if ($title2 != ""): ?>
				
				<div class="tab tab2 flexContainer group" id="tab2">

						<div class="flexItem first <?php if($content2wide): ?>span8 wideColumn<?php else: ?>span2<?php endif; ?>">
						<?php echo $content2left ?>
						
						<?php if ($reserveUrl != ""): ?>
									<a class="reserve hidden-phone" href="<?php echo $reserveUrl; ?>"><?php echo $reserveText; ?></a>
						<?php endif; ?>

						
						</div>

						<div class="flexItem second span6">
							<?php echo $content2 ?>
						</div>

				</div>

				<?php endif; ?>

			</div><!-- end div.tabcontent -->

		</div><!-- end div.col-1 -->

		<div class="col-2">
			<?php get_sidebar(); ?>
		</div>

</div><!-- end div#stage -->