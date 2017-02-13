			</div>
		</div>
		<!-- / main body -->

	</div>
	<!-- / wrapper -->

	<!-- footer -->
	<div id="footer" class="clearingfix">

		<div id="underfooter"></div>

		<!-- footer content -->
		<div class="wrapper floatholder rapidxwpr">
                    
                    <table style="width:100%">
                        <col width=7%>
                        <col width=57%>
                        <col width=25%>
                        <col width=10%>

                        <tr>
                            <th colspan="2">			
                                <!-- footer menu -->
                        <div class="footermenu">
                            <ul class="clearingfix">
                                <li>
                                    <a class="item1" href="<?php echo url::site(); ?>">
                                        <?php echo Kohana::lang('ui_main.home'); ?>
                                    </a>
                                </li>

                                <?php if (Kohana::config('settings.allow_reports')): ?>
                                    <li>
                                        <a href="<?php echo url::site() . "reports/submit"; ?>">
                                            <?php echo Kohana::lang('ui_main.submit'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (Kohana::config('settings.allow_alerts')): ?>
                                    <li>
                                        <a href="<?php echo url::site() . "alerts"; ?>">
                                            <?php echo Kohana::lang('ui_main.alerts'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if (Kohana::config('settings.site_contact_page')): ?>
                                    <li>
                                        <a href="<?php echo url::site() . "contact"; ?>">
                                            <?php echo Kohana::lang('ui_main.contact'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php
                                // Action::nav_main_bottom - Add items to the bottom links
                                Event::run('ushahidi_action.nav_main_bottom');
                                ?>
                            </ul>
                        </div></th>
                        <th colspan="2">			<!-- footer credits -->
                        <div class="footer-credits">

                            <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
                            Powered by the &nbsp;
                            <a href="http://www.ushahidi.com/">
                                <img src="<?php echo url::file_loc('img'); ?>media/img/footer-logo.png" alt="Ushahidi" class="footer-logo" />
                            </a>
                            &nbsp; Platform
                        </div>
                        <!-- / footer credits -->
                        </th>
                        </tr>
                        <tr>
                            <td>
                                <div class="ceasefireLogo"> </div>
                            </td>
                            <td colspan="2" >
                                <div class="copyrights">
                                <?php if ($site_copyright_statement != ''): ?>                                        
                                        <?php echo $site_copyright_statement; ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                            </td>
                            <td style="text-align: right">
                                <div class="mrgLogo"> </div>
                            </td>
                        </tr>
                    </table>
			</div>
			<!-- / footer menu -->


		</div>
		<!-- / footer content -->

	</div>
	<!-- / footer -->

	<?php
	echo $footer_block;
	// Action::main_footer - Add items before the </body> tag
	Event::run('ushahidi_action.main_footer');
	?>
</body>
</html>
