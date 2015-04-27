{* HEADER *}

<div id="help">
	Select the active dashlets for new users of each group. Groups must have <strong>Group Type</strong> set to <strong>Access Control</strong>. This activates dashlets for newly created users only. It will not alter existing users. 
</div>
<br>

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>
<br>

{foreach from=$groups item=group}
	<h3>{$group.title}</h3>
	{foreach from=$avalabledashlets item=avalabledashlet}
		<input type="checkbox" value="1" name="defaultdashlets[{$group.id}][{$avalabledashlet.id}]" {if !empty($defaultdashlets[$group.id][$avalabledashlet.id])}checked{/if}> {$avalabledashlet.label} &nbsp;&nbsp;&nbsp;
	{/foreach}
	<br>
{/foreach}
<br>

{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
