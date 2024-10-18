<div class="floating-actions">
	<button id="scrollToTopBtn" title="Go to top">
		<i class="fa-solid fa-angles-up"></i>
	</button>
    <!-- Whatssapp floating icon -->
    <a class="whatsapp-floating-icon" href="https://wa.me/971506484102" target="_blank"></a>
</div>

<script src="<?php echo base_url() . 'assets/frontend/default-new/js/bootstrap.bundle.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/berli.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/course.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/jquery.meanmenu.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/jquery.nice-select.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/jquery.webui-popover.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/owl.carousel.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/countries-data.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/countries-flag.js'; ?>"></script>
<?php if ($language_dir == 'rtl') : ?>
	<script src="<?php echo base_url() . 'assets/frontend/default-new/js/script-2.rtl.js'; ?>"></script>
<?php else : ?>
	<script src="<?php echo base_url() . 'assets/frontend/default-new/js/script-2.js'; ?>"></script>
<?php endif; ?>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/slick.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/venobox.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/script.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/summernote-0.8.20-dist/summernote-lite.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/wow.min.js'; ?>"></script>



<script src="<?php echo base_url() . 'assets/global/toastr/toastr.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/global/jquery-form/jquery.form.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/global/tagify/jquery.tagify.js'; ?>"></script>
<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != "") : ?>

	<script type="text/javascript">
		toastr.success('<?php echo $this->session->flashdata("flash_message"); ?>');
	</script>

<?php endif; ?>

<?php if ($this->session->flashdata('error_message') != "") : ?>

	<script type="text/javascript">
		toastr.error('<?php echo $this->session->flashdata("error_message"); ?>');
	</script>

<?php endif; ?>

<?php if ($this->session->flashdata('info_message') != "") : ?>

	<script type="text/javascript">
		toastr.info('<?php echo $this->session->flashdata("info_message"); ?>');
	</script>

<?php endif; ?>

<!-- Smart Look -->
<script type='text/javascript'>
window.smartlook||(function(d) {
var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
})(document);
smartlook('init', 'a717224e0bb04548effff15e83e087524e4fba0d', { region: 'eu' });
</script>

<!-- Google tag (gtag.js) --> 
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4B1RSMGLK4"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-4B1RSMGLK4'); </script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/670fa3bf4304e3196ad26757/1iaahf97i';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->