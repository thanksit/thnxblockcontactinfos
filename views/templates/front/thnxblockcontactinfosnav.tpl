<div class="thnxblockcontactinfos contact_infos_nav float_right">
	<div class="block_content">
		<ul>
			{if $thnxblckcntctnfs_PHN != ''}
				<li>
					<i class="micon-phone"></i>
					{* {l s='Call us:' mod='thnxblockcontactinfos'}  *}
					{$thnxblckcntctnfs_PHN}
				</li>
			{/if}
			{if $thnxblckcntctnfs_EML != ''}
				<li>
					<i class="micon-email"></i>
					{* {l s='Email:' mod='thnxblockcontactinfos'}  *}
					<span>{$thnxblckcntctnfs_EML}</span>
				</li>
			{/if}
		</ul>
	</div>
</div>