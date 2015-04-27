{* HEADER *}

<div id="help">
	<p>Select the active dashlets for new users of each group. Groups must have <strong>Group Type</strong> set to <strong>Access Control</strong>. This activates dashlets for newly created users only. It will not alter existing users.</p>
	<p>Since users can be in multiple groups, the groups musted by in order of preference. Groups can be dragged and dropped to change their order.</p>
	<p>Dashlets can be set to show in the left or right column as well as in what order by dragging and dropping them.</p>
</div>
<br>

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>
<br>

<div id="defaultDashletsGroups">
	{foreach from=$groups item=group key=order}
		<div class="defaultDashletsGroup">
			<h3 class="defaultDashletsGroupTitle" style="cursor: move;">{$group.title}</h3>
			<div class="defaultDashletsSettings">
				{foreach from=$avalabledashlets item=avalabledashlet}
					<span class="defaultDashletsSetting">
						<label class="defaultDashletsSettingLabel" style="cursor: move;">{$avalabledashlet.label}:</label>
						<select name="defaultdashlets[{$group.id}][dashlets][{$avalabledashlet.id}][placement]" class="defaultDashletsSettingValue">
							<option value="-1" {if $defaultdashlets[$group.id].dashlets[$avalabledashlet.id].placement=='-1'}selected{/if}>Do not display</option>
							<option value="0" {if $defaultdashlets[$group.id].dashlets[$avalabledashlet.id].placement=='0'}selected{/if}>Left column</option>
							<option value="1" {if $defaultdashlets[$group.id].dashlets[$avalabledashlet.id].placement=='1'}selected{/if}>Right column</option>
						</select>
						<input type="hidden" name="defaultdashlets[{$group.id}][dashlets][{$avalabledashlet.id}][order]" value="{$defaultdashlets[$group.id].dashlets[$avalabledashlet.id].order}" class="defaultDashletsSettingOrder">
						&nbsp;&nbsp;&nbsp;
					</span>
				{/foreach}
			</div>
			<input type="hidden" name="defaultdashlets[{$group.id}][order]" value="{$defaultdashlets[$group.id].order}" class="defaultDashletsGroupOrder">
			<br><br>
		</div>
	{/foreach}
</div>

{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>

<script>
{literal}
	CRM.$(function($){		
		$("#defaultDashletsGroups").sortable({
			cursor: 'move',
			handle: '.defaultDashletsGroupTitle',
			stop: function(event,ui) {
				$('.defaultDashletsGroup',this).each(function(i,v){
					$('.defaultDashletsGroupOrder',this).val(i);
				});
			},
			create: function(event,ui) {
				var list = $(this);
				list.children().sort(function(a,b) {
					return parseInt($(a).find('.defaultDashletsGroupOrder').val()) - parseInt($(b).find('.defaultDashletsGroupOrder').val());
				}).appendTo(list);
			},
		});
		$(".defaultDashletsSettings").sortable({
			cursor: 'move',
			handle: '.defaultDashletsSettingLabel',
			stop: function(event,ui) {
				$('.defaultDashletsSetting',this).each(function(i,v){
					$('.defaultDashletsSettingOrder',this).val(i);
				});
			},
			create: function(event,ui) {
				var list = $(this);
				list.children().sort(function(a,b) {
					return parseInt($(a).find('.defaultDashletsSettingOrder').val()) - parseInt($(b).find('.defaultDashletsSettingOrder').val());
				}).appendTo(list);
			},
		});
	});
{/literal}
</script>
