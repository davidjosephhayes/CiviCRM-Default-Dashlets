{* HEADER *}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>

{foreach from=$groups item=group}
	<h3>{$group.name}</h3>
	{foreach from=$avalabledashlets item=avalabledashlet}
		<input type="checkbox" value="1" name="defaultdashlets[{$group.id}][{$avalabledashlet.id}]" {if !empty($defaultdashlets[$group.id][$avalabledashlet.id])}checked{/if}> {$avalabledashlet.label} &nbsp;&nbsp;&nbsp;
	{/foreach}
	<br>
{/foreach}

{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
