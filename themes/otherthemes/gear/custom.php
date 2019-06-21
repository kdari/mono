<style type="text/css">
	div.main {
		background: <?php echo $gear_bg; ?>;
	}
	.header {
		background: <?php echo $gear_header_bg; ?>;
	}
	.banner {
		background: <?php echo $gear_banner_bg; ?>;
	}
	
<?php if ($gear_logo_visibility == "off") { ?>
	.intro .intro-wrapper {
		background: none;
		padding-left: 18px;
	}
<?php } ?>
	
<?php if ($gear_width == "wide") { ?>

.container {width:940px;margin:0 auto;}
div.span-1, div.span-2, div.span-3, div.span-4, div.span-5, div.span-6, div.span-7, div.span-8, div.span-9, div.span-10, div.span-11, div.span-12, div.span-13, div.span-14, div.span-15, div.span-16, div.span-17, div.span-18, div.span-19, div.span-20, div.span-21, div.span-22, div.span-23, div.span-24 {float:left;margin-right: 20px;}

div.last {margin-right:0;}
.span-1  { width: 20px;}
.span-2  { width: 60px;}
.span-3  { width: 100px;}
.span-4  { width: 140px;}
.span-5  { width: 180px;}
.span-6  { width: 220px;}
.span-7  { width: 260px;}
.span-8  { width: 300px;}
.span-9  { width: 340px;}
.span-10 { width: 380px;}
.span-11 { width: 420px;}
.span-12 { width: 460px;}
.span-13 { width: 500px;}
.span-14 { width: 540px;}
.span-15 { width: 580px;}
.span-16 { width: 620px;}
.span-17 { width: 660px;}
.span-18 { width: 700px;}
.span-19 { width: 740px;}
.span-20 { width: 780px;}
.span-21 { width: 820px;}
.span-22 { width: 860px;}
.span-23 { width: 900px;}
.span-24, div.span-24 { width: 940px; margin: 0; }

/* with borders */
.myborder {margin: 0px 20px 20px 0px; }


.append-1  { padding-right: 40px;}
.append-2  { padding-right: 80px;}
.append-3  { padding-right: 120px;}
.append-4  { padding-right: 160px;}
.append-5  { padding-right: 200px;}
.append-6  { padding-right: 240px;}
.append-7  { padding-right: 280px;}
.append-8  { padding-right: 320px;}
.append-9  { padding-right: 360px;}
.append-10 { padding-right: 400px;}
.append-11 { padding-right: 440px;}
.append-12 { padding-right: 480px;}
.append-13 { padding-right: 520px;}
.append-14 { padding-right: 560px;}
.append-15 { padding-right: 600px;}
.append-16 { padding-right: 640px;}
.append-17 { padding-right: 680px;}
.append-18 { padding-right: 720px;}
.append-19 { padding-right: 760px;}
.append-20 { padding-right: 800px;}
.append-21 { padding-right: 840px;}
.append-22 { padding-right: 880px;}
.append-23 { padding-right: 920px;}

.prepend-1  { padding-left: 40px;}
.prepend-2  { padding-left: 80px;}
.prepend-3  { padding-left: 120px;}
.prepend-4  { padding-left: 160px;}
.prepend-5  { padding-left: 200px;}
.prepend-6  { padding-left: 240px;}
.prepend-7  { padding-left: 280px;}
.prepend-8  { padding-left: 320px;}
.prepend-9  { padding-left: 360px;}
.prepend-10 { padding-left: 400px;}
.prepend-11 { padding-left: 440px;}
.prepend-12 { padding-left: 480px;}
.prepend-13 { padding-left: 520px;}
.prepend-14 { padding-left: 560px;}
.prepend-15 { padding-left: 600px;}
.prepend-16 { padding-left: 640px;}
.prepend-17 { padding-left: 680px;}
.prepend-18 { padding-left: 720px;}
.prepend-19 { padding-left: 760px;}
.prepend-20 { padding-left: 800px;}
.prepend-21 { padding-left: 840px;}
.prepend-22 { padding-left: 880px;}
.prepend-23 { padding-left: 920px;}

div.border{padding-right:9px;margin-right:10px;border-right:1px solid #eee;}
div.colborder { padding-right:11px;margin-right:10px;border-right:1px solid #eee;}
.pull-1 { margin-left: -40px;}
.pull-2 { margin-left: -80px;}
.pull-3 { margin-left: -120px;}
.pull-4 { margin-left: -160px;}
.pull-5 { margin-left: -200px;}
.pull-6 { margin-left: -240px;}
.pull-7 { margin-left: -280px;}
.pull-8 { margin-left: -320px;}
.pull-9 { margin-left: -360px;}
.pull-10 { margin-left: -400px;}
.pull-11 { margin-left: -440px;}
.pull-12 { margin-left: -480px;}
.pull-13 { margin-left: -520px;}
.pull-14 { margin-left: -560px;}
.pull-15 { margin-left: -600px;}
.pull-16 { margin-left: -640px;}
.pull-17 { margin-left: -680px;}
.pull-18 { margin-left: -720px;}
.pull-19 { margin-left: -760px;}
.pull-20 { margin-left: -800px;}
.pull-21 { margin-left: -840px;}
.pull-22 { margin-left: -880px;}
.pull-23 { margin-left: -920px;}
.pull-24 { margin-left: -960px;}

.pull-1, .pull-2, .pull-3, .pull-4, .pull-5, .pull-6, .pull-7, .pull-8, .pull-9, .pull-10, .pull-11, .pull-12, .pull-13, .pull-14, .pull-15, .pull-16, .pull-17, .pull-18, .pull-19, .pull-20, .pull-21, .pull-22, .pull-23, .pull-24 {float:left;position:relative;}

.push-1 { margin: 0 -40px 1.5em 40px;}
.push-2 { margin: 0 -80px 1.5em 80px;}
.push-3 { margin: 0 -120px 1.5em 120px;}
.push-4 { margin: 0 -160px 1.5em 160px;}
.push-5 { margin: 0 -200px 1.5em 200px;}
.push-6 { margin: 0 -240px 1.5em 240px;}
.push-7 { margin: 0 -280px 1.5em 280px;}
.push-8 { margin: 0 -320px 1.5em 320px;}
.push-9 { margin: 0 -360px 1.5em 360px;}
.push-10 { margin: 0 -400px 1.5em 400px;}
.push-11 { margin: 0 -440px 1.5em 440px;}
.push-12 { margin: 0 -480px 1.5em 480px;}
.push-13 { margin: 0 -520px 1.5em 520px;}
.push-14 { margin: 0 -560px 1.5em 560px;}
.push-15 { margin: 0 -600px 1.5em 600px;}
.push-16 { margin: 0 -640px 1.5em 640px;}
.push-17 { margin: 0 -680px 1.5em 680px;}
.push-18 { margin: 0 -720px 1.5em 720px;}
.push-19 { margin: 0 -760px 1.5em 760px;}
.push-20 { margin: 0 -800px 1.5em 800px;}
.push-21 { margin: 0 -840px 1.5em 840px;}
.push-22 { margin: 0 -880px 1.5em 880px;}
.push-23 { margin: 0 -920px 1.5em 920px;}
.push-24 { margin: 0 -960px 1.5em 960px;}

.push-1, .push-2, .push-3, .push-4, .push-5, .push-6, .push-7, .push-8, .push-9, .push-10, .push-11, .push-12, .push-13, .push-14, .push-15, .push-16, .push-17, .push-18, .push-19, .push-20, .push-21, .push-22, .push-23, .push-24 {float:right;position:relative;}

.content {
	background-position: 700px 0;
}

.span-7 {
	width: 237px;
}
.span-17 {
	width: 700px;
}
<?php } ?>

</style>