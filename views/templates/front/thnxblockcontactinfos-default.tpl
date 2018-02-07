{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!-- MODULE Block contact infos -->
<div class="thnxblockcontactinfos block contact_infos_footer col-md-3">
	<h4 class="title_block">{l s='Contact us' mod='thnxblockcontactinfos'}</h4>
	<div class="block_content">
		<ul>
			{if $thnxblckcntctnfs_ADRS != '' || $thnxblckcntctnfs_CMPNY != ''}
				<li class="clearfix">
					<i class="icon-home"></i>
					{$thnxblckcntctnfs_CMPNY}
					{$thnxblckcntctnfs_ADRS}
				</li>
			{/if}
			{if $thnxblckcntctnfs_EML != ''}
				<li class="clearfix">
					<i class="icon-envelope"></i>
					<span>{$thnxblckcntctnfs_EML}</span>
				</li>
			{/if}
			{if $thnxblckcntctnfs_PHN != ''}
				<li class="clearfix">
					<i class="icon-phone"></i>
					{$thnxblckcntctnfs_PHN}
				</li>
			{/if}
		</ul>
	</div>
</div>