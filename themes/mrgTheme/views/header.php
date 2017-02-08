<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo html::specialchars($page_title.$site_name); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Iraq Ceasefire"/>
        <meta property="og:title" content="Iraq Ceasefire."/>
        <meta property="og:image" lang="en" content="/MainScreenshot.png"/>
        <meta property="og:description" lang="en" content="You can submit reports of violations occurring anywhere in Iraq. Reports submitted are stripped of any personal identifying information and plotted onto a live map showing the distribution of violations by location and type. Detailed data submitted on the website is used to create a more accurate and up-to-date picture of the situation in Iraq, motivate a more effective national and international response, and strengthen calls for accountability."/>
        <meta property="og:image" lang="ar" content="/MainScreenshot_ar.png"/>
        <meta property="og:description" lang="ar" content="يمكنك الإبلاغ عن انتهاكات تحدث في أي مكان بالعراق. يتم فصل جميع البيانات الشخصية عن جميع التقارير المرسلة ومن ثم يتم تمثيلها على خريطة تفاعلية توضح توزيع تلك الأنتهاكات بناءا علي المكان والنوع. وتستخدم هذه التقارير التفصيلية التي تم إرسالها لرسم صورة دقيقة ومحدثة للوضع في العراق بما يساعد علي تحفيز استجابة أكثر فاعلية على المستويين المحلي والدولي وكذلك تعزيز المطالبات ودعوات المسائلة للمسؤولين عن هذه الأنتهاكات."/>

	<?php echo $header_block; ?>
	<?php
	// Action::header_scripts - Additional Inline Scripts from Plugins
	Event::run('ushahidi_action.header_scripts');
	?>

</head>

<?php
  // Add a class to the body tag according to the page URI

  // we're on the home page
  if (count($uri_segments) == 0)
  {
  	$body_class = "page-main";
  }
  // 1st tier pages
  elseif (count($uri_segments) == 1)
  {
    $body_class = "page-".$uri_segments[0];
  }
  // 2nd tier pages... ie "/reports/submit"
  elseif (count($uri_segments) >= 2)
  {
    $body_class = "page-".$uri_segments[0]."-".$uri_segments[1];
  }
?>

<body id="page" class="<?php echo $body_class; ?>">

	<?php echo $header_nav; ?>

	<!-- wrapper -->
	<div class="wrapper floatholder rapidxwpr">

		<!-- header -->
		<div id="header">

			<!-- searchbox -->
			<div id="searchbox">

				<!-- languages -->
				<?php echo $languages;?>
				<!-- / languages -->

				<!-- searchform -->
<!-- commented by Ayman				<?php echo $search; ?> -->
				<!-- / searchform -->

				<!-- submit incident -->
				<?php echo $submit_btn; ?>
				<!-- / submit incident -->


			</div>
			<!-- / searchbox -->

			<!-- logo -->
			<?php if ($banner == NULL): ?>
			<div id="logo">
				<h1><a href="<?php echo url::site();?>"><?php echo $site_name; ?></a></h1>
				<span><?php echo $site_tagline; ?></span>
			</div>
			<?php else: ?>
			<a href="<?php echo url::site();?>"><img src="<?php echo $banner; ?>" alt="<?php echo $site_name; ?>" /></a>
			<?php endif; ?>
			<!-- / logo -->


		</div>
		<!-- / header -->
        <!-- / header item for plugins -->
        <?php
            // Action::header_item - Additional items to be added by plugins
	        Event::run('ushahidi_action.header_item');
        ?>

		<!-- main body -->
		<div id="middle">
			<div class="background layoutleft">

				<!-- mainmenu -->
				<div id="mainmenu" class="clearingfix">
					<ul>
						<?php nav::main_tabs($this_page); ?>
					</ul>

					<?php if ($allow_feed == 1) { ?>
					<div class="feedicon"><a href="<?php echo url::site(); ?>feed/"><img alt="<?php echo html::escape(Kohana::lang('ui_main.rss')); ?>" src="<?php echo url::file_loc('img'); ?>media/img/icon-feed.png" style="vertical-align: middle;" border="0" /></a></div>
					<?php } ?>

				</div>
				<!-- / mainmenu -->